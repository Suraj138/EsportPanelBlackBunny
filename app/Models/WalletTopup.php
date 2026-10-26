<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletTopup extends Model
{
    protected $table      = 'wallet_topups';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'username', 'amount', 'txn_id', 'note', 'status', 'verified_by', 'created_at'];
    protected $useTimestamps = false;

    public function latest($limit = 40)
    {
        return $this->orderBy('id', 'DESC')->limit($limit)->findAll();
    }

    public function mine($userId, $limit = 20)
    {
        return $this->where('user_id', (int) $userId)->orderBy('id', 'DESC')->limit($limit)->findAll();
    }

    public function pendingCount()
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
