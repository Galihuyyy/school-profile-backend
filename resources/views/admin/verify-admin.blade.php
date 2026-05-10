<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Standar reset untuk email */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f8fafc; padding-bottom: 40px; }
        .main { background-color: #ffffff; width: 100%; max-width: 600px; margin: 0 auto; border-radius: 32px; overflow: hidden; margin-top: 40px; border: 1px solid #e2e8f0; }
        .header { background-color: #0d9488; padding: 40px 20px; text-align: center; }
        .content { padding: 40px 30px; color: #334155; line-height: 1.6; }
        .footer { text-align: center; padding: 20px; color: #94a3b8; font-size: 12px; }
        .button { 
            display: inline-block; 
            padding: 16px 36px; 
            background-color: #0d9488; 
            color: #ffffff !important; 
            text-decoration: none; 
            font-weight: bold; 
            border-radius: 16px; 
            margin-top: 20px;
            box-shadow: 0 4px 6px -1px rgba(13, 148, 136, 0.2);
        }
        .user-box { background-color: #f1f5f9; padding: 20px; border-radius: 16px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="main">
            <tr>
                <td class="header">
                    <h1 style="color: white; margin: 0; font-size: 24px;">Aktivasi Akun Admin</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h2 style="color: #1e293b; margin-top: 0;">Halo, {{ $user->name }}!</h2>
                    <p>Akun admin Anda untuk portal <strong>Sketsu Profile System</strong> telah berhasil dibuat oleh sistem. Silakan lakukan aktivasi untuk mulai mengelola dashboard.</p>
                    
                    <div class="user-box">
                        <p style="margin: 0; font-size: 14px; color: #64748b;">Username Anda:</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 18px; color: #0d9488;">{{ $user->username }}</p>
                    </div>

                    <p>Klik tombol di bawah ini untuk memverifikasi email dan menentukan password baru Anda:</p>
                    
                    <div style="text-align: center;">
                        <a href="{{ $verificationUrl }}" class="button">Verifikasi & Aktivasi Sekarang</a>
                    </div>

                    <p style="margin-top: 30px; font-size: 13px; color: #94a3b8;">
                        Tautan ini hanya berlaku selama 24 jam. Jika Anda merasa tidak pernah meminta akun ini, silakan abaikan email ini.
                    </p>
                </td>
            </tr>
        </table>
        <div class="footer">
            <p>&copy; 2026 Sketsu Profile Url Portal Admin. All rights reserved.</p>
        </div>
    </div>
</body>
</html>