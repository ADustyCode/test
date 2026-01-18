<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'PentaWork')</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: Inter, Arial, sans-serif;
      background: #f6f8fb;
    }

    .sidebar {
      min-height: 100vh;
    }

    .sidebar a.active {
      background-color: #0d6efd;
      color: #fff !important;
    }

    .profile-circle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #0d6efd;
    }
  </style>

  @stack('styles')
</head>

<body>
  <header class="site-header bg-white shadow-sm">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand text-primary fw-bold" href="{{ route('dashboard') }}">PentaWork</a>

        <div class="collapse navbar-collapse">
        </div>

        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">

            <img src="{{ asset('image/vinsen.jpg') }}" class="rounded-circle" width="42" height="42" alt="Profile">

          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">

            <li class="px-3 py-2">
              <div class="fw-semibold">{{ auth()->user()->name }}</div>
              <small class="text-muted text-capitalize">
                {{ auth()->user()->user_type }}
              </small>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item" href="/profile">
                Profil Saya
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ auth()->user()->user_type === 'employer'
        ? route('employer.index')
        : route('jobseeker.settings')
    }}">
                Pengaturan
              </a>
            </li>

            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  Logout
                </button>
              </form>
            </li>

          </ul>
        </div>
      </nav>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      {{-- Sidebar --}}
      <aside class="col-md-3 col-lg-2 bg-dark text-white p-3 sidebar d-none d-md-block">
        <h5 class="text-primary mb-4">Menu</h5>
        <nav class="nav flex-column">
          <a class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}"
            href="{{ route('dashboard') }}">Dashboard</a>
          {{-- Hitung notifikasi belum dibaca --}}
          @php
            $unreadCount = auth()->user()->notifications()->where('is_read', false)->count();
          @endphp

          {{-- Notifikasi --}}
          <a class="nav-link text-white {{ request()->is('notifications*') ? 'active' : '' }}"
            href="{{ route('notifications.index') }}">
            Notifikasi
            @if($unreadCount > 0)
              <span class="badge bg-danger ms-1">{{ $unreadCount }}</span>
            @endif
          </a>
          @if(auth()->user()->user_type == 'jobseeker')
            <a class="nav-link text-white {{ request()->is('jobboard.index') ? 'active' : '' }}"
              href="{{ route('jobboard.index') }}">Jobboard</a>
            <a class="nav-link text-white" href="{{ route('jobseeker.profile.edit') }}">Profil & CV</a>
            <a class="nav-link text-white {{ request()->routeIs('applications.my') ? 'active' : '' }}"
              href="{{ route('applications.my') }}">
              Lamaran Saya
            </a>
          @else
            <a class="nav-link text-white" href="{{ route('jobs.index') }}">Lowongan Saya</a>
          @endif
        </nav>
        <div class="mt-auto pt-4">
          <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-primary" style="width:40px; height:40px;"></div>
            <div>
              <div>{{ auth()->user()->name }}</div>
              <small
                class="text-secondary">{{ auth()->user()->user_type == 'jobseeker' ? 'Pelamar' : 'Perusahaan' }}</small>
            </div>
          </div>
        </div>
      </aside>

      {{-- Main content --}}
      <main class="col-md-9 ms-sm-auto col-lg-10 px-4 py-4">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>