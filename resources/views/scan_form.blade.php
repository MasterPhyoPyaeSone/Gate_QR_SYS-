<!DOCTYPE html>
<html>
<head>
    <title>Scan QR</title>
</head>
<body>
@if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif
@if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif

<form method="POST" action="{{ route('guest.scan') }}">
    @csrf
    <input type="text" name="qr_token" placeholder="Enter QR Token" required><br>
    <button type="submit">Scan QR</button>
</form>
</body>
</html>
