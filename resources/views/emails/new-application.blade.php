<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notifikasi Pelamar Baru</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 8px; }
        .header { background-color: #0056ff; color: #fff; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #0056ff; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PentaWork</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $application->job->employer->name }}</strong>,</p>
            <p>Ada pelamar baru untuk lowongan pekerjaan Anda:</p>
            <p><strong>Posisi:</strong> {{ $application->job->title }}</p>
            <p><strong>Nama Pelamar:</strong> {{ $application->jobseeker->name }}</p>
            <p>Silakan tinjau profil pelamar dan kelola lamaran melalui dashboard Anda.</p>
            <a href="{{ route('jobs.applications', $application->job->id) }}" class="btn">Lihat Pelamar</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} PentaWork. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>
</html>
