<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lamaran Pekerjaan Diterima</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 8px; }
        .header { background-color: #28a745; color: #fff; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PentaWork</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $application->jobseeker->name }}</strong>,</p>
            <p>Selamat! Kami punya kabar baik untuk Anda.</p>
            <p>Lamaran Anda untuk posisi <strong>{{ $application->job->title }}</strong> di <strong>{{ $application->job->employer->name }}</strong> telah <strong>DITERIMA</strong>.</p>
            <p>Silakan masuk ke akun Anda untuk melihat detail lebih lanjut atau menunggu instruksi selanjutnya dari perusahaan.</p>
            <a href="{{ route('applications.my') }}" class="btn">Lihat Lamaran Saya</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} PentaWork. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>
</html>
