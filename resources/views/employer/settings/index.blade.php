<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengaturan Akun - Pentawork</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f4f6f9;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .settings-wrapper {
            margin-top: 32px;
            margin-bottom: 32px;
        }

        .settings-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 14px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .settings-sidebar {
            background-color: #f9fafb;
            border-right: 1px solid #e5e7eb;
            min-height: 100%;
        }

        .settings-title {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .nav-settings .nav-link {
            border-radius: 999px;
            font-size: 0.9rem;
            padding: 8px 14px;
            color: #4b5563;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-settings .nav-link.active {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }

        .nav-settings .nav-link span.icon-circle {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        .section-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .section-heading {
            font-size: 1.02rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-text-small {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .badge-soft {
            border-radius: 999px;
            font-size: 0.72rem;
            padding: 3px 9px;
        }

        .btn-penta-primary {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: none;
        }

        .btn-penta-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #4338ca);
        }

        .btn-danger-soft {
            background-color: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .btn-danger-soft:hover {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .danger-zone {
            border-radius: 12px;
            border: 1px solid #fecaca;
            background-color: #fef2f2;
        }
    </style>
</head>

<body>
    <div class="container settings-wrapper">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card settings-card">
                    <div class="row g-0">
                        <!-- SIDEBAR -->
                        <div class="col-md-3 settings-sidebar p-3 p-md-4">
                            <div class="mb-4">
                                <h1 class="settings-title mb-1">Pengaturan</h1>
                                <p class="form-text-small mb-0">
                                    Atur profil perusahaan dan keamanan akun employer Pentawork kamu.
                                </p>
                            </div>

                            <div class="nav flex-column nav-pills nav-settings" id="settings-tab" role="tablist">
                                <button class="nav-link active" id="tab-company-profile" data-bs-toggle="pill"
                                    data-bs-target="#pane-company-profile" type="button" role="tab"
                                    aria-controls="pane-company-profile" aria-selected="true">
                                    <span class="icon-circle bg-primary-subtle text-primary">🏢</span>
                                    Profil Perusahaan
                                </button>
                                <button class="nav-link" id="tab-security" data-bs-toggle="pill"
                                    data-bs-target="#pane-security" type="button" role="tab"
                                    aria-controls="pane-security" aria-selected="false">
                                    <span class="icon-circle bg-danger-subtle text-danger">🛡️</span>
                                    Keamanan Akun
                                </button>
                            </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="col-md-9 p-3 p-md-4">
                            <div class="tab-content" id="settings-tabContent">
                                <!-- TAB PROFIL PERUSAHAAN -->
                                <div class="tab-pane fade show active" id="pane-company-profile" role="tabpanel"
                                    aria-labelledby="tab-company-profile">
                                    <div class="mb-3">
                                        <div class="section-label">Profil perusahaan</div>
                                        <h2 class="section-heading">Informasi utama perusahaan</h2>
                                        <p class="form-text-small">
                                            Data ini akan tampil di halaman profil perusahaan dan setiap lowongan yang
                                            kamu posting.
                                        </p>
                                    </div>

                                    <form method="POST" action="{{ route('employer.settings.profile') }}">
                                        @csrf
                                        <div class="row g-3 mb-3">
                                            <div class="col-sm-8">
                                                <label class="form-label">Nama perusahaan</label>
                                                <input type="text" name="company_name" class="form-control"
                                                    value="{{ old('company_name', $employer->employerProfile->company_name ?? $employer->name) }}" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Industri</label>
                                                <select name="industry" class="form-select">
                                                    <option value="">Pilih Industri</option>
                                                    <option {{ (old('industry', $employer->employerProfile->industry ?? '') == 'Teknologi Informasi') ? 'selected' : '' }}>Teknologi Informasi</option>
                                                    <option {{ (old('industry', $employer->employerProfile->industry ?? '') == 'Finansial') ? 'selected' : '' }}>Finansial</option>
                                                    <option {{ (old('industry', $employer->employerProfile->industry ?? '') == 'Kesehatan') ? 'selected' : '' }}>Kesehatan</option>
                                                    <option {{ (old('industry', $employer->employerProfile->industry ?? '') == 'Pendidikan') ? 'selected' : '' }}>Pendidikan</option>
                                                    <option {{ (old('industry', $employer->employerProfile->industry ?? '') == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Ukuran perusahaan</label>
                                                <select name="size" class="form-select">
                                                    <option value="">Pilih Ukuran</option>
                                                    <option {{ (old('size', $employer->employerProfile->size ?? '') == '1–10 karyawan') ? 'selected' : '' }}>1–10 karyawan</option>
                                                    <option {{ (old('size', $employer->employerProfile->size ?? '') == '11–50 karyawan') ? 'selected' : '' }}>11–50 karyawan</option>
                                                    <option {{ (old('size', $employer->employerProfile->size ?? '') == '51–200 karyawan') ? 'selected' : '' }}>51–200 karyawan</option>
                                                    <option {{ (old('size', $employer->employerProfile->size ?? '') == '201–500 karyawan') ? 'selected' : '' }}>201–500 karyawan</option>
                                                    <option {{ (old('size', $employer->employerProfile->size ?? '') == '500+ karyawan') ? 'selected' : '' }}>500+ karyawan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Tahun berdiri</label>
                                                <input type="number" name="year_founded" class="form-control" placeholder="2024" 
                                                    value="{{ old('year_founded', $employer->employerProfile->year_founded ?? '') }}" />
                                            </div>
                                        </div>

                                         <div class="mb-3">
                                            <label class="form-label">Lokasi utama (HQ)</label>
                                            <input type="text" name="location" class="form-control"
                                                placeholder="Surabaya, Jawa Timur, Indonesia" 
                                                value="{{ old('location', $employer->employerProfile->location ?? '') }}" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi singkat perusahaan</label>
                                            <textarea name="description" class="form-control" rows="4"
                                                placeholder="Ceritakan secara singkat tentang perusahaan...">{{ old('description', $employer->employerProfile->description ?? '') }}</textarea>
                                            <div class="form-text-small mt-1">
                                                Maksimal 500 karakter. Gunakan bahasa yang jelas dan langsung.
                                            </div>
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Website perusahaan</label>
                                                <input type="url" name="website" class="form-control"
                                                    placeholder="https://pentawork.id" 
                                                    value="{{ old('website', $employer->employerProfile->website ?? '') }}" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Email rekrutmen utama</label>
                                                <input type="email" name="recruitment_email" class="form-control"
                                                    placeholder="careers@pentawork.id" 
                                                    value="{{ old('recruitment_email', $employer->employerProfile->recruitment_email ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tautan media sosial</label>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <input type="url" name="linkedin_link" class="form-control"
                                                        placeholder="LinkedIn perusahaan" 
                                                        value="{{ old('linkedin_link', $employer->employerProfile->linkedin_link ?? '') }}" />
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="url" name="instagram_link" class="form-control"
                                                        placeholder="Instagram / lainnya" 
                                                        value="{{ old('instagram_link', $employer->employerProfile->instagram_link ?? '') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Budaya & cara kerja (opsional)</label>
                                            <textarea name="culture" class="form-control" rows="3"
                                                placeholder="Contoh: Kami menerapkan hybrid working...">{{ old('culture', $employer->employerProfile->culture ?? '') }}</textarea>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                                                Batal
                                            </a>
                                             <button type="submit" class="btn btn-penta-primary text-white btn-sm">Simpan perubahan</button>

                                        </div>
                                    </form>
                                </div>

                                <!-- TAB KEAMANAN AKUN -->
                                <div class="tab-pane fade" id="pane-security" role="tabpanel"
                                    aria-labelledby="tab-security">
                                    <div class="mb-3">
                                        <div class="section-label">Keamanan</div>
                                        <h2 class="section-heading">Keamanan akun employer</h2>
                                        <p class="form-text-small">
                                            Atur password, sesi login aktif, dan opsi keamanan tambahan akun Pentawork.
                                        </p>
                                    </div>

                                    <!-- Ubah email login -->
                                    <form class="mb-4" method="POST" action="{{ route('employer.settings.password') }}">
                                        @csrf
                                        <h6 class="mb-2">Email login</h6>
                                        <p class="form-text-small mb-2">
                                            Email ini digunakan untuk login dan menerima notifikasi penting.
                                        </p>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Email saat ini</label>
                                                <input type="email" class="form-control" value="{{ $employer->email }}" 
                                                    disabled />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email baru</label>
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $employer->email) }}" />
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                Kirim link verifikasi
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Ubah password -->
                                    <form class="mb-4" method="POST" action="{{ route('employer.settings.password') }}">
                                        @csrf
                                        <h6 class="mb-2">Ubah password</h6>
                                        <p class="form-text-small mb-2">
                                            Gunakan password yang kuat minimal 8 karakter dengan kombinasi huruf besar,
                                            kecil, angka, dan simbol.
                                        </p>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Password saat ini</label>
                                                <input type="password" name="current_password" class="form-control" placeholder="Password saat ini" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Password baru</label>
                                                <input type="password" name="password" class="form-control" placeholder="Password baru" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Konfirmasi password baru</label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" />
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-penta-primary text-white btn-sm">Simpan password</button>
                                        </div>
                                    </form>

                                    <!-- Login & sesi -->

                                    <!-- END TAB KEAMANAN -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>