<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Welcome to {{ config('app.name') }}.</p>
</body>
</html>