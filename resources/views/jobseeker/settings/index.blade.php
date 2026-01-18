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
              <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#profile">
                👤 Profil Saya
              </button>
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#security">
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
              <div class="tab-pane fade show active" id="profile">
                <h6 class="fw-semibold mb-3">Informasi Pribadi</h6>

                <form method="POST" action="{{ route('jobseeker.settings.profile') }}">
                  @csrf

                  <div class="mb-3">
                    <label class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control"
                      name="name"
                      value="{{ old('name', auth()->user()->name) }}">
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label">No. HP</label>
                      <input type="text" class="form-control"
                        name="phone"
                        value="{{ old('phone', auth()->user()->phone) }}">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Domisili</label>
                      <input type="text" class="form-control"
                        name="location"
                        value="{{ old('location', auth()->user()->jobseekerProfile->location ?? '') }}">
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
              <div class="tab-pane fade" id="security">
                <h6 class="fw-semibold mb-3">Ubah Password</h6>

                <form method="POST" action="{{ route('jobseeker.settings.password') }}">
                  @csrf

                  <div class="mb-3">
                    <label class="form-label">Password saat ini</label>
                    <input type="password" class="form-control"
                      name="current_password">
                    @error('current_password')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Password baru</label>
                      <input type="password" class="form-control"
                        name="password">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Konfirmasi password</label>
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
@endsection
