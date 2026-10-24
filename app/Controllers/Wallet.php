<?php

namespace App\Controllers;

use App\Models\ShopConfig;
use App\Models\UserModel;
use App\Models\WalletTopup;

class Wallet extends BaseController
{
    public function index()
    {
        $user = (new UserModel())->getUser();
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        ensureWalletTable();
        $cfg = (new ShopConfig())->bag();
        $model = new WalletTopup();
        $mine = $model->mine((int) $user->id_users, 20);
        $queue = [];
        if ((int) $user->level === 1) {
            $queue = $model->latest(40);
        }
        return view('User/wallet', [
            'title' => 'Wallet',
            'user' => $user,
            'time' => new \CodeIgniter\I18n\Time,
            'cfg' => $cfg,
            'mine' => $mine,
            'queue' => $queue,
        ]);
    }

    public function topup()
    {
        $user = (new UserModel())->getUser();
        if (!$user) {
            return redirect()->to('login');
        }
        if (!hudRateLimit('wallet_topup', 6, 600)) {
            return redirect()->to('wallet')->with('msgDanger', 'Too many top-ups. Wait and retry.');
        }
        ensureWalletTable();
        $rules = [
            'amount' => 'required|numeric|greater_than_equal_to[50]|less_than_equal_to[50000]',
            'txn_id' => 'required|min_length[4]|max_length[80]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('wallet')->withInput()->with('msgDanger', 'Amount 50-50000 and UPI txn id required.');
        }
        $amount = (int) $this->request->getPost('amount');
        $txn = esc(trim((string) $this->request->getPost('txn_id')));
        $note = esc((string) $this->request->getPost('note'));
        $dup = (new WalletTopup())->where('txn_id', $txn)->first();
        if ($dup) {
            return redirect()->to('wallet')->with('msgDanger', 'This txn id already submitted.');
        }
        $id = (new WalletTopup())->insert([
            'user_id' => (int) $user->id_users,
            'username' => $user->username,
            'amount' => $amount,
            'txn_id' => $txn,
            'note' => $note,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        writeAudit('wallet_ask', 'topup#' . $id . ' Rs ' . $amount, $user->username);
        pingWalletTopup($id);
        return redirect()->to('wallet')->with('msgSuccess', 'Top-up submitted. Owner will credit after UPI check.');
    }

    public function decide()
    {
        $user = (new UserModel())->getUser();
        if (!$user || (int) $user->level !== 1) {
            return redirect()->to('wallet')->with('msgDanger', 'Owner only.');
        }
        ensureWalletTable();
        $id = (int) $this->request->getPost('topup_id');
        if ($this->request->getPost('approve_topup')) {
            $out = walletApprove($id, $user);
            $key = !empty($out['ok']) ? 'msgSuccess' : 'msgDanger';
            return redirect()->to('wallet')->with($key, $out['msg'] ?? 'Fail');
        }
        if ($this->request->getPost('reject_topup')) {
            $out = walletReject($id, $user);
            $key = !empty($out['ok']) ? 'msgSuccess' : 'msgDanger';
            return redirect()->to('wallet')->with($key, $out['msg'] ?? 'Fail');
        }
        return redirect()->to('wallet');
    }
}
