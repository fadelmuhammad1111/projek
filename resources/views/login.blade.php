<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('{{ asset("images/bg.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
        }

        .login-container {
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .form-label {
            color: white;
            margin-bottom: 5px;
        }

        .btn {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 48%;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .error {
            background-color: rgba(255, 0, 0, 0.3);
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .floating-icons {
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .icon {
            font-size: 1.5em;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display:flex;
            justify-content:center;
            align-items:center;
            cursor: pointer;
        }

        .icon:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }
        a {
            text-decoration:none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif


        <form action="{{ route('login.auth') }}" method="POST" class="login-form">
            @csrf
            <div class="mb-3">
                <label for="staticEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="staticEmail" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter your password" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn">Login</button>
                <button type="submit" class="btn">Buat Akun</button>
            </div>
        </form>

        <div class="floating-icons">
            <div class="icon"><a class="nav-link active" aria-current="page" href="/home">⌂</a></div>
            <div class="icon">!</div>
            <div class="icon">🖉</div>
        </div>
    </div>
</body>
</html>
