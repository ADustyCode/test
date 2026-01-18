<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>PentaWork - Reset Password</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      background-color: #dde9ff;
      color: #1f2933;
    }

    .page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      width: 100%;
      max-width: 480px;
      background-color: #ffffff;
      border-radius: 28px;
      box-shadow: 0 22px 60px rgba(15, 35, 52, 0.16);
      padding: 40px 48px 32px;
    }

    .card-title-main {
      font-size: 24px;
      font-weight: 500;
      margin: 0 0 6px;
    }

    .card-subtitle {
      font-size: 13px;
      color: #6b7280;
      margin: 0 0 24px;
    }

    .primary-btn {
      margin-top: 4px;
      width: 100%;
      padding: 11px 10px;
      border-radius: 6px;
      border: none;
      background-color: #0056ff;
      color: #ffffff;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
    }

    .primary-btn:hover {
      background-color: #0044c4;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 11px 14px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
      font-size: 13px;
      outline: none;
      background-color: #f9fafb;
    }

    input:focus {
      border-color: #0056ff;
      box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
      background-color: #ffffff;
    }
  </style>
</head>
<body>
  <div class="page px-3">
    <div class="card shadow-lg border-0">
      <h2 class="card-title-main">Reset Password</h2>
      <p class="card-subtitle">
        {{ __('Enter your new password below to secure your account.') }}
      </p>

      @if ($errors->any())
        <div class="alert alert-danger mt-2 mb-3">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
          <label class="form-label small text-muted">Email address</label>
          <input type="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email', $request->email) }}" required autofocus>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="form-label small text-muted">New Password</label>
          <input type="password" name="password" class="form-control" placeholder="New Password" required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
          <label class="form-label small text-muted">Confirm New Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required>
        </div>

        <button type="submit" class="primary-btn btn btn-primary w-100">
          {{ __('Reset Password') }}
        </button>
      </form>
    </div>
  </div>
</body>
</html>
