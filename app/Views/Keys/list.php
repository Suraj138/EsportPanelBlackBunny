<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-6">
    <!-- Message Status -->
    <div class="mb-6">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    
    <section class="page-hero">
        <div class="hero-kicker">LOCKER</div>
        <h1>REGISTERED KEYS</h1>
        <p>Every license in the arena. Blur, reset, share.</p>
    </section>
    <div class="glass-card rounded-2xl p-6 sm:p-8 animate-fade-in-up">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
            <div class="flex items-center">
                <div class="gradient-bg w-12 h-12 rounded-xl flex items-center justify-center mr-4">
                    <span class="orb-core" style="width:36px;height:36px;font-size:10px">BB</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">KEYS REGISTERED</h2>
                    <button id="blur-out" class="text-sm text-gray-600 hover:text-purple-600 transition-colors mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                        Eye Protect
                    </button>
                </div>
            </div>
            
            <!-- Actions Dropdown -->
            <div class="relative">
                <button id="actions-menu-btn" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-500 hover:to-pink-500 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                    <span>Actions</span>
                </button>
                
                <div id="actions-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-100 z-10">
                    <div class="py-2">
                        <a href="<?= site_url('keys/download') ?>" class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-emerald-50 transition-all">
                            <span class="text-gray-700 font-medium">Download All Keys .txt</span>
                        </a>
                        <a href="<?= site_url('keys/download/unused') ?>" class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-emerald-50 transition-all">
                            <span class="text-gray-700 font-medium">Download Unused .txt</span>
                        </a>
                        <a href="<?= site_url('keys/generate') ?>" class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Generate Key</span>
                        </a>
                        
                        <div class="border-t border-gray-100 my-2"></div>
                        
                        <a href="<?= site_url('keys/deleteExp') ?>" class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Delete Expired Keys</span>
                        </a>
                        
                        <a href="<?= site_url('keys/deleteUnused') ?>" class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-orange-50 hover:to-yellow-50 transition-all">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Delete Unused Keys</span>
                        </a>

                        <!-- New: Delete All Keys Option -->
                        <a href="javascript:void(0)" onclick="confirmDeleteAllKeys()" class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-red-100 hover:to-red-50 text-red-600 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16M10 11v6m4-6v6"></path>
                            </svg>
                            <span class="font-medium">Delete All Keys</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- DataTable -->
        <?php if ($keylist) : ?>
            <div class="overflow-x-auto">
                <table id="datatable" class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Game</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User Keys</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Operator</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Devices</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Duration</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Expired</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php else : ?>
            <p class="text-center text-gray-500 py-8">Nothing keys to show</p>
        <?php endif; ?>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
    .key-sensi { filter: blur(5px); transition: filter 0.3s; }
</style>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
    const actionsBtn = document.getElementById('actions-menu-btn');
    const actionsMenu = document.getElementById('actions-menu');
    
    if (actionsBtn && actionsMenu) {
        actionsBtn.addEventListener('click', () => {
            actionsMenu.classList.toggle('hidden');
        });
        
        document.addEventListener('click', (e) => {
            if (!actionsBtn.contains(e.target) && !actionsMenu.contains(e.target)) {
                actionsMenu.classList.add('hidden');
            }
        });
    }
    
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: "<?= site_url('keys/api') ?>",
            columns: [
                { data: 'id', name: 'id_keys' },
                { data: 'game' },
                { 
                    data: 'user_key',
                    render: function(data, type, row, meta) {
                        var is_valid = (row.status == 'Active') ? "text-success" : "text-danger";
                        return `<span class="${is_valid} keyBlur key-sensi">${(row.user_key ? row.user_key : '&mdash;')}</span> `;
                    }
                },
                {
                    data: 'registrator',
                    render: function(data, type, row) {
                        return row.registrator ? `<span class="hud-chip">${row.registrator}</span>` : '<span class="muted">—</span>';
                    }
                },
                { 
                    data: 'devices',
                    render: function(data, type, row, meta) {
                        var totalDevice = (row.devices ? row.devices : 0);
                        var used = parseInt(totalDevice, 10) > 0;
                        var raw = row.devices_raw ? String(row.devices_raw).replace(/,/g, ' · ') : '';
                        var ids = (used && raw) ? `<small class="muted d-block">${raw}</small>` : '';
                        var ping = row.last_ping ? `<small class="muted d-block">PING ${row.last_ping}</small>` : '';
                        var state = used ? '<span class="hud-chip">USED</span>' : '<span class="muted">UNUSED</span>';
                        return `<span id="devMax-${row.user_key}">${totalDevice}/${row.max_devices}</span> ${state}${ids}${ping}`;
                    }
                },
                { 
                    data: 'duration',
                    render: function(data, type, row, meta) {
                        return row.duration;
                    }
                },
                { 
                    data: 'expired',
                    name: 'expired_date',
                    render: function(data, type, row, meta) {
                        return row.expired ? `<span class="badge text-dark">${row.expired}</span>` : '(not started yet)';
                    }
                },
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        var btnReset = `<button class="btn btn-outline-danger btn-sm" onclick="resetUserKey('${row.user_key}')" title="Reset HWID">HWID</button>`;
                        var btnalterOne = `<button class="btn btn-outline-warning btn-sm" onclick="resetUserKey1('${row.user_key}')" title="Delete key">DEL</button>`;
                        var btnEdits = `<a href="${window.location.origin}/keys/${row.id}" class="btn btn-outline-info btn-sm" title="Edit">EDIT</a>`;
                        var btnCopy = `<button class="btn btn-outline-success btn-sm" onclick="copyKey('${row.user_key}')" title="Copy">COPY</button>`;
                        var btnShare = `<button class="btn btn-outline-primary btn-sm" onclick="shareKey('${row.user_key}','${row.game}','${row.duration}')" title="Share">SHARE</button>`;
                        return `<div class="d-flex flex-wrap gap-1">${btnReset} ${btnalterOne} ${btnEdits} ${btnCopy} ${btnShare}</div>`;
                    }
                }
            ]
        });

        $("#blur-out").click(function() {
            if ($(".keyBlur").hasClass("key-sensi")) {
                $(".keyBlur").removeClass("key-sensi");
                $("#blur-out").html(`<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Eye Protect`);
            } else {
                $(".keyBlur").addClass("key-sensi");
                $("#blur-out").html(`<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg> Eye Protect`);
            }
        });
    });

    // New: Delete All Keys Confirmation Function
    function confirmDeleteAllKeys() {
        Swal.fire({
            title: 'Delete ALL Keys?',
            text: "This will permanently delete every single registered key. You cannot undo this!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Delete All!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('keys/deleteAll') ?>";
            }
        });
    }

    function resetUserKey1(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({ icon: 'info', title: 'Please wait...' });
                var api_url = "<?= site_url('keys/resetAll') ?>";
                $.getJSON(api_url, { userkey: keys, reset: 1 }, function(data, textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        if (data.registered) {
                            if (data.reset) {
                                $('#datatable').DataTable().ajax.reload(null, false);
                                Swal.fire('Deleted!', 'User key has been deleted.', 'success');
                            } else {
                                Swal.fire('Failed!', "You don't have any access to this user.", 'error');
                            }
                        } else {
                            Swal.fire('Failed!', "User key no longer exists.", 'error');
                        }
                    }
                }).fail(function() {
                    Swal.fire('Failed!', 'Delete request failed.', 'error');
                });
            }
        });
    }

    function copyKey(key) {
        if (navigator.clipboard) navigator.clipboard.writeText(key);
        else {
            var t = document.createElement('textarea');
            t.value = key; document.body.appendChild(t); t.select(); document.execCommand('copy'); t.remove();
        }
        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Key copied', showConfirmButton: false, timer: 1400 });
    }
    function shareKey(key, game, duration) {
        var text = 'BLACK BUNNY KEY\\nGame: ' + game + '\\nKey: ' + key + '\\nDuration: ' + duration;
        if (navigator.share) navigator.share({ title: 'BLACK BUNNY KEY', text: text });
        else copyKey(key);
    }
    function resetUserKey(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({ icon: 'info', title: 'Please wait...' });
                var base_url = window.location.origin;
                var api_url = `${base_url}/keys/reset`;
                $.getJSON(api_url, { userkey: keys, reset: 1 }, function(data, textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        if (data.registered) {
                            if (data.reset) {
                                $(`#devMax-${keys}`).html(`0/${data.devices_max}`);
                                Swal.fire('Reset!', 'Your device key has been reset.', 'success');
                            } else {
                                Swal.fire('Failed!', data.devices_total ? "You don't have any access to this user." : "User key devices already reset.", data.devices_total ? 'error' : 'warning');
                            }
                        } else {
                            Swal.fire('Failed!', "User key no longer exists.", 'error');
                        }
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>