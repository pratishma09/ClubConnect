<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body>
    <h1>Your Verification Code</h1>
    <p>Your verification code is: {{ $code }}</p>
    <p>Or you can click the link below to verify your email:</p>
    <a href="{{ $verificationUrl }}">Verify Email</a>
</body>
</html>
