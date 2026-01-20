@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="row g-0">

          <!-- SIDEBAR -->
          <div class="col-md-3 border-end p-4 bg-light">
            <h5 class="fw-semibold mb-1">Pengaturan</h5>
            <p class="small text-muted">
              Kelola profil dan keamanan akun jobseeker kamu.
            </p>

            <div class="nav flex-column nav-pills mt-3" role="tablist">
              <button class="nav-link {{ session('active_tab', 'profile') == 'profile' ? 'active' : '' }}" data-bs-toggle="pill" data-bs-target="#profile">
                👤 Profil Saya
              </button>
              <button class="nav-link {{ session('active_tab') == 'security' ? 'active' : '' }}" data-bs-toggle="pill" data-bs-target="#security">
                🔐 Keamanan Akun
              </button>
            </div>
          </div>

          <!-- CONTENT -->
          <div class="col-md-9 p-4">
            <div class="tab-content">

              {{-- ALERT --}}
              @if(session('success'))
                <div class="alert alert-success small">
                  {{ session('success') }}
                </div>
              @endif

              <!-- PROFIL -->
              <div class="tab-pane fade {{ session('active_tab', 'profile') == 'profile' ? 'show active' : '' }}" id="profile">
                <h6 class="fw-semibold mb-3">Informasi Pribadi</h6>

                <form method="POST" action="{{ route('jobseeker.settings.profile') }}">
                  @csrf

                  <div class="mb-3">
                    <label class="form-label">Nama lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"
                      name="name"
                      value="{{ old('name', auth()->user()->name) }}" required>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label">No. HP <span class="text-danger">*</span></label>
                      <input type="text" class="form-control"
                        name="phone"
                        value="{{ old('phone', auth()->user()->phone) }}" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Domisili <span class="text-danger">*</span></label>
                      <input type="text" class="form-control"
                        name="location"
                        value="{{ old('location', auth()->user()->jobseekerProfile->location ?? '') }}" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ringkasan Profil</label>
                    <textarea class="form-control" rows="3"
                      name="summary">{{ old('summary', auth()->user()->jobseekerProfile->summary ?? '') }}</textarea>
                    <small class="text-muted">Maksimal 500 karakter</small>
                  </div>

                  <div class="text-end">
                    <button class="btn btn-primary btn-sm">
                      Simpan Profil
                    </button>
                  </div>
                </form>
              </div>

              <!-- KEAMANAN -->
              <div class="tab-pane fade {{ session('active_tab') == 'security' ? 'show active' : '' }}" id="security">
                <h6 class="fw-semibold mb-3">Ubah Email</h6>
                <form method="POST" action="{{ route('jobseeker.settings.email') }}" class="mb-5 border-bottom pb-4">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label">Email Baru <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Saat Ini <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('current_password_email') is-invalid @enderror" name="current_password">
                    @error('current_password_email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="text-end">
                    <button class="btn btn-primary btn-sm">Simpan Email</button>
                  </div>
                </form>

                <h6 class="fw-semibold mb-3">Ubah Password</h6>

                <form method="POST" action="{{ route('jobseeker.settings.password') }}">
                  @csrf

                  <div class="mb-3">
                    <label class="form-label">Password saat ini <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                      name="current_password">
                    @error('current_password')
                      <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Password baru <span class="text-danger">*</span></label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password">
                      @error('password')
                        <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Konfirmasi password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control"
                        name="password_confirmation">
                    </div>
                  </div>

                  <div class="text-end">
                    <button class="btn btn-primary btn-sm">
                      Simpan Password
                    </button>
                  </div>
                </form>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@if(session('active_tab'))
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const triggerEl = document.querySelector('button[data-bs-target="#{{ session('active_tab') }}"]');
      if (triggerEl) {
        const tab = new bootstrap.Tab(triggerEl);
        tab.show();
      }
    });
  </script>
@endif
@endsection
