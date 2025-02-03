<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <p>Hello,</p>
    <p>You requested a password reset. Click the link below to reset your password:</p>
    <p><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
    <p>If you did not request a password reset, please ignore this email.</p>
</body>
</html>
