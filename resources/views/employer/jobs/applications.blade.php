@extends('layouts.app')

@section('title', 'Pelamar Lowongan')

@section('content')

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Pelamar Lowongan</h4>
            <small class="text-muted">
                Lowongan: <strong>{{ $job->title }}</strong>
            </small>
        </div>

        <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Pelamar</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $application->jobseeker->name }}
                            </td>

                            <td>
                                {{ $application->jobseeker->email }}
                            </td>

                            <td>
                                @if($application->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($application->status === 'accepted')
                                    <span class="badge bg-success">Diterima</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    {{-- Terima --}}
                                    <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button class="btn btn-sm btn-success" {{ $application->status === 'accepted' ? 'disabled' : '' }}>
                                            Terima
                                        </button>
                                    </form>

                                    {{-- Tolak --}}
                                    <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="btn btn-sm btn-danger" {{ $application->status === 'rejected' ? 'disabled' : '' }}>
                                            Tolak
                                        </button>
                                    </form>

                                    @php
                                        $phone = $application->jobseeker->phone;
                                        $whatsappUrl = $phone ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $phone) : null;
                                        $mailtoUrl = 'mailto:' . $application->jobseeker->email;
                                    @endphp

                                    @if($phone)
                                        <a href="{{ $whatsappUrl }}" target="_blank"
                                            class="btn btn-sm btn-outline-success">
                                            Hubungi (WA)
                                        </a>
                                    @else
                                        <a href="{{ $mailtoUrl }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Hubungi (Email)
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada pelamar untuk lowongan ini.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $applications->links() }}
    </div>

@endsection