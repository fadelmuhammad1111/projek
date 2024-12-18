<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Gaya dasar */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: baseline;
            padding-left: 100px;
            min-height: 100vh;
            flex-direction: column;
            background-image: url('{{ asset("images/bg.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 15px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        p {
            font-size: 1.2em;
            line-height: 1.5;
            margin-bottom: 20px;
            max-width: 600px;
            color: white;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .btn {
            background-color: rgba(0, 0, 0, 0.4);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
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
    <h1>Pengaduan Masyarakat</h1>
    <p>Platform digital yang dirancang untuk memfasilitasi masyarakat dalam melaporkan keluhan, masalah, atau saran terkait layanan publik, infrastruktur, atau hal-hal lain yang berkaitan dengan kepentingan umum</p>
    <a href="{{ route('login') }}" class="btn">Bergabung!</a>

    <div class="floating-icons">
        <div class="icon">
        <a class="nav-link active" aria-current="page" href="/akun">👤</a>
        </div>
        <div class="icon">❗</div>
        <div class="icon">✏️</div>
    </div>
</body>
    </form>
</html>