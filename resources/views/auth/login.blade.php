<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>PentaWork - Sign In</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- [web:44] -->

  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

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

    .layout {
      width: 100%;
      max-width: 1280px;
      padding: 40px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* KIRI: TEKS MARKETING */
    .left {
      flex: 1;
      padding-right: 40px;
    }

    .headline {
      font-size: 26px;
      line-height: 1.35;
      margin: 0 0 24px;
      max-width: 540px;
    }

    .headline span.brand {
      color: #0056ff;
      font-weight: 600;
    }

    .subheadline {
      font-size: 18px;
      margin: 0 0 24px;
    }

    .benefit-list {
      list-style: none;
      padding: 0;
      margin: 0;
      font-size: 14px;
    }

    .benefit-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .benefit-icon {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background-color: #ffe9b2;
      margin-right: 8px;
      flex-shrink: 0;
    }

    .benefit-item:nth-child(2) .benefit-icon {
      background-color: #ffe2f0;
    }

    .benefit-item:nth-child(3) .benefit-icon {
      background-color: #e0f3ff;
    }

    /* KANAN: CARD SIGN IN */
    .right {
      flex: 0 0 480px;
      display: flex;
      justify-content: flex-end;
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

    .card-subtitle a {
      color: #0056ff;
      text-decoration: none;
      font-weight: 500;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 14px;
      font-size: 14px;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .field label {
      font-size: 12px;
      color: #4b5563;
    }

    .input-wrap {
      position: relative;
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

    input::placeholder {
      color: #9ca3af;
    }

    input:focus {
      border-color: #0056ff;
      box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
      background-color: #ffffff;
    }

    .eye-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 22px;
      height: 22px;
      border-radius: 999px;
      border: 1px solid #d1d5db;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      color: #6b7280;
      background-color: #ffffff;
      cursor: pointer;
    }

    .forgot-row {
      display: flex;
      justify-content: flex-end;
      margin-top: -4px;
      margin-bottom: 6px;
    }

    .forgot-row a {
      font-size: 11px;
      color: #0056ff;
      text-decoration: none;
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
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .primary-btn:hover {
      background-color: #0044c4;
    }

    .primary-btn span.arrow {
      font-size: 14px;
    }

    .divider {
      text-align: center;
      font-size: 11px;
      color: #9ca3af;
      margin: 18px 0 12px;
      position: relative;
    }

    .divider::before,
    .divider::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 38%;
      height: 1px;
      background-color: #e5e7eb;
    }

    .divider::before {
      left: 0;
    }

    .divider::after {
      right: 0;
    }

    .social-row {
      display: flex;
      gap: 10px;
      margin-top: 4px;
    }

    .social-btn {
      flex: 1;
      padding: 9px 8px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
      background-color: #ffffff;
      font-size: 12px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      color: #374151;
    }

    .social-icon {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #e5e7eb;
      flex-shrink: 0;
    }

    @media (max-width: 960px) {
      .layout {
        flex-direction: column;
        align-items: center;
        gap: 32px;
      }

      .left {
        padding-right: 0;
        text-align: center;
      }

      .headline {
        max-width: none;
      }

      .right {
        flex: none;
        width: 100%;
        justify-content: center;
      }

      .card {
        max-width: 480px;
      }
    }

    @media (max-width: 640px) {
      .layout {
        padding: 24px 16px;
      }

      .card {
        padding: 26px 20px 22px;
        border-radius: 22px;
      }

      .headline {
        font-size: 22px;
      }
    }
  </style>
</head>
<body>
  <div class="page d-flex align-items-center justify-content-center"> <!-- utilitas flex Bootstrap [web:55] -->
    <div class="layout d-flex align-items-center justify-content-between flex-wrap">

      <!-- Kiri: teks sama seperti sign up -->
      <div class="left">
        <h1 class="headline">
          Pekerjakan profesional melalui <span class="brand">PentaWork</span>
        </h1>
        <p class="subheadline">
          Pembayaran aman, pekerjaan terjamin
        </p>
        <ul class="benefit-list">
          <li class="benefit-item">
            <div class="benefit-icon"></div>
            <span>Keamanan pembayaran terjamin</span>
          </li>
          <li class="benefit-item">
            <div class="benefit-icon"></div>
            <span>Freelancer tersertifikasi &amp; terverifikasi</span>
          </li>
          <li class="benefit-item">
            <div class="benefit-icon"></div>
            <span>Garansi uang kembali jika syarat tidak terpenuhi</span>
          </li>
        </ul>
      </div>

      <!-- Kanan: card SIGN IN -->
      <div class="right d-flex justify-content-end">
        <div class="card shadow-lg border-0"> <!-- card Bootstrap + shadow [web:52] -->
          <h2 class="card-title-main">Sign in</h2>
          <p class="card-subtitle">
            Don't have account? <a href="{{ route('sign-as') }}">Create Account</a>
          </p>
          @if ($errors->any())
            <div style="background:#fee2e2;padding:10px;border-radius:6px;margin-bottom:10px;">
              <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field mb-2">
              <label class="form-label">Email address</label> <!-- form-label Bootstrap [web:42] -->
              <div class="input-wrap">
                <input type="email" class="form-control" placeholder="Email address" name="email">
              </div>
            </div>

            <div class="field mb-2">
              <label class="form-label">Password</label>
              <div class="input-wrap">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="eye-icon">👁</div>
              </div>
            </div>

            <div class="forgot-row">
              <a href="{{ route('password.request') }}">Forgot password</a>
            </div>

            <button type="submit" class="primary-btn btn btn-primary w-100">
              <span>Sign In</span>
              <span class="arrow">➜</span>
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS (opsional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- [web:44] -->
</body>
</html>
