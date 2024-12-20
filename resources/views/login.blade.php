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
            font-style: italic;
        }

        .left p {
            margin: 0 0 30px;
            line-height: 1.6;
        }

        .left a {
            background-color: transparent;
            color: black;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .left a:hover {
            background-color: transparent;
            border: 1px solid whitesmoke;
        }

        .left button {
            background-color: #004d40;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .left button:hover {
            background-color: #00695c;
        }

        .right-section {
            flex: 1;
            position: relative;
            background: url('{{ asset('image/foto.jpg') }}') no-repeat center center/cover;
            opacity: 1;
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

        .icon {
            width: 50px;
            height: 50px;
            background-color: darkcyan;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 1.2em;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .icon:hover {
            background-color: cyan;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Login</h1>
            <form action="{{ route('login.proses') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="email">Masukkan Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Masukkan Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                </div>
                <div class="buttons">
                    <button type="submit"  class="register">Register</button>
                    <button type="submit" class="login">Login</button>
                </div>
        </form>
        </div>
            {{-- Background & Ikon --> --}}
        <div class="right-section">
            <div class="action-buttons">
                <div class="icon"><i class="fas fa-home"></i></div>
                <div class="icon"><i class="fas fa-info"></i></div>
                <div class="icon"><i class="fas fa-pen"></i></div>
            </div>
        </div>
    </div>
</body>

</html>
