@extends('layouts.app')

@section('title', 'Profil Perusahaan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0 p-4 p-md-5">
            <div class="row g-4">

                <!-- KIRI: INFO UTAMA -->
                <div class="col-md-4 text-center">
                    <img
                        src="https://via.placeholder.com/300x300.png?text=Company"
                        class="rounded-circle mb-3"
                        width="140"
                        height="140"
                        style="object-fit: cover;"
                    >

                    <h3 class="fw-semibold mb-1">
                        {{ $profile->company_name }}
                    </h3>

                    @if($profile->industry)
                        <span class="badge bg-primary-subtle text-primary">
                            {{ $profile->industry }}
                        </span>
                    @endif

                    @if($profile->location)
                        <p class="text-muted small mt-2">
                            {{ $profile->location }}
                        </p>
                    @endif

                    <a href="{{ route('employer.index') }}"
                       class="btn btn-primary btn-sm mt-3">
                        Edit Profil Perusahaan
                    </a>
                </div>

                <!-- KANAN: DETAIL -->
                <div class="col-md-8">

                    <!-- Tentang -->
                    <div class="mb-4">
                        <div class="text-uppercase text-muted small fw-semibold mb-1">
                            Tentang Perusahaan
                        </div>
                        <p class="mb-0">
                            {{ $profile->description ?? 'Belum menambahkan deskripsi perusahaan.' }}
                        </p>
                    </div>

                    <!-- Info Perusahaan -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Industri</div>
                            <div>{{ $profile->industry ?? '-' }}</div>
                        </div>

                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Ukuran Perusahaan</div>
                            <div>{{ $profile->size ?? '-' }}</div>
                        </div>

                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Tahun Berdiri</div>
                            <div>{{ $profile->year_founded ?? '-' }}</div>
                        </div>

                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Lokasi</div>
                            <div>{{ $profile->location ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Kontak & Link -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Website</div>
                            @if($profile->website)
                                <a href="{{ $profile->website }}" target="_blank">
                                    {{ $profile->website }}
                                </a>
                            @else
                                -
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Email Rekrutmen</div>
                            <div>{{ $profile->recruitment_email ?? '-' }}</div>
                        </div>

                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">LinkedIn</div>
                            @if($profile->linkedin_link)
                                <a href="{{ $profile->linkedin_link }}" target="_blank">
                                    {{ $profile->linkedin_link }}
                                </a>
                            @else
                                -
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="text-uppercase text-muted small">Instagram</div>
                            @if($profile->instagram_link)
                                <a href="{{ $profile->instagram_link }}" target="_blank">
                                    {{ $profile->instagram_link }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <!-- Budaya -->
                    <div class="mb-4">
                        <div class="text-uppercase text-muted small fw-semibold mb-1">
                            Budaya & Cara Kerja
                        </div>
                        <p class="mb-0">
                            {{ $profile->culture ?? 'Belum menambahkan budaya perusahaan.' }}
                        </p>
                    </div>

                    @if(auth()->id() === $profile->user_id && (!$profile->industry || !$profile->description || !$profile->location))
                        <div class="alert alert-info border-0 rounded-4 p-4 mt-4">
                            <h6 class="fw-bold mb-2">🚀 Lengkapi Profil Perusahaan Kamu!</h6>
                            <p class="small mb-3">Profil yang lengkap membantu meningkatkan kepercayaan calon pelamar dan mempermudah rekrutmen.</p>
                            <a href="{{ route('employer.index') }}" class="btn btn-info btn-sm text-white">Lengkapi Sekarang</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
