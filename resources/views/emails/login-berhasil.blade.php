<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Berhasil</title>
</head>
<body>
    <h2>Halo, {{ $user->name ?? 'Pengguna' }}!</h2>
    <p>Kamu berhasil login ke website Hoshizora Gakuin.</p>
    <p>Informasi akun:</p>
    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Waktu login: {{ now()->format('d-m-Y H:i:s') }}</li>
    </ul>
    <p>Jika kamu merasa tidak melakukan login ini, segera hubungi administrator.</p>
    <p>Terima kasih telah menggunakan Hoshizora Gakuin.</p>
</body>
</html>