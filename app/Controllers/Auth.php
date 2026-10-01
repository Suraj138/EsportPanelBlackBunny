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
            'need_otp' => session()->getFlashdata('need_otp') ? true : false,
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
                'rules' => 'required|alpha_numeric|min_length[4]|max_length[25]|is_not_unique[users.username]',
                'errors' => [
                    'is_not_unique' => 'The {field} is not registered.'
                ]
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
        if (!$cekUser) {
            return redirect()->route('login')->withInput()->with('msgDanger', '<strong>Failed</strong> Please check the form.');
        }

        $hashPassword = create_password($password, false);
        if (!password_verify($hashPassword, $cekUser->password)) {
            $validation->setError('password', 'Wrong password, please try again.');
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

        $otpSecret = isset($cekUser->otp_secret) ? trim((string) $cekUser->otp_secret) : '';
        if ($otpSecret !== '') {
            $otp = preg_replace('/\D+/', '', (string) $this->request->getPost('otp_code'));
            if (!totpVerify($otpSecret, $otp)) {
                session()->setFlashdata('need_otp', 1);
                return redirect()->route('login')->withInput()->with('msgDanger', 'Owner 2FA code required.');
            }
        }

        $data = [
            'userid' => $cekUser->id_users,
            'unames' => $cekUser->username,
            'time_login' => $stay_log ? $now->addHours(24) : $now->addMinutes(30),
            'time_since' => $now,
            'welcome_toast' => 1,
        ];
        session()->set($data);
        writeAudit('login', 'portal access', $cekUser->username);
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
                writeAudit('recover_request', 'identity verified', $cekUser->username);
                return redirect()->to('recover/reset/' . $token)->with('msgSuccess', 'Identity verified. Set a new cryptographic key.');
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
        $token = preg_replace('/[^a-f0-9]/', '', (string) $token);
        $cekUser = $token ? $this->userModel->where('reset_link_token', $token)->first() : null;
        if (!$cekUser) {
            return redirect()->to('recover')->with('msgDanger', 'Recovery link is invalid or expired.');
        }
        if (!empty($cekUser['exp_date']) && strtotime($cekUser['exp_date']) < time()) {
            return redirect()->to('recover')->with('msgDanger', 'Recovery link expired. Request a new one.');
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
            writeAudit('recover_reset', 'password changed', $cekUser['username']);
            return redirect()->to('login')->with('msgSuccess', 'Cryptographic key updated. Authenticate with the new key.');
        }

        $data = [
            'title' => 'Reset Key',
            'validation' => Services::validation(),
            'token' => $token,
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
}
