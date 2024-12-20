<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <title>Detail Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1, h3 {
            color: #333;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .report-details {
            margin-bottom: 40px;
        }

        .report-details img {
            border-radius: 8px;
            margin-top: 20px;
        }

        .report-details h3 {
            font-size: 24px;
            color: #333;
        }

        .report-details p {
            font-size: 16px;
            margin: 10px 0;
        }

        .vote-info {
            font-size: 16px;
            color: #00796b;
            font-weight: bold;
        }

        .comment-form {
            margin-top: 40px;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            resize: none;
            margin-bottom: 20px;
            background-color: #fafafa;
        }

        .comment-form button {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #004d40;
        }

        .comment-list {
            margin-top: 40px;
        }

        .comment-list .comment {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comment-list .comment p {
            font-size: 16px;
            color: #555;
        }

        .comment-list .comment small {
            display: block;
            font-size: 14px;
            color: #777;
            text-align: right;
        }

        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
        }

        .floating-buttons button {
            background-color: #0d9488;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Laporan</h1>

        <!-- Detail Laporan -->
        <div class="report-details">
            <h3>{{ $report->description }}</h3>
            <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" width="300">
            <p><strong>Waktu:</strong> {{ $report->created_at->diffForHumans() }}</p>
            <p><strong>Jumlah Vote:</strong> {{ $report->votes }}</p>
        </div>

        <!-- Formulir Tambah Komentar -->
        <div class="comment-form">
            <h3>Tambah Komentar</h3>
            <form action="{{ route('reports.comment.store', $report->id) }}" method="POST">
                @csrf
                <textarea name="comment" rows="3" placeholder="Tulis komentar..." required></textarea>
                <button type="submit">Kirim Komentar</button>
            </form>
        </div>

        <!-- Daftar Komentar -->
        <div class="comment-list">
            <h3>Komentar</h3>
            @foreach ($report->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->user->name }} ({{ $comment->user->email }})</strong></p>
                    <p>{{ $comment->comment }}</p>
                    <small>Ditulis {{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    </div>
    <div class="floating-buttons">
        <a href="{{route('landing_page')}}">
        <button>
            <i class="fas fa-home">
            </i>
        </button></a>
        <button>
            <i class="fas fa-exclamation">
            </i>
        </button>
        <a href="{{ route('report.create') }}">
        <button>
            <i class="fas fa-pen">
            </i>
        </button>
    </a>
    </div>
</body>

</html>