<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahkan FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Pengaduan Masyarakat</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .left {
            background-color: gray;
            color: white;
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            list-style-type: none;

        }

        .left h1 {
            margin: 0 0 20px;
            font-size: 36px;
        }

        .left p {
            margin: 0 0 30px;
            line-height: 1.6;
        }

        .left a {
            background-color: #004d40;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .left a:hover {
            background-color: #00695c;
        }

        .right-section {
            flex: 1;
            position: relative;
            background: url('{{ asset('image/foto.jpg') }}') no-repeat center center/cover;
            opacity: 0.8;
        }

        .action-buttons {
            position: absolute;
            top: 50%;
            right: 30px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Pengaduan Masyarakat</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur dolorumque
                labor.</p>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('login') }}">Bergabung</a>
            </li>
        </div>
        <!-- Bagian Kanan: Background & Ikon -->
        <div class="right-section">
        </div>
    </div>
</body>

</html>
