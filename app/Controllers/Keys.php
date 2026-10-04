<?php

namespace App\Controllers;

use App\Models\HistoryModel;
use App\Models\KeysModel;
use App\Models\UserModel;
use Config\Services;

class Keys extends BaseController
{
    protected $userModel, $model, $user, $userId, $time, $game_list, $duration, $price;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->user = $this->userModel->getUser();
        $this->model = new KeysModel();
        if (!$this->user && session()->has('userid')) {
            session()->remove(['userid', 'unames', 'time_login', 'time_since']);
        }
        $this->time = new \CodeIgniter\I18n\Time;

        $this->userId = session()->get('userid');

        /* ------- Game ------- */
        $this->game_list = [
            'PUBG' => 'PUBG Mobile'
        ];

        $this->duration = [
            2    => '2 Hours &mdash; ₹10/Device',
            5    => '5 Hours &mdash; ₹20/Device',
            24   => '1 Days &mdash; ₹80/Device',
            72   => '3 Days &mdash; ₹150/Device',
            168  => '7 Days &mdash; ₹250/Device',
            336  => '14 Days &mdash; ₹350/Device',
            720  => '30 Days &mdash; ₹500/Device',
            1440 => '60 Days &mdash; ₹900/Device',
            4320 => '6 Months &mdash; ₹2400/Device',
            8760 => '1 Year &mdash; ₹4500/Device',
        ];

        $this->price = [
            2    => 10,
            5    => 20,
            24   => 80,
            72   => 150,
            168  => 250,
            336  => 350,
            720  => 500,
            1440 => 900,
            4320 => 2400,
            8760 => 4500,
        ];
    }

    public function index()
    {
        $model = $this->model;
        $user = $this->user;

        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        if ($user->level != 1) {
            $keys = $model->where('registrator', $user->username)->findAll();
        } else {
            $keys = $model->findAll();
        }
        $data = [
            'title' => 'Keys',
            'user' => $user,
            'keylist' => $keys,
            'time' => $this->time,
        ];
        return view('Keys/list', $data);
    }
    
    public function download_all_Keys()
    {
        $model = $this->model;
        $user = $this->user;
        $keys = $model->select('user_key')->findAll();
        $data = '';
        for ($i = 0; $i < count($keys); $i++) {
            $data .= $keys[$i]['user_key'] . "\n";
        }
        $this->downloadFile('Newkeys.txt');
    }
   
    public function download_new_Keys()
    {
        $this->downloadFile('new.txt');
    }

    function downloadFile($yourFile)
    {
        $file = @fopen($yourFile, "rb");

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=Allkeys.txt');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }
    }

    public function alterKeys()
    {
        $user = $this->user;
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        $model = $this->model;
        if ($user->level != 1) {
            $model->where('registrator', $user->username);
        }
        $model->where('expired_date <', date('Y-m-d H:i:s'))->delete();

        return redirect()->back()->with('msgSuccess', 'Expired keys successfully removed.');
    }

    /* ===== Delete All Keys Function ===== */
    public function deleteAll()
    {
        $model = $this->model;
        $user = $this->user;
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }

        if ($user->level == 1) {
            $model->emptyTable('keys_code');
        } else {
            // Reseller: केवल अपनी बनाई हुई keys डिलीट करेगा
            $model->where('registrator', $user->username)->delete();
        }

        return redirect()->back()->with('msgSuccess', 'All keys deleted successfully.');
    }

    public function deleteKeys()
    {
        return $this->deleteAll();
    }

    public function resetAllKeys()
    {
        if (!session()->has('userid') || !$this->user) {
            return $this->response->setStatusCode(401)->setJSON(['registered' => false]);
        }
        if (!hudRateLimit('key_delete', 20, 60)) {
            return $this->response->setStatusCode(429)->setJSON(['registered' => false, 'reason' => 'rate']);
        }
        $keys = $this->request->getGet('userkey');
        $db_key = $this->model->getKeys($keys);
        if (!$db_key) {
            return $this->response->setJSON(['registered' => false, 'keys' => $keys]);
        }
        $user = $this->user;
        if ($user->level != 1 && $db_key->registrator != $user->username) {
            return $this->response->setJSON([
                'registered' => true,
                'reset' => false,
                'devices_total' => 1,
                'keys' => $keys,
            ]);
        }
        $this->model->where('user_key', $keys)->delete();
        writeAudit('key_delete', $keys, $user->username);
        return $this->response->setJSON([
            'registered' => true,
            'reset' => true,
            'devices_max' => (int) $db_key->max_devices,
            'keys' => $keys,
        ]);
    }

    public function startDate()
    {
        $model = $this->model;
        $data = $model->where('expired_date =', null)->delete();

        return redirect()->back()->with('msgSuccess', 'Unused keys deleted successfully.');
    }

    public function api_get_keys()
    {
        if (!$this->request->isAJAX() && $this->request->getHeaderLine('X-Requested-With') !== 'XMLHttpRequest') {
            $accept = (string) $this->request->getHeaderLine('Accept');
            if (stripos($accept, 'json') === false && !$this->request->getGet('draw')) {
                return $this->response->setStatusCode(403)->setJSON(['status' => false, 'reason' => 'Forbidden']);
            }
        }
        if (!session()->has('userid')) {
            return $this->response->setStatusCode(401)->setJSON(['status' => false]);
        }
        $model = $this->model;
        return $model->API_getKeys();
    }
    
    public function deleteExpired()
    {
        $model = $this->model;
        $user = $this->user;
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }

        if ($user->level != 1) {
            $model->where('registrator', $user->username);
        }

        $model->where('expired_date <', date('Y-m-d H:i:s'))->where('expired_date !=', null)->delete();
        return redirect()->back()->with('msgSuccess', 'Expired keys deleted successfully.');
    }

    // Aliases for view compatibility
    public function deleteExp()
    {
        return $this->deleteExpired();
    }

    public function deleteUnused()
    {
        $model = $this->model;
        $user = $this->user;
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }

        if ($user->level != 1) {
            $model->where('registrator', $user->username);
        }

        $model->where('expired_date =', null)->delete();
        return redirect()->back()->with('msgSuccess', 'Unused keys deleted successfully.');
    }

    public function api_key_reset()
    {
        if (!session()->has('userid') || !$this->user) {
            return $this->response->setStatusCode(401)->setJSON(['registered' => false]);
        }
        if (!hudRateLimit('key_reset', 20, 60)) {
            return $this->response->setStatusCode(429)->setJSON(['registered' => false, 'reason' => 'rate']);
        }
        sleep(1);
        $model = $this->model;
        $keys = $this->request->getGet('userkey');
        $reset = $this->request->getGet('reset');
        $db_key = $model->getKeys($keys);

        $rules = [];
        if ($db_key) {
            $total = $db_key->devices ? explode(',', $db_key->devices) : [];
            $rules = ['devices_total' => count($total), 'devices_max' => (int) $db_key->max_devices];
            $user = $this->user;
            if ($user && $db_key->devices and $reset) {
                if ($user->level == 1 or $db_key->registrator == $user->username) {
                    $model->set('devices', NULL)
                        ->where('user_key', $keys)
                        ->update();
                    $rules = ['reset' => true, 'devices_total' => 0, 'devices_max' => $db_key->max_devices];
                }
            }
        }

        $data = [
            'registered' => $db_key ? true : false,
            'keys' => $keys,
        ];

        $real_response = array_merge($data, $rules);
        if (!empty($rules['reset'])) {
            writeAudit('hwid_reset', $keys, $this->user->username);
        }
        return $this->response->setJSON($real_response);
    }

    public function share($key = '')
    {
        $dKey = $this->model->getKeys($key);
        $user = $this->user;
        if (!$dKey || ($user->level != 1 && $dKey->registrator != $user->username)) {
            return redirect()->to('keys')->with('msgDanger', 'Key not found.');
        }
        $text = "BLACK BUNNY KEY\nGame: {$dKey->game}\nKey: {$dKey->user_key}\nDuration: {$dKey->duration}h\nDevices: {$dKey->max_devices}";
        return $this->response->setJSON([
            'status' => true,
            'user_key' => $dKey->user_key,
            'share' => $text,
        ]);
    }

    public function edit_key($key = false)
    {
        if ($this->request->getPost()) return $this->edit_key_action();
        $msgDanger = "The user key no longer exists.";
        if ($key) {
            $dKey = $this->model->getKeys($key, 'id_keys');
            $user = $this->user;
            if ($dKey) {
                if ($user->level == 1 or $dKey->registrator == $user->username) {
                    $validation = Services::validation();
                    $data = [
                        'title' => 'Key',
                        'user' => $user,
                        'key' => $dKey,
                        'game_list' => $this->game_list,
                        'time' => $this->time,
                        'key_info' => getDevice($dKey->devices),
                        'messages' => setMessage('Please carefuly edit information'),
                        'validation' => $validation,
                    ];
                    return view('Keys/key_edit', $data);
                } else {
                    $msgDanger = "Restricted to this user key.";
                }
            }
        }
        return redirect()->to('keys')->with('msgDanger', $msgDanger);
    }

    private function edit_key_action()
    {
        $keys = $this->request->getPost('id_keys');
        $user = $this->user;
        $dKey = $this->model->getKeys($keys, 'id_keys');
        $game = implode(",", array_keys($this->game_list));

        if (!$dKey) {
            $msgDanger = "The user key no longer exists~";
        } else {
            if ($user->level == 1 or $dKey->registrator == $user->username) {
                $form_reseller = [
                    'status' => [
                        'label' => 'status',
                        'rules' => 'required|integer|in_list[0,1]',
                        'errors' => [
                            'integer' => 'Invalid {field}.',
                            'in_list' => 'Choose between list.'
                        ]
                    ]
                ];
                $form_admin = [
                    'id_keys' => [
                        'label' => 'keys',
                        'rules' => 'required|is_not_unique[keys_code.id_keys]|numeric',
                        'errors' => [
                            'is_not_unique' => 'Invalid keys.'
                        ],
                    ],
                    'game' => [
                        'label' => 'Games',
                        'rules' => "required|alpha_numeric_space|in_list[$game]",
                        'errors' => [
                            'alpha_numeric_space' => 'Invalid characters.'
                        ],
                    ],
                    'user_key' => [
                        'label' => 'User keys',
                        'rules' => "required|is_unique[keys_code.user_key,user_key,$dKey->user_key]|alpha_numeric",
                        'errors' => [
                            'is_unique' => '{field} has been taken.'
                        ],
                    ],
                    'duration' => [
                        'label' => 'duration',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid hour {field}.'
                        ]
                    ],
                    'max_devices' => [
                        'label' => 'devices',
                        'rules' => 'required|numeric|greater_than_equal_to[1]',
                        'errors' => [
                            'greater_than_equal_to' => 'Minimum {field} is invalid.',
                            'numeric' => 'Invalid max of {field}.'
                        ]
                    ],
                    'registrator' => [
                        'label' => 'registrator',
                        'rules' => 'permit_empty|alpha_numeric_space|min_length[4]'
                    ],
                    'expired_date' => [
                        'label' => 'expired',
                        'rules' => 'permit_empty|valid_date[Y-m-d H:i:s]',
                        'errors' => [
                            'valid_date' => 'Invalid {field} date.',
                        ]
                    ],
                    'devices' => [
                        'label' => 'device list',
                        'rules' => 'permit_empty'
                    ]
                ];

                if ($user->level == 1) {
                    $form_rules = array_merge($form_reseller, $form_admin);
                    $devices = $this->request->getPost('devices');
                    $max_devices = $this->request->getPost('max_devices');

                    $data_saves = [
                        'game' => $this->request->getPost('game'),
                        'user_key' => $this->request->getPost('user_key'),
                        'duration' => $this->request->getPost('duration'),
                        'max_devices' => $max_devices,
                        'status' => $this->request->getPost('status'),
                        'registrator' => $this->request->getPost('registrator'),
                        'expired_date' => $this->request->getPost('expired_date') ?: NULL,
                        'devices' => setDevice($devices, $max_devices),
                    ];
                } else {
                    $form_rules = $form_reseller;
                    $data_saves = ['status' => $this->request->getPost('status')];
                }

                if (!$this->validate($form_rules)) {
                    return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the error');
                } else {
                    $this->model->update($dKey->id_keys, $data_saves);
                    return redirect()->back()->with('msgSuccess', 'User key successfuly updated!');
                }
            } else {
                $msgDanger = "Restricted to this user key~";
            }
        }
        return redirect()->to('keys')->with('msgDanger', $msgDanger);
    }

    public function generate()
    {
        if ($this->request->getPost())
            return $this->generate_action();

        $user = $this->user;
        $validation = Services::validation();

        $message = setMessage("<i class='bi bi-wallet'></i> Total Saldo $$user->saldo");
        if ($user->saldo <= 0) {
            $message = setMessage("Please top up to your beloved admin.", 'warning');
        }

        $data = [
            'title' => 'Generate',
            'user' => $user,
            'time' => $this->time,
            'game' => $this->game_list,
            'duration' => $this->duration,
            'price' => json_encode($this->price),
            'messages' => $message,
            'validation' => $validation,
        ];
        return view('Keys/generate', $data);
    }

    private function generate_action()
    {
        $user = $this->user;
        $game = $this->request->getPost('game');
        $maxd = $this->request->getPost('max_devices');
        $drtn = $this->request->getPost('duration');
        $twst = $this->request->getPost('custominput');
        $cuslicense = $this->request->getPost('cuslicense');
        $getPrice = getPrice($this->price, $drtn, $maxd);
        
        $bulkMap = [
            '1' => 1,
            '5' => 5,
            '10' => 10,
            '25' => 25,
            '50' => 50,
            '100' => 100,
        ];
        $loopRaw = (string) $this->request->getPost('loopcount');
        $loopcount = isset($bulkMap[$loopRaw]) ? $bulkMap[$loopRaw] : 1;
        if ($this->request->getPost('custominput') === 'custom') {
            $loopcount = 1;
        }

        $game_list = implode(",", array_keys($this->game_list));
        $form_rules = [
            'game' => [
                'label' => 'Games',
                'rules' => "required|alpha_numeric_space|in_list[$game_list]",
                'errors' => [
                    'alpha_numeric_space' => 'Invalid characters.'
                ],
            ],
            'duration' => [
                'label' => 'duration',
                'rules' => 'required|numeric|greater_than_equal_to[1]',
                'errors' => [
                    'greater_than_equal_to' => 'Minimum {field} is invalid.',
                    'numeric' => 'Invalid day {field}.'
                ]
            ],
            'max_devices' => [
                'label' => 'devices',
                'rules' => 'required|numeric|greater_than_equal_to[1]',
                'errors' => [
                    'greater_than_equal_to' => 'Minimum {field} is invalid.',
                    'numeric' => 'Invalid max of {field}.'
                ]
            ],
        ];

        $validation = Services::validation();
        $previewFees = $getPrice * max(1, (int) $loopcount);
        $reduceCheck = ($user->saldo - $previewFees);

        if ($reduceCheck < 0) {
            $validation->setError('duration', 'Insufficient balance');
            return redirect()->back()->withInput()->with('msgWarning', 'Please top up to your beloved admin.');
        } else {
            if (!$this->validate($form_rules)) {
                return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the error');
            } else {
                $msg = "Successfuly Generated.";
                $generated = [];
                $idKeys = 0;
                $license = '';
                $unitPrice = $getPrice;
                $totalFees = $unitPrice * $loopcount;
                $reduceCheck = ($user->saldo - $totalFees);
                if ($reduceCheck < 0) {
                    $validation->setError('duration', 'Insufficient balance');
                    return redirect()->back()->withInput()->with('msgWarning', 'Please top up to your beloved admin.');
                }

                for ($i = 0; $i < $loopcount; $i++) {
                    $license = $user->username . '-' . $drtn . '-' . random_string('alnum', 5);
                    $model = $this->model;
                    if ($twst == "custom") {
                        if (strlen($cuslicense) > 3 && strlen($cuslicense) < 20) {
                            $findKey = $model->getKeysGame(['user_key' => $cuslicense, 'game' => $game]);
                            if ($findKey) {
                                return redirect()->back()->with('msgDanger', 'Key already exists!!');
                            }
                            $license = $cuslicense;
                        } else {
                            return redirect()->back()->with('msgDanger', 'Custom Key is too Short/Long');
                        }
                    }

                    $data_response = [
                        'game' => $game,
                        'user_key' => $license,
                        'duration' => $drtn,
                        'max_devices' => $maxd,
                        'registrator' => $user->username,
                        'created_by' => (int) $this->userId,
                    ];
                    $generated[] = $license;
                    $idKeys = $this->model->insert($data_response);
                }

                $this->userModel->update(session('userid'), ['saldo' => $reduceCheck]);

                $history = new HistoryModel();
                $history->insert([
                    'keys_id' => $idKeys,
                    'user_do' => $user->username,
                    'info' => "$game|" . substr($license, 0, 5) . "|$drtn|$maxd"
                ]);
                writeAudit('generate_keys', count($generated) . " keys / $game / {$drtn}h", $user->username);

                $other_response = [
                    'fees' => $totalFees,
                    'user_key' => $generated[0],
                    'generated_keys' => implode("\n", $generated),
                    'bulk_count' => count($generated),
                ];

                session()->setFlashdata(array_merge($data_response, $other_response));
                return redirect()->back()->with('msgSuccess', $msg);
            }
        }
    }
}