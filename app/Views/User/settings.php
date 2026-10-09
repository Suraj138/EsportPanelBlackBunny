<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>



<style>
    .gradient-bg { background: linear-gradient(135deg, #083048 0%, #00ffd0 100%); }
    .gradient-bg-2 { background: linear-gradient(135deg, #2a0818 0%, #ff2d6a 100%); }
    .gradient-bg-3 { background: linear-gradient(135deg, #071428 0%, #2d7dff 100%); }
    .gradient-bg-4 { background: linear-gradient(135deg, #102008 0%, #b6ff3b 100%); }
    
    .input-field {
        transition: all 0.3s ease;
    }
    
    .input-field:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-gradient-2 {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        transition: all 0.3s ease;
    }
    
    .btn-gradient-2:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(67, 233, 123, 0.4);
    }
</style>

<div class="container-fluid px-4 py-6">
    <section class="page-hero">
        <div class="hero-kicker">OPERATOR</div>
        <h1>ACCOUNT SETTINGS</h1>
        <p>Swap cryptographic key, identity alias, and Owner 2FA. Bot bind lives on Telegram.</p>
    </section>
    <div class="mb-6"><?= $this->include('Layout/msgStatus') ?></div>
    <?php if ((int) $user->level == 1) : ?>
    <div class="glass-card rounded-2xl p-6 mb-6">
        <h2>OWNER 2FA</h2>
        <?php if (!empty($otp_secret)) : ?>
            <p class="muted">Armed. Scan QR in Google Authenticator / Aegis.</p>
            <img class="otp-qr" alt="2FA QR" src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=<?= rawurlencode($otp_uri) ?>">
            <p class="hud-chip" style="margin:10px 0"><?= esc($otp_secret) ?></p>
            <p class="muted" style="word-break:break-all"><?= esc($otp_uri) ?></p>
            <?= form_open('settings') ?>
                <input type="hidden" name="otp_disable" value="1">
                <div class="field"><label>CONFIRM CODE</label><input name="otp_code" maxlength="6" placeholder="000000"></div>
                <button class="submit" type="submit">DISARM 2FA</button>
            <?= form_close() ?>
        <?php else : ?>
            <p class="muted">Not armed. Enable TOTP for owner portal login.</p>
            <?= form_open('settings') ?>
                <input type="hidden" name="otp_enable" value="1">
                <button class="submit" type="submit">ARM OWNER 2FA</button>
            <?= form_close() ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <p class="muted mb-6">Bot bind: <a href="<?= site_url('telegram') ?>" style="color:#00ffd0">Telegram Bot</a></p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Change Password Card -->
        <div class="glass-card rounded-2xl p-8 animate-fade-in-left" style="animation-delay: 0.2s">
            <div class="flex items-center mb-6">
                <div class="gradient-bg w-14 h-14 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Change Password</h2>
                    <p class="text-sm text-gray-600">Update your password to keep your account secure</p>
                </div>
            </div>
            
            <?= form_open() ?>
            <input type="hidden" name="password_form" value="1">
            
            <div class="space-y-5">
                <!-- Current Password -->
                <div>
                    <label for="current" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            Current Password
                        </div>
                    </label>
                    <input type="password" name="current" id="current" 
                           class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500" 
                           placeholder="Enter your current password">
                    <?php if ($validation->hasError('current')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('current') ?></small>
                    <?php endif; ?>
                </div>
                
                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            New Password
                        </div>
                    </label>
                    <input type="password" name="password" id="password" 
                           class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500" 
                           placeholder="Enter your new password">
                    <?php if ($validation->hasError('password')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                
                <!-- Confirm Password -->
                <div>
                    <label for="password2" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Confirm Password
                        </div>
                    </label>
                    <input type="password" name="password2" id="password2" 
                           class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500" 
                           placeholder="Confirm your new password">
                    <?php if ($validation->hasError('password2')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('password2') ?></small>
                    <?php endif; ?>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="submit w-full py-3 px-6">
                        LOCK NEW KEY
                    </button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
        
        <!-- Account Information Card -->
        <div class="glass-card rounded-2xl p-8 animate-fade-in-right" style="animation-delay: 0.3s">
            <div class="flex items-center mb-6">
                <div class="gradient-bg-4 w-14 h-14 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Account Information</h2>
                    <p class="text-sm text-gray-600">Update your personal details</p>
                </div>
            </div>
            
            <?= form_open() ?>
            <input type="hidden" name="fullname_form" value="1">
            
            <div class="space-y-5">
                <!-- Full Name -->
                <div>
                    <label for="fullname" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Full Name
                        </div>
                    </label>
                    <input type="text" name="fullname" id="fullname" 
                           class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-green-500" 
                           placeholder="Enter your full name" 
                           value="<?= old('fullname') ?: ($user->fullname ?: '') ?>">
                    <?php if ($validation->hasError('fullname')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('fullname') ?></small>
                    <?php endif; ?>
                </div>
                
                <!-- User Info Display -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </span>
                        <span class="text-sm font-semibold text-gray-800"><?= $user->email ?></span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Username
                        </span>
                        <span class="text-sm font-semibold text-gray-800"><?= $user->username ?></span>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="submit w-full py-3 px-6">
                        LOCK IDENTITY
                    </button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
    
    <!-- Additional Settings Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <!-- Security Tips Card -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in-up" style="animation-delay: 0.4s">
            <div class="flex items-center mb-4">
                <div class="gradient-bg-2 w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Security Tips</h3>
            </div>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Use a strong, unique password
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Change password regularly
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Never share your credentials
                </li>
            </ul>
        </div>
        
        <!-- Account Stats Card -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in-up" style="animation-delay: 0.5s">
            <div class="flex items-center mb-4">
                <div class="gradient-bg-3 w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Account Stats</h3>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Account Level</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-xs font-semibold"><?= getLevel($user->level) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Balance</span>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-semibold">₹<?= $user->saldo ?></span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions Card -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in-up" style="animation-delay: 0.6s">
            <div class="flex items-center mb-4">
                <div class="gradient-bg w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Quick Actions</h3>
            </div>
            <div class="space-y-2">
                <a href="<?= site_url('dashboard') ?>" class="flex items-center text-sm text-gray-700 hover:text-purple-600 transition-colors py-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Go to Dashboard
                </a>
                <a href="<?= base_url('keys') ?>" class="flex items-center text-sm text-gray-700 hover:text-purple-600 transition-colors py-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    Manage Keys
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>