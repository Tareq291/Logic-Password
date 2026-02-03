<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Logic Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <form method="POST" action="/login" class="w-25">
        @csrf

        <input type="password" name="password" class="form-control mb-2" placeholder="أدخل كلمة المرور">

        <button class="btn btn-dark w-100">Login</button>

        @error('password')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror

        @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
    </form>

</body>

</html>