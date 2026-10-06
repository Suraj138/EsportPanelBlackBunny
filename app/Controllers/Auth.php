<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

class Auth extends BaseController
{
    protected $user;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    function getUserIP()
    {
        return clientIp();
    }

    public function index()
    {
        return redirect()->to('dashboard');
    }

    public function login()
    {
        if (session()->has('userid'))
            return redirect()->to('dashboard')->with('msgSuccess', 'Login Successful!');

        if ($this->request->getPost())
            return $this->login_action();
        $data = [
            'title' => 'Login',
            'validation' => Services::validation(),
        ];
        return view('Auth/login', $data);
    }

    public function register()
    {
        if (session()->has('userid'))
            return redirect()->to('dashboard')->with('msgSuccess', 'Login Successful!');

        if ($this->request->getPost())
            return $this->register_action();
        $data = [
            'title' => 'Register',
            'validation' => Services::validation(),
            'user_ip' => $this->getUserIP(),
        ];
        return view('Auth/register', $data);
    }

    private function login_action()
    {
        if (!hudRateLimit('login', 8, 300)) {
            return redirect()->route('login')->withInput()->with('msgDanger', 'Too many attempts. Wait 5 minutes.');
        }
        $usernam = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $stay_log = $this->request->getPost('stay_log');

        $form_rules = [
            'username' => [
                'label' => 'username',
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[25]',
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]',
            ],
            'stay_log' => [
                'rules' => 'permit_empty|max_length[3]'
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        }

        $validation = Services::validation();
        $cekUser = $this->userModel->getUser($usernam, 'username');
        $hashPassword = create_password($password, false);
        if (!$cekUser || !password_verify($hashPassword, $cekUser->password)) {
            $validation->setError('password', 'Wrong username or password.');
            return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        }

        $time = new \CodeIgniter\I18n\Time;
        $now = $time::now();
        $expired = !empty($cekUser->expiration_date) && $now->isAfter($cekUser->expiration_date);
        $inactive = isset($cekUser->status) && (int) $cekUser->status !== 1;

        if ($expired || $inactive) {
            if ($expired) {
                $this->userModel->update($cekUser->id_users, ['status' => 0]);
            }
            writeAudit('login_denied', $expired ? 'expired' : 'inactive', $cekUser->username);
            return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Expired</strong> Please Renew Your Account to Login.');
        }

        $this->ensureBoundColumn();
        $print = hudDevicePrint();
        $limit = isset($cekUser->login_devices) ? max(1, (int) $cekUser->login_devices) : 99;
        $bound = [];
        if (!empty($cekUser->bound_logins)) {
            $decoded = json_decode((string) $cekUser->bound_logins, true);
            if (is_array($decoded)) {
                $bound = $decoded;
            }
        }
        if (!in_array($print, $bound, true)) {
            if (count($bound) >= $limit) {
                writeAudit('login_denied', 'device limit ' . $limit, $cekUser->username);
                return redirect()->route('login')->withInput()->with('msgDanger', 'Device limit reached. Owner must reset bound logins.');
            }
            $bound[] = $print;
            $this->userModel->update($cekUser->id_users, ['bound_logins' => json_encode(array_values($bound))]);
        }
        hudBindCookie($print);

        $data = [
            'userid' => $cekUser->id_users,
            'unames' => $cekUser->username,
            'time_login' => $stay_log ? $now->addHours(24) : $now->addMinutes(30),
            'time_since' => $now,
            'welcome_toast' => 1,
        ];
        session()->set($data);
        writeAudit('login', 'portal access device=' . $print, $cekUser->username);
        $phpmsg = $cekUser->expiration_date;
        $expmsg = "Account Expires on : $phpmsg";
        return redirect()->to('dashboard')->with('msgSuccess', $expmsg);
    }

    public function register_action()
    {
        if (!hudRateLimit('register', 6, 600)) {
            return redirect()->route('register')->withInput()->with('msgDanger', 'Too many attempts. Wait and retry.');
        }
        $email = $this->request->getPost('email');
        $userna = $this->request->getPost('username');
        $fullname = $this->request->getPost('fullname');
        $password = $this->request->getPost('password');
        $referral = $this->request->getPost('referral');

        $form_rules = [
            'email' => [
                'label' => 'email',
                'rules' => 'required|min_length[13]|max_length[40]|valid_email'
            ],
            'username' => [
                'label' => 'username',
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[25]|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'The {field} has been taken.'
                ]
            ],
            'fullname' => [
                'label' => 'fullname',
                'rules' => 'required|alpha_numeric_space|min_length[4]|max_length[25]|is_unique[users.fullname]',
                'errors' => [
                    'is_unique' => 'The {field} has been taken.'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]',
            ],
            'password2' => [
                'label' => 'password',
                'rules' => 'required|min_length[6]|max_length[45]|matches[password]',
                'errors' => [
                    'matches' => '{field} not match, check the {field}.'
                ]
            ],
            'referral' => [
                'label' => 'referral',
                'rules' => 'required|min_length[6]|alpha_numeric',
            ]
        ];

        if (!$this->validate($form_rules)) {
            return redirect()->route('register')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        }

        $mCode = new CodeModel();
        $rCheck = $mCode->checkCode($referral);
        $validation = Services::validation();
        if (!$rCheck) {
            $validation->setError('referral', 'Wrong referral, please try again.');
            return redirect()->route('register')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        }
        if ($rCheck->used_by) {
            $validation->setError('referral', "Wrong referral, code has been used &middot; $rCheck->used_by.");
            return redirect()->route('register')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        }

        $hashPassword = create_password($password);
        $level = is_array($rCheck->level) ? (int) reset($rCheck->level) : (int) $rCheck->level;
        if ($level < 1 || $level > 3) {
            $level = 3;
        }
        $expiration = $rCheck->acc_expiration ?: date('Y-m-d H:i:s', strtotime('+30 days'));
        $loginDevices = isset($rCheck->login_devices) ? (int) $rCheck->login_devices : 1;
        $refAccounts = isset($rCheck->ref_accounts) ? (int) $rCheck->ref_accounts : 0;
        $data_register = [
            'email' => $email,
            'username' => $userna,
            'fullname' => $fullname,
            'level' => $level,
            'password' => $hashPassword,
            'saldo' => $rCheck->set_saldo ?: 0,
            'uplink' => $rCheck->created_by,
            'user_ip' => clientIp(),
            'expiration_date' => $expiration,
            'status' => 1,
            'login_devices' => $loginDevices < 1 ? 1 : $loginDevices,
            'ref_accounts' => $refAccounts < 0 ? 0 : $refAccounts,
            'reset_link_token' => '',
            'exp_date' => '',
            'role' => $level,
        ];
        $ids = $this->userModel->insert($data_register, true);
        if ($ids) {
            $mCode->useReferral($referral, $userna);
            writeAudit('register', "referral=$referral level=$level", $userna);
            return redirect()->to('login')->with('msgSuccess', 'Register Successfuly!');
        }
        return redirect()->route('register')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
    }

    public function recover()
    {
        if ($this->request->getPost()) {
            if (!hudRateLimit('recover', 5, 600)) {
                return redirect()->to('recover')->with('msgDanger', 'Too many recovery attempts.');
            }
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $cekUser = $this->userModel->getUser($username, 'username');
            if ($cekUser && isset($cekUser->email) && strtolower((string) $cekUser->email) === strtolower((string) $email)) {
                $token = bin2hex(random_bytes(16));
                $this->userModel->update($cekUser->id_users, [
                    'reset_link_token' => $token,
                    'exp_date' => date('Y-m-d H:i:s', strtotime('+1 hour')),
                ]);
                session()->set([
                    'recover_uid' => (int) $cekUser->id_users,
                    'recover_until' => date('Y-m-d H:i:s', strtotime('+15 minutes')),
                ]);
                writeAudit('recover_request', 'identity verified', $cekUser->username);
                return redirect()->to('recover/reset')->with('msgSuccess', 'Identity verified. Set a new cryptographic key.');
            }
            return redirect()->to('recover')->withInput()->with('msgDanger', 'Identity not found. Check operator alias and email.');
        }
        $data = [
            'title' => 'Recover Key',
            'validation' => Services::validation(),
        ];
        return view('Auth/recover', $data);
    }

    public function recoverReset($token = '')
    {
        $uid = (int) session()->get('recover_uid');
        $until = (string) session()->get('recover_until');
        $cekUser = null;
        if ($uid && $until && strtotime($until) > time()) {
            $cekUser = $this->userModel->getUser($uid);
            if ($cekUser) {
                $cekUser = [
                    'id_users' => $cekUser->id_users,
                    'username' => $cekUser->username,
                ];
            }
        }
        $token = preg_replace('/[^a-f0-9]/', '', (string) $token);
        if (!$cekUser && $token !== '') {
            $row = $this->userModel->where('reset_link_token', $token)->first();
            if ($row && !empty($row['exp_date']) && strtotime((string) $row['exp_date']) > time()) {
                $cekUser = [
                    'id_users' => $row['id_users'],
                    'username' => $row['username'],
                ];
                session()->set([
                    'recover_uid' => (int) $row['id_users'],
                    'recover_until' => date('Y-m-d H:i:s', strtotime('+15 minutes')),
                ]);
            }
        }
        if (!$cekUser) {
            session()->remove(['recover_uid', 'recover_until']);
            return redirect()->to('recover')->with('msgDanger', 'Recovery session is invalid or expired.');
        }

        if ($this->request->getPost()) {
            $form_rules = [
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
                return redirect()->back()->withInput()->with('msgDanger', 'Please check the form.');
            }
            $newPassword = create_password($this->request->getPost('password'));
            $this->userModel->update($cekUser['id_users'], [
                'password' => $newPassword,
                'reset_link_token' => '',
                'exp_date' => '',
            ]);
            session()->remove(['recover_uid', 'recover_until']);
            writeAudit('recover_reset', 'password changed', $cekUser['username']);
            return redirect()->to('login')->with('msgSuccess', 'Cryptographic key updated. Authenticate with the new key.');
        }

        $data = [
            'title' => 'Reset Key',
            'validation' => Services::validation(),
        ];
        return view('Auth/recover_reset', $data);
    }

    public function logout()
    {
        if (session()->has('userid')) {
            writeAudit('logout', 'portal exit', session('unames'));
            $unset = ['userid', 'unames', 'time_login', 'time_since', 'welcome_toast'];
            session()->remove($unset);
            session()->setFlashdata('msgSuccess', 'Logout successfuly.');
        }
        return redirect()->to('login');
    }

    private function ensureBoundColumn()
    {
        try {
            $db = \Config\Database::connect();
            if (!$db->fieldExists('bound_logins', 'users')) {
                $db->query('ALTER TABLE users ADD COLUMN bound_logins TEXT NULL');
            }
        } catch (\Throwable $e) {
        }
    }
}
