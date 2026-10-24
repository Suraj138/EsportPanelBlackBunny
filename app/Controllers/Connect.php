<?php

namespace App\Controllers;

use App\Models\Feature;
use App\Models\KeysModel;
use App\Models\Server;
use App\Models\_ftext;
use App\Models\onoff;

class Connect extends BaseController
{
    protected $model, $game, $uKey, $sDev, $maintenance, $staticWords;

    public function __construct()
    {
        $this->model = new KeysModel();
        $onoff = (new onoff())->find(1);
        $this->maintenance = $onoff && isset($onoff['status']) && $onoff['status'] === 'on';
        $this->staticWords = "Vm8Lk7Uj2JmsjCPVPVjrLa7zgfx3uz9E";
    }

    public function gone()
    {
        return $this->response->setStatusCode(404)->setBody('');
    }

    public function index()
    {
        if (strtoupper((string) $this->request->getMethod()) !== 'POST') {
            return $this->gone();
        }
        return $this->index_post();
    }

    public function index_post()
    {
        if (!hudRateLimit('connect', 40, 60)) {
            return $this->response->setStatusCode(429)->setJSON([
                'status' => false,
                'reason' => 'RATE LIMITED',
            ]);
        }
        $isMT = $this->maintenance;
        $game = $this->request->getPost('game');
        $uKey = $this->request->getPost('user_key');
        $sDev = $this->request->getPost('serial');

        $form_rules = [
            'game' => 'required|alpha_dash',
            'user_key' => 'required|min_length[1]|max_length[64]',
            'serial' => 'required|alpha_dash'
        ];

        if (!$this->validate($form_rules)) {
            return $this->response->setJSON([
                'status' => false,
                'reason' => 'Bad Parameter',
            ]);
        }

        if ($isMT) {
            $onoff = (new onoff())->find(1);
            return $this->response->setJSON([
                'status' => true,
                'reason' => $onoff ? $onoff['myinput'] : 'UNDER MAINTENANCE',
            ]);
        }

        if (!$game or !$uKey or !$sDev) {
            return $this->response->setJSON([
                'status' => false,
                'reason' => 'INVALID PARAMETER'
            ]);
        }

        $time = new \CodeIgniter\I18n\Time;
        $model = $this->model;
        $findKey = $model->getKeysGame(['user_key' => $uKey, 'game' => $game]);
        $data = ['status' => false];

        if (!$findKey) {
            return $this->response->setJSON([
                'status' => false,
                'reason' => 'USER OR GAME NOT REGISTERED'
            ]);
        }

        if ($findKey->status != 1) {
            return $this->response->setJSON([
                'status' => false,
                'reason' => 'USER BLOCKED'
            ]);
        }

        $id_keys = $findKey->id_keys;
        $duration = $findKey->duration;
        $expired = $findKey->expired_date;
        $max_dev = $findKey->max_devices;
        $devices = $findKey->devices;

        if (!$expired) {
            $setExpired = $time::now()->addHours($duration);
            $model->update($id_keys, ['expired_date' => $setExpired]);
            $data['status'] = true;
        } elseif ($time::now()->isBefore($expired)) {
            $data['status'] = true;
        } else {
            return $this->response->setJSON([
                'status' => false,
                'reason' => 'EXPIRED KEY'
            ]);
        }

        $devicesAdd = $this->checkDevicesAdd($sDev, $devices, $max_dev);
        if (!$devicesAdd) {
            return $this->response->setJSON([
                'status' => false,
                'reason' => 'MAX DEVICE REACHED'
            ]);
        }
        if (is_array($devicesAdd)) {
            $model->update($id_keys, $devicesAdd);
        }

        $mod = (new Server())->find(1);
        $ftext = (new _ftext())->find(1);
        $feature = (new Feature())->find(1);
        $rngcnt = $time->getTimestamp();
        $real = $game . '-' . $uKey . '-' . $sDev . '-' . $this->staticWords;
        $expiry = $findKey->expired_date;
        if ($expiry == null) {
            $expiry = $time::now()->addHours($duration);
        }

        $model->update($id_keys, ['last_ping' => date('Y-m-d H:i:s')]);

        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'token' => md5($real),
                'modname' => $mod ? $mod['modname'] : BASE_NAME,
                'mod_status' => $ftext ? $ftext['_status'] : '',
                'credit' => $ftext ? $ftext['_ftext'] : '',
                'ESP' => $feature ? $feature['ESP'] : 'off',
                'Item' => $feature ? $feature['Item'] : 'off',
                'AIM' => $feature ? $feature['AIM'] : 'off',
                'SilentAim' => $feature ? $feature['SilentAim'] : 'off',
                'BulletTrack' => $feature ? $feature['BulletTrack'] : 'off',
                'Floating' => $feature ? $feature['Floating'] : 'off',
                'Memory' => $feature ? $feature['Memory'] : 'off',
                'Setting' => $feature ? $feature['Setting'] : 'off',
                'expired_date' => $expiry,
                'EXP' => $expiry,
                'exdate' => $expiry,
                'device' => $max_dev,
                'rng' => $rngcnt,
                'ping' => date('Y-m-d H:i:s'),
            ],
        ]);
    }

    private function checkDevicesAdd($serial, $devices, $max_dev)
    {
        $lsDevice = $devices ? explode(',', $devices) : [];
        $lsDevice = array_values(array_filter($lsDevice, function ($v) {
            return $v !== '';
        }));
        $cDevices = count($lsDevice);
        if (in_array($serial, $lsDevice)) {
            return true;
        }
        if ($cDevices < $max_dev) {
            $lsDevice[] = $serial;
            $setDevice = reduce_multiples(implode(',', $lsDevice), ',', true);
            return ['devices' => $setDevice];
        }
        return false;
    }
}
