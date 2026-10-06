<?php

namespace App\Controllers;

use App\Models\AuditLog;
use App\Models\CodeModel;
use App\Models\KeysModel;
use App\Models\LibModel;
use App\Models\Server;
use App\Models\Status;
use App\Models\_ftext;
use App\Models\Feature;
use App\Models\onoff;
use App\Models\HistoryModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;

class User extends BaseController
{
    protected $model, $userid, $user, $time, $accExpire, $accLevel;

    public function __construct()
    {
        $this->userid = session()->userid;
        $this->model = new UserModel();
        $this->user = $this->model->getUser($this->userid);
        $this->time = new \CodeIgniter\I18n\Time;
        if (!$this->user && session()->has('userid')) {
            session()->remove(['userid', 'unames', 'time_login', 'time_since']);
        }
        
        $this->accExpire = [
           1 => '1 Day',
           7 => '7 Days',
           15 => '15 Days',
           30 => '30 Days',
           60 => '60 Days',
        ];
        
        $this->accLevel = [
           1 => 'Owner',
           2 => 'Admin',
           3 => 'User',
        ];
    }

    public function index()
    {
        $historyModel = new HistoryModel();
        $db = \Config\Database::connect();
        $keysTable = $db->table('keys_code');
        $user = $this->user;
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        if ((int) $user->level != 1) {
            $keysTable->where('registrator', $user->username);
        }
        $totalKeys = $keysTable->countAllResults(false);
        $usedKeys = $db->table('keys_code');
        if ((int) $user->level != 1) {
            $usedKeys->where('registrator', $user->username);
        }
        $usedKeys->where('devices IS NOT NULL', null, false)->where('devices !=', '');
        $usedCount = $usedKeys->countAllResults();
        $userCount = $db->table('users')->countAllResults();
        $onlineQ = $db->table('keys_code')->where('last_ping >=', date('Y-m-d H:i:s', time() - 180));
        if ((int) $user->level != 1) {
            $onlineQ->where('registrator', $user->username);
        }
        $onlineCount = $onlineQ->countAllResults();
        $pendingOrders = 0;
        $pageOn = '1';
        try {
            $pendingOrders = $db->table('shop_orders')->where('status', 'pending')->countAllResults();
            $pageRow = $db->table('shop_config')->where('config_key', 'page_on')->get()->getRow();
            $pageOn = $pageRow ? $pageRow->config_value : '1';
        } catch (\Throwable $e) {
            $pendingOrders = 0;
        }
        $unused = max(0, $totalKeys - $usedCount);
        $roleLabel = 'User';
        if ((int) $user->level == 1) $roleLabel = 'Owner';
        elseif ((int) $user->level == 2) $roleLabel = 'Admin';
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'time' => $this->time,
            'history' => $historyModel->getAll(8),
            'roleLabel' => $roleLabel,
            'stats' => [
                'total' => $totalKeys,
                'used' => $usedCount,
                'unused' => $unused,
                'users' => $userCount,
                'online' => $onlineCount,
                'fill' => $totalKeys > 0 ? (int) round(($usedCount / $totalKeys) * 100) : 0,
                'pending' => $pendingOrders,
                'page_on' => $pageOn === '1',
            ],
            'expiration_date' => $user->expiration_date,
        ];
        return view('User/dashboard', $data);
    }
    
     public function ref_index()
    {
        $user = $this->user;
        
        if ($this->request->getPost())
        if (($user->level == 1) || ($user->level == 2)){
		return $this->reff_action();
	     }
	     else {
	         
	         return redirect()->to('dashboard')->with('msgWarning','Access Denied!');
	     }

        $mCode = new CodeModel();
        $validation = Services::validation();
        $data = [
            'title' => 'Referral',
            'user' => $user,
            'time' => $this->time,
            'code' => $mCode->getCode(),
            'accExpire' => $this->accExpire,
            'accLevel' => $this->accLevel,
            'total_code' => $mCode->countAllResults(),
            'validation' => $validation
        ];
        return view('Admin/referral', $data);
    }
    

    private function reff_action()
    {
        $saldo = $this->request->getPost('set_saldo');
        $user_expire = $this->request->getPost('accExpire');
        $accLevel1 = $this->request->getPost('accLevel');
        $loginDevices = (int) $this->request->getPost('login_devices');
        $refAccounts = (int) $this->request->getPost('ref_accounts');
        $accExpire = $this->time::now()->addDays($user_expire);
        $form_rules = [
            'set_saldo' => [
                'label' => 'saldo',
                'rules' => 'required|numeric|max_length[11]|greater_than_equal_to[0]',
                'errors' => [
                    'greater_than_equal_to' => 'Invalid currency, cannot set to minus.'
                ]
            ],
            'accExpire' => [
                'label' => 'Account Expiration',
                'rules' =>  'required|numeric|max_length[2]|greater_than_equal_to[1]',
                'errors' => [
                     'greater_than_equal_to' => 'Invalid Days, cannot set to expired.'
                ]
            ],
            'login_devices' => [
                'label' => 'Panel Login Devices',
                'rules' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[99]',
            ],
            'ref_accounts' => [
                'label' => 'Referral Accounts They Can Create',
                'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[999]',
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Failed, check the form');
        } else {
            $actor = $this->user;
            if ((int) $actor->level != 1) {
                $quota = isset($actor->ref_accounts) ? (int) $actor->ref_accounts : 0;
                $used = (new CodeModel())->countCreatedBy($actor->username);
                if ($quota < 1 || $used >= $quota) {
                    return redirect()->back()->with('msgDanger', 'Referral quota reached. Ask Owner to raise the limit.');
                }
            }
            $code = random_string('alnum', 6);
            $codeHash = create_password($code, false);
            $referral_code = [
                'code' => $codeHash,
                'Referral' => $code,
                'level' => $accLevel1,
                'set_saldo' => ($saldo < 1 ? 0 : $saldo),
                'created_by' => session('unames'),
                'used_by' => '',
                'acc_expiration' => $accExpire,
                'login_devices' => ($loginDevices < 1 ? 1 : $loginDevices),
                'ref_accounts' => ($refAccounts < 0 ? 0 : $refAccounts)
            ];
            $mCode = new CodeModel();
            $ids = $mCode->insert($referral_code, true);
            if ($ids) {
                writeAudit('create_referral', "code=$code level=$accLevel1", session('unames'));
                return redirect()->back()->with('msgSuccess', "Referral : $code");
            }
        }
    }

  
    public function alterUser()
    {
        return redirect()->to('dashboard')->with('msgDanger', 'Disabled.');
    }
        
    

    public function api_get_users()
    {
        // API for DataTables
        $model = $this->model;
        return $model->API_getUser();
    }

    public function manage_users()
    {
        $user  = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        $model = $this->model;
        $q = trim((string) $this->request->getGet('q'));
        $page = max(1, (int) $this->request->getGet('page'));
        $perPage = 20;
        if (strlen($q) >= 1) {
            $model->groupStart()
                ->like('username', $q)
                ->orLike('fullname', $q)
                ->orLike('uplink', $q)
                ->groupEnd();
        }
        $total = $model->countAllResults();
        if (strlen($q) >= 1) {
            $model->groupStart()
                ->like('username', $q)
                ->orLike('fullname', $q)
                ->orLike('uplink', $q)
                ->groupEnd();
        }
        $user_list = $model->orderBy('id_users', 'DESC')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultObject();
        $pages = max(1, (int) ceil($total / $perPage));
        $validation = Services::validation();
        $data = [
            'title' => 'Users',
            'user' => $user,
            'user_list' => $user_list,
            'q' => $q,
            'page' => $page,
            'pages' => $pages,
            'total' => $total,
            'time' => $this->time,
            'validation' => $validation
        ];
        return view('Admin/users', $data);
    }

    public function user_delete($userid = false)
    {
        return redirect()->to('dashboard')->with('msgDanger', 'Disabled.');
    }
    
    public function user_edit($userid = false)
    {
        $user = $this->user;
        if ($user->level != 1)
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');

        if ($this->request->getPost())
            return $this->user_edit_action();

        $model = $this->model;
        $validation = Services::validation();

        $data = [
            'title' => 'Settings',
            'user' => $user,
            'target' => $model->getUser($userid),
            'user_list' => $model->getUserList(),
            'time' => $this->time,
            'validation' => $validation,
        ];
        return view('Admin/user_edit', $data);
    }

    private function user_edit_action()
    {
        $model = $this->model;
        $userid = $this->request->getPost('user_id');

        $target = $model->getUser($userid);
        if (!$target) {
            $msg = "User no longer exists.";
            return redirect()->to('dashboard')->with('msgDanger', $msg);
        }

        $username = $this->request->getPost('username');

        $form_rules = [
            'username' => [
                'label' => 'username',
                'rules' => "required|alpha_numeric|min_length[4]|max_length[25]|is_unique[users.username,username,$target->username]",
                'errors' => [
                    'is_unique' => 'The {field} has taken by other.'
                ]
            ],
            'fullname' => [
                'label' => 'name',
                'rules' => 'permit_empty|alpha_space|min_length[4]|max_length[155]',
                'errors' => [
                    'alpha_space' => 'The {field} only allow alphabetical characters and spaces.'
                ]
            ],
            'level' => [
                'label' => 'roles',
                'rules' => 'required|numeric|in_list[1,2,3]',
                'errors' => [
                    'in_list' => 'Invalid {field}.'
                ]
            ],
            'status' => [
                'label' => 'status',
                'rules' => 'required|numeric|in_list[1,2,3]',
                'errors' => [
                    'in_list' => 'Invalid {field} account.'
                ]
            ],
            'saldo' => [
                'label' => 'saldo',
                'rules' => 'permit_empty|numeric|max_length[11]|greater_than_equal_to[0]',
                'errors' => [
                    'greater_than_equal_to' => 'Invalid currency, cannot set to minus.'
                ]
            ],
            'uplink' => [
                'label' => 'uplink',
                'rules' => 'required|alpha_numeric|is_not_unique[users.username,username,]',
                'errors' => [
                    'is_not_unique' => 'Uplink not registered anymore.'
                ]
            ],
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Something wrong! Please check the form');
        } else {
            $fullname = $this->request->getPost('fullname');
            $level = $this->request->getPost('level');
            $status = $this->request->getPost('status');
            $saldo = $this->request->getPost('saldo');
            $uplink = $this->request->getPost('uplink');
            $expiration = $this->request->getPost('expiration');
            $data_update = [
                'username' => $username,
                'fullname' => esc($fullname),
                'level' => $level,
                'status' => $status,
                'saldo' => (($saldo < 1) ? 0 : $saldo),
                'uplink' => $uplink,
                'expiration_date' => $expiration
            ];
            if ($this->request->getPost('reset_bound')) {
                $data_update['bound_logins'] = '';
            }

            $update = $model->update($userid, $data_update);
            if ($update) {
                return redirect()->back()->with('msgSuccess', "Successfuly update $target->username.");
            }
        }
    }

    public function settings()
    {
        if ($this->request->getPost('password_form'))
            return $this->passwd_act();

        if ($this->request->getPost('fullname_form'))
            return $this->fullname_act();

        $user = $this->user;
        $this->ensureOtpColumn();

        if ($this->request->getPost('otp_enable') && (int) $user->level == 1) {
            $secret = totpSecretMake();
            $this->model->update($user->id_users, ['otp_secret' => $secret]);
            writeAudit('otp_enable', 'owner 2fa', $user->username);
            return redirect()->to('settings')->with('msgSuccess', '2FA armed. Scan secret now.');
        }
        if ($this->request->getPost('otp_disable') && (int) $user->level == 1) {
            $code = (string) $this->request->getPost('otp_code');
            $secret = isset($user->otp_secret) ? (string) $user->otp_secret : '';
            if ($secret && !totpVerify($secret, $code)) {
                return redirect()->to('settings')->with('msgDanger', '2FA code invalid.');
            }
            $this->model->update($user->id_users, ['otp_secret' => '']);
            writeAudit('otp_disable', 'owner 2fa off', $user->username);
            return redirect()->to('settings')->with('msgSuccess', '2FA disarmed.');
        }

        $user = $this->model->getUser($this->userid);
        $otpSecret = isset($user->otp_secret) ? trim((string) $user->otp_secret) : '';
        $validation = Services::validation();
        $data = [
            'title' => 'Settings',
            'user' => $user,
            'time' => $this->time,
            'validation' => $validation,
            'otp_secret' => $otpSecret,
            'otp_uri' => $otpSecret ? totpUri($otpSecret, $user->username) : '',
        ];
        
        return view('User/settings', $data);
    }

    private function ensureOtpColumn()
    {
        try {
            $db = \Config\Database::connect();
            if (!$db->fieldExists('otp_secret', 'users')) {
                $db->query('ALTER TABLE users ADD COLUMN otp_secret VARCHAR(64) NULL');
            }
        } catch (\Throwable $e) {
        }
    }

    public function pulse()
    {
        $user = $this->user;
        $db = \Config\Database::connect();
        $keysTable = $db->table('keys_code');
        if ((int) $user->level != 1) {
            $keysTable->where('registrator', $user->username);
        }
        $totalKeys = $keysTable->countAllResults(false);
        $usedKeys = $db->table('keys_code');
        if ((int) $user->level != 1) {
            $usedKeys->where('registrator', $user->username);
        }
        $usedKeys->where('devices IS NOT NULL', null, false)->where('devices !=', '');
        $usedCount = $usedKeys->countAllResults();
        $onlineQ = $db->table('keys_code')->where('last_ping >=', date('Y-m-d H:i:s', time() - 180));
        if ((int) $user->level != 1) {
            $onlineQ->where('registrator', $user->username);
        }
        $onlineCount = $onlineQ->countAllResults();
        $pending = 0;
        try {
            $pending = $db->table('shop_orders')->where('status', 'pending')->countAllResults();
        } catch (\Throwable $e) {
            $pending = 0;
        }
        return $this->response->setJSON([
            'total' => (int) $totalKeys,
            'used' => (int) $usedCount,
            'unused' => max(0, (int) $totalKeys - (int) $usedCount),
            'online' => (int) $onlineCount,
            'pending' => (int) $pending,
            'fill' => $totalKeys > 0 ? (int) round(($usedCount / $totalKeys) * 100) : 0,
            'users' => (int) $db->table('users')->countAllResults(),
            'lobby' => date('H:i:s'),
        ]);
    }
        
    public function lib()
    {
        $user = $this->user;
        if (!(($user->level == 1) || ($user->level == 2))) {
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');
        }
        $libModel = new LibModel();
        if ($this->request->getPost('save') && $this->request->getFile('myfile')) {
            $file = $this->request->getFile('myfile');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $ext = strtolower($file->getExtension());
                if (!in_array($ext, ['so', 'zip', 'apk', 'bin'], true)) {
                    return redirect()->to('store')->with('msgDanger', 'Only Store / LIB files are allowed.');
                }
                if ($file->getSize() > 100000000) {
                    return redirect()->to('store')->with('msgWarning', 'File is too large.');
                }
                $uploadDir = FCPATH . 'uploads/lib/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getName());
                $file->move($uploadDir, $safeName, true);
                $size = filesize($uploadDir . $safeName);
                $suffixes = ['B', 'KB', 'MB'];
                $base = $size > 0 ? log($size, 1024) : 0;
                $realsize = round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[(int) floor($base)];
                $libModel->insert([
                    'file' => $safeName,
                    'file_type' => 'uploads/lib/' . $safeName,
                    'file_size' => $realsize,
                    'time' => date('Y-m-d H:i:s'),
                ]);
                writeAudit('store_upload', $safeName, $user->username);
                return redirect()->to('store')->with('msgSuccess', 'Store package uploaded: ' . $safeName . ' (' . $realsize . ')');
            }
            return redirect()->to('store')->with('msgDanger', 'Failed to upload store package.');
        }
        $current = $libModel->current();
        $history = $libModel->latest(12);
        $data = [
            'title' => 'Store / Public Control',
            'user' => $user,
            'time' => $this->time,
            'validation' => Services::validation(),
            'lib' => $current ?: (object) ['file' => 'No package', 'file_size' => '-', 'id' => '-', 'file_type' => '-', 'time' => '-'],
            'lib_history' => $history,
            'now' => date('Y-m-d H:i:s'),
        ];
        return view('Server/lib', $data);
    }

    public function search()
    {
        $q = trim((string) $this->request->getGet('q'));
        $user = $this->user;
        $keys = [];
        $users = [];
        if (strlen($q) >= 2) {
            $km = new KeysModel();
            if ((int) $user->level != 1) {
                $km->where('registrator', $user->username);
            }
            $km->groupStart()
                ->like('user_key', $q)
                ->orLike('game', $q)
                ->orLike('registrator', $q)
                ->orLike('devices', $q)
                ->groupEnd();
            $keys = $km->findAll(40);
            $opNames = [];
            foreach ($keys as $row) {
                $name = trim((string) ($row['registrator'] ?? ''));
                if ($name !== '') {
                    $opNames[$name] = $name;
                }
            }
            if ((int) $user->level == 1) {
                $users = $this->model->groupStart()->like('username', $q)->orLike('fullname', $q)->groupEnd()->findAll(20);
            }
            if ($opNames) {
                $fromKeys = $this->model->whereIn('username', array_values($opNames))->findAll(40);
                $seen = [];
                foreach ($users as $u) {
                    $seen[$u['username']] = true;
                }
                foreach ($fromKeys as $u) {
                    if (empty($seen[$u['username']])) {
                        $users[] = $u;
                        $seen[$u['username']] = true;
                    }
                }
                foreach ($opNames as $name) {
                    if (empty($seen[$name])) {
                        $users[] = [
                            'username' => $name,
                            'fullname' => '',
                            'level' => 0,
                        ];
                        $seen[$name] = true;
                    }
                }
            }
        }
        return view('User/search', [
            'title' => 'Search',
            'user' => $user,
            'time' => $this->time,
            'q' => $q,
            'keys' => $keys,
            'users' => $users,
        ]);
    }

    public function audit()
    {
        $user = $this->user;
        if ((int) $user->level != 1) {
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');
        }
        return view('User/audit', [
            'title' => 'Audit Log',
            'user' => $user,
            'time' => $this->time,
            'logs' => (new AuditLog())->latest(80),
        ]);
    }
        
    public function Server()
    {
        $user = $this->user;
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        if (($user->level == 1) || ($user->level == 2)) 
        {
        
        if ($this->request->getPost('modname_form'))
            
            return $this->modname_act();
            
        if ($this->request->getPost('status_form'))
            return $this->status_act();
        }
        if ($user->level == 1)
        {
        if ($this->request->getPost('feature_form'))
            return $this->feature_act();
        if ($this->request->getPost('password_form'))
            return $this->passwd_act();
        }
        if (($user->level == 1) || ($user->level == 2)) 
        {
        if ($this->request->getPost('_ftext_form'))
            return $this->_ftext_act();

        if ($this->request->getPost('fullname_form'))
            return $this->fullname_act();

        }
        $user = $this->user;
        
        $validation = Services::validation();
        $data = [
            'title' => 'Server',
            'user' => $user,
            'time' => $this->time,
            'validation' => $validation
        ];
        
        //==================================Mod Name======================//
        
        $id = 1;
	    
	    $model= new Server();
	    
	    $data['row'] = $model->where('id',$id)->first() ?: ['modname' => ''];
	    $data['userDetails1'] = (new onoff())->find(1) ?: ['status' => 'off', 'myinput' => ''];
	    $data['userDetails2'] = (new _ftext())->find(1) ?: ['_status' => '', '_ftext' => ''];
	    $data['ModFeatureStatus'] = (new Feature())->find(1) ?: ['ESP'=>'off','Item'=>'off','AIM'=>'off','SilentAim'=>'off','BulletTrack'=>'off','Memory'=>'off','Floating'=>'off','Setting'=>'off'];
	    
	     if (($user->level == 1) || ($user->level == 2)){
		return view('Server/Server',$data);
	     }
	     else {
	         
	         return redirect()->to('dashboard')->with('msgWarning','Access Denied');
	     }
    }
    
    private function _ftext_act()
    {
        $id = 1;
	    $model= new _ftext();
	    $myinput = $this->request->getPost('_ftext');
	    $status = $this->request->getPost('_ftextr');
	    $wow = '';
	if($status == "Safe"){
            $wow .= "Safe";
        }else{
            $wow .= "Anti-Cheat is High..!!";
        }
      $data = ['_ftext' => $myinput,'_status' => $wow];
	    $model->update($id,$data);
	    return redirect()->back()->with('msgSuccess', 'Successfuly Changed Mod Floating And Status.');
    }
    
    private function status_act()
    {
        $id = 1;
	    $model= new onoff();
	    $myinput = $this->request->getPost('myInput');
	    $wow = '';
	    if(isset($_POST['radios']) && $_POST['radios'] == 'on') 
        {
            $wow .= "on";
        }
        else
        {
            $wow .= "off";
        }
	    $data = [
	        'status' => $wow,
    	    'myinput' => $myinput
	    ];
	    $model->update($id, $data);
	    return redirect()->back()->with('msgSuccess', 'Mod Status Successfuly Changed.');
    }
    
    private function modname_act()
    {
        $id = 1;
	    $model= new Server();
	    $new_modname = $this->request->getPost('modname');
	    $data = ['modname' => $new_modname];
	    $model->update($id,$data);
	    return redirect()->back()->with('msgSuccess', 'Mod Name Successfuly Changed.');
    }
    
    private function feature_act()
    {
        $id = 1;
	    $model = new Feature();
//=================================================//
	    if(isset($_POST['ESP']) && $_POST['ESP'] == 'on') 
        {
            $new_espvalue = "on";
        }
        else
        {
            $new_espvalue = "off";
        }
//=================================================//
	    if(isset($_POST['Item']) && $_POST['Item'] == 'on') 
        {
            $new_Itemvalue = "on";
        }
        else
        {
            $new_Itemvalue = "off";
        }
//=================================================//
	    if(isset($_POST['AIM']) && $_POST['AIM'] == 'on') 
        {
            $new_aimvalue = "on";
        }
        else
        {
            $new_aimvalue = "off";
        }
//=================================================//
	    if(isset($_POST['SilentAim']) && $_POST['SilentAim'] == 'on') 
        {
            $new_SilentAimvalue = "on";
        }
        else
        {
            $new_SilentAimvalue = "off";
        }
//=================================================//
	    if(isset($_POST['BulletTrack']) && $_POST['BulletTrack'] == 'on') 
        {
            $new_BulletTrackvalue = "on";
        }
        else
        {
            $new_BulletTrackvalue = "off";
        }
//=================================================//
	    if(isset($_POST['Memory']) && $_POST['Memory'] == 'on') 
        {
            $new_Memoryvalue = "on";
        }
        else
        {
            $new_Memoryvalue = "off";
        }
//=================================================//
	    if(isset($_POST['Floating']) && $_POST['Floating'] == 'on') 
        {
            $new_Floatingvalue = "on";
        }
        else
        {
            $new_Floatingvalue = "off";
        }
//=================================================//
	    if(isset($_POST['Setting']) && $_POST['Setting'] == 'on') 
        {
            $new_Settingvalue = "on";
        }
        else
        {
            $new_Settingvalue = "off";
        }
//=================================================//
	    $data = [
    	    'ESP' => $new_espvalue,
    	    'Item' => $new_Itemvalue,
    	    'SilentAim' => $new_SilentAimvalue,
    	    'AIM' => $new_aimvalue,
    	    'BulletTrack' => $new_BulletTrackvalue,
    	    'Memory' => $new_Memoryvalue,
    	    'Floating' => $new_Floatingvalue,
    	    'Setting' => $new_Settingvalue
	    ];
	    $model->update($id,$data);
	    return redirect()->back()->with('msgSuccess', 'Mod Feature Stats Changed.');
    }
    
    private function passwd_act()
    {
        $current = $this->request->getPost('current');
        $password = $this->request->getPost('password');

        $user = $this->user;
        $currHash = create_password($current, false);
        $validation = Services::validation();

        if (!password_verify($currHash, $user->password)) {
            $msg = "Wrong current password.";
            $validation->setError('current', $msg);
        } elseif ($current == $password) {
            $msg = "Nothing to change.";
            $validation->setError('password', $msg);
        }

        $form_rules = [
            'current' => [
                'label' => 'current',
                'rules' => 'required|min_length[6]|max_length[45]',
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]',
            ],
            'password2' => [
                'label' => 'confirm',
                'rules' => 'required|min_length[6]|max_length[45]|matches[password]',
                'errors' => [
                    'matches' => '{field} not match, check the {field}.'
                ]
            ],
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Something wrong! Please check the form');
        } else {
            $newPassword = create_password($password);
            $this->model->update(session('userid'), ['password' => $newPassword]);
            return redirect()->back()->with('msgSuccess', 'Password Successfuly Changed.');
        }
    }
    
    private function fullname_act()
    {
        $user = $this->user;
        $newName = $this->request->getPost('fullname');

        if ($user->fullname == $newName) {
            $validation = Services::validation();
            $msg = "Nothing to change.";
            $validation->setError('fullname', $msg);
        }

        $form_rules = [
            'fullname' => [
                'label' => 'name',
                'rules' => 'required|alpha_space|min_length[4]|max_length[155]',
                'errors' => [
                    'alpha_space' => 'The {field} only allow alphabetical characters and spaces.'
                ]
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Failed! Please check the form');
        } else {
            $this->model->update(session('userid'), ['fullname' => esc($newName)]);
            return redirect()->back()->with('msgSuccess', 'Account Detail Successfuly Changed.');
        }
    }
}