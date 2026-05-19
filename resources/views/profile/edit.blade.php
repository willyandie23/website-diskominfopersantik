@extends('backend.layouts.app')

@section('title', 'Edit Profile')

@push('styles')
    <style>
        .profile-header-card {
            background: linear-gradient(135deg, #4680ff 0%, #6e9fff 100%);
            border-radius: 14px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .profile-header-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .profile-header-card::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .profile-header-card h4 {
            color: #fff;
            margin: 0;
            font-weight: 600;
        }

        .profile-header-card p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar-wrapper img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.8);
            object-fit: cover;
        }

        .nav-pills-custom {
            background: #fff;
            border-radius: 12px;
            padding: 6px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.5rem;
            display: inline-flex;
            gap: 4px;
        }

        .nav-pills-custom .nav-link {
            border-radius: 8px;
            padding: 10px 20px;
            color: #5b6b79;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
        }

        .nav-pills-custom .nav-link.active {
            background: #4680ff;
            color: #fff;
            box-shadow: 0 4px 12px rgba(70, 128, 255, 0.3);
        }

        .nav-pills-custom .nav-link:not(.active):hover {
            background: #e8f0ff;
            color: #4680ff;
        }

        .card {
            border-radius: 14px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #5b6b79;
            font-size: 1.1rem;
        }

        .input-icon .form-control {
            padding-left: 42px;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e7eaee;
            padding: 0.7rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4680ff;
            box-shadow: 0 0 0 3px rgba(70, 128, 255, 0.12);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #5b6b79;
            z-index: 5;
        }

        .password-toggle:hover {
            color: #4680ff;
        }

        .strength-bar {
            height: 4px;
            border-radius: 4px;
            background: #e7eaee;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.4s ease, background 0.4s ease;
            width: 0%;
        }

        .tab-pane {
            animation: fadeInUp 0.4s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-stat {
            text-align: center;
            padding: 1rem;
            border-radius: 10px;
            background: #e8f0ff;
        }

        .info-stat h4 {
            color: #4680ff;
            font-weight: 700;
            margin: 0;
        }

        .info-stat small {
            color: #5b6b79;
            font-size: 0.8rem;
        }

        .delete-zone {
            border: 2px dashed #dc2626;
            border-radius: 14px;
            padding: 2rem;
            text-align: center;
            background: #fef2f2;
            transition: all 0.3s;
        }

        .delete-zone:hover {
            background: #fee2e2;
        }
    </style>
@endpush

@section('content')
    <!-- Profile Header -->
    <div class="profile-header-card d-flex align-items-center gap-4 flex-wrap">
        <div class="avatar-wrapper">
            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="Avatar">
        </div>
        <div>
            <h4>{{ $user->name }}</h4>
            <p>{{ $user->email }}</p>
            <div class="d-flex gap-2 mt-2">
                <span class="badge bg-light text-dark px-3 py-2" style="border-radius:8px;">
                    <i class="ti ti-shield-check me-1"></i>{{ $user->roles->first()->name ?? 'User' }}
                </span>
                <span class="badge bg-light text-dark px-3 py-2" style="border-radius:8px;">
                    <i class="ti ti-calendar me-1"></i>Bergabung {{ $user->created_at->translatedFormat('M Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-pills-custom" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#tab-profile">
                <i class="ti ti-user me-1"></i>Profil
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#tab-security">
                <i class="ti ti-lock me-1"></i>Keamanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#tab-danger">
                <i class="ti ti-alert-triangle me-1"></i>Zona Bahaya
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Profile Tab -->
        <div class="tab-pane fade show active" id="tab-profile">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-1">Informasi Profil</h6>
                            <small class="text-muted">Perbarui informasi profil dan alamat email akun Anda</small>
                        </div>
                        <div class="card-body">
                            @if (session('status') === 'profile-updated')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="ti ti-circle-check me-2"></i>Profil berhasil diperbarui.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <div class="input-icon">
                                            <i class="ti ti-user"></i>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}"
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-icon">
                                            <i class="ti ti-mail"></i>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="Avatar"
                                class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;">
                            <h6>{{ $user->name }}</h6>
                            <p class="text-muted small">{{ $user->email }}</p>
                        </div>
                    </div>
                    {{-- <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="mb-3">Informasi Akun</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="info-stat">
                                        <h4>{{ $user->created_at->diffInDays(now()) }}</h4>
                                        <small>Hari Aktif</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="info-stat">
                                        <h4>{{ $user->roles->first()->name ?? '-' }}</h4>
                                        <small>Role</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Security Tab -->
        <div class="tab-pane fade" id="tab-security">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-1">Ubah Kata Sandi</h6>
                            <small class="text-muted">Pastikan akun Anda menggunakan kata sandi yang kuat dan unik</small>
                        </div>
                        <div class="card-body">
                            @if (session('status') === 'password-updated')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="ti ti-circle-check me-2"></i>Kata sandi berhasil diperbarui.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                                    <div class="input-icon">
                                        <i class="ti ti-lock"></i>
                                        <input type="password"
                                            class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                            id="current_password" name="current_password">
                                        <span class="password-toggle" onclick="togglePassword('current_password')">
                                            <i class="ti ti-eye"></i>
                                        </span>
                                        @error('current_password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi Baru</label>
                                    <div class="input-icon">
                                        <i class="ti ti-lock-plus"></i>
                                        <input type="password"
                                            class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                            id="password" name="password" oninput="checkStrength(this.value)">
                                        <span class="password-toggle" onclick="togglePassword('password')">
                                            <i class="ti ti-eye"></i>
                                        </span>
                                        @error('password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="strength-bar">
                                        <div class="strength-bar-fill" id="strengthBar"></div>
                                    </div>
                                    <small class="text-muted" id="strengthText">Masukkan kata sandi baru</small>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                    <div class="input-icon">
                                        <i class="ti ti-lock-check"></i>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" oninput="checkMatch()">
                                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="ti ti-eye"></i>
                                        </span>
                                    </div>
                                    <small id="matchText"></small>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="this.closest('form').reset(); document.getElementById('strengthBar').style.width='0%'; document.getElementById('strengthText').textContent='Masukkan kata sandi baru'; document.getElementById('matchText').textContent='';">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-key me-1"></i>Ubah Kata Sandi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="ti ti-shield-check me-2 text-success"></i>Tips Keamanan</h6>
                            <div class="d-flex align-items-start gap-2 mb-3">
                                <i class="ti ti-check text-success mt-1"></i>
                                <small>Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol</small>
                            </div>
                            <div class="d-flex align-items-start gap-2 mb-3">
                                <i class="ti ti-check text-success mt-1"></i>
                                <small>Jangan gunakan kata sandi yang sama di layanan lain</small>
                            </div>
                            <div class="d-flex align-items-start gap-2 mb-3">
                                <i class="ti ti-check text-success mt-1"></i>
                                <small>Ganti kata sandi secara berkala setiap 3 bulan</small>
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <i class="ti ti-check text-success mt-1"></i>
                                <small>Jangan bagikan kata sandi kepada siapapun</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone Tab -->
        <div class="tab-pane fade" id="tab-danger">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="delete-zone">
                            <i class="ti ti-alert-triangle" style="font-size: 3rem; color: #dc2626;"></i>
                            <h5 class="mt-3 text-danger">Hapus Akun Permanen</h5>
                            <p class="text-muted mb-4">Tindakan ini tidak dapat dibatalkan. Semua data yang terkait dengan
                                akun Anda akan dihapus secara permanen.</p>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                                <i class="ti ti-trash me-1"></i>Hapus Akun Saya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Account -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; border:none;">
                <div class="modal-body text-center p-4">
                    <div
                        style="width:70px;height:70px;border-radius:50%;background:#fef2f2;display:inline-flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                        <i class="ti ti-alert-triangle" style="font-size:2rem;color:#dc2626;"></i>
                    </div>
                    <h5>Konfirmasi Hapus Akun</h5>
                    <p class="text-muted">Ketik <strong>HAPUS</strong> lalu masukkan kata sandi untuk mengkonfirmasi.</p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <input type="text" class="form-control text-center mb-3" id="deleteConfirmInput"
                            placeholder="Ketik HAPUS"
                            oninput="document.getElementById('btnDeleteAccount').disabled = this.value !== 'HAPUS'">
                        <input type="password" class="form-control text-center mb-3" name="password"
                            placeholder="Masukkan kata sandi Anda">
                        @error('password', 'userDeletion')
                            <div class="text-danger small mb-3">{{ $message }}</div>
                        @enderror
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="btnDeleteAccount" disabled>
                                <i class="ti ti-trash me-1"></i>Hapus Permanen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.parentElement.querySelector('.password-toggle i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ti ti-eye-off';
            } else {
                input.type = 'password';
                icon.className = 'ti ti-eye';
            }
        }

        // Password strength checker
        function checkStrength(val) {
            const bar = document.getElementById('strengthBar');
            const text = document.getElementById('strengthText');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [{
                    width: '0%',
                    color: '#e7eaee',
                    label: 'Masukkan kata sandi baru'
                },
                {
                    width: '25%',
                    color: '#dc2626',
                    label: 'Lemah'
                },
                {
                    width: '50%',
                    color: '#e58a00',
                    label: 'Cukup'
                },
                {
                    width: '75%',
                    color: '#4680ff',
                    label: 'Kuat'
                },
                {
                    width: '100%',
                    color: '#2ca87f',
                    label: 'Sangat Kuat'
                }
            ];
            bar.style.width = levels[score].width;
            bar.style.background = levels[score].color;
            text.textContent = levels[score].label;
            text.style.color = levels[score].color;
        }

        // Password match checker
        function checkMatch() {
            const pw = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const text = document.getElementById('matchText');
            if (!confirm) {
                text.textContent = '';
                return;
            }
            if (pw === confirm) {
                text.innerHTML = '<span style="color:#2ca87f;">✓ Kata sandi cocok</span>';
            } else {
                text.innerHTML = '<span style="color:#dc2626;">✗ Kata sandi tidak cocok</span>';
            }
        }
    </script>
@endpush
