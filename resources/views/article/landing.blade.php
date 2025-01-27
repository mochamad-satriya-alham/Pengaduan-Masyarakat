<html>

<head>
    <title>
        Pengaduan
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 20px;
        }

        .main-content {
            width: 70%;
        }

        .sidebar {
            width: 25%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #777;
            padding: 20px;
            text-align: center;
            color: white;
        }

        /* .header p {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        } */

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-bar select,
        .search-bar button {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar button {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .post {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
        }

        .post img {
            width: 150px;
            height: 100px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .post-content {
            flex: 1;
        }

        .post-content h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .post-content p {
            margin: 5px 0;
            color: #555;
        }

        .post-content .meta {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #777;
        }

        .post-content .meta i {
            margin-right: 5px;
        }

        .post-content .meta span {
            margin-right: 15px;
        }

        .post-content .vote  {
            margin-left: auto;
            display: flex;
            align-items: center;
            color:gray;
            cursor: pointer;
        }

        .vote {
            justify-content: flex-end; 
        }

        .sidebar {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
        }

        .sidebar h3 {
            margin-top: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0; 
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #007bff;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
        }

        .floating-buttons button {
            background-color: gray;
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
    <div class="header">
        <h1>
            Pengaduan Masyarakat
        </h1>
    </div>
    <div class="container">
        <div class="main-content">
            <div class="search-bar">
                <form action="{{ route('landing_page') }}" method="GET">
                    <select name="cari" id="provinsi">
                        <option disabled selected>Pilih provinsi</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <button type = "submit">
                        Pilih
                    </button>
                </form>
                
            </div>
            @foreach ($reports as $report)
            <div class="post">
                <img alt="Construction vehicles working on a road" height="100"
                    src="{{ asset('storage/' . $report->image) }}" {{--menentukan sumber gambar --}}
                    width="150" />
                <div class="post-content">
                    <h3>
                        <a href="{{ route('reports.show', $report->id) }}" 
                            style="text-decoration: none; color: black;" 
                            onclick="incrementViewers({{ $report->id }}, this)">
                            {{ $report->description }}
                            
                        </a>
                    </h3>
                    <div class="meta">
                        <span>
                            <i class="fas fa-eye"></i>
                            <span>{{ $report->viewers }}</span> <!-- Menampilkan jumlah viewers dari database -->
                        </span>
                        <span>
                            {{ $report->user->email }}
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($report->created_at)->diffForHumans() }}
                        </span>
                    </div>
                    <div class="vote">
                        <form action="{{ route('reports.vote', $report->id) }}" method="POST">
                            @csrf
                            <button type="submit" style="border: none; background: none; color: grey; cursor: pointer;">
                                <i class="fas fa-heart"></i> Vote
                                {{ $report->votes }} <!-- Menampilkan jumlah votes dari database -->
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="sidebar">
            <h3>
                Informasi Pembuatan Pengaduan
            </h3>
            <ul>
                <li>
                    1. Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya,
                </li>
                <li>
                    2. Keseluruhan data pada pengaduan bernilai
                    <strong>
                        BENAR dan DAPAT DIPERTANGGUNG JAWABKAN,
                    </strong>
                </li>
                <li>
                    3. Seluruh bagian data perlu diisi
                </li>
                <li>
                    4. Pengaduan Anda akan ditanggapi dalam 2x24 Jam,
                </li>
                <li>
                    5. Periksa tanggapan Kami, pada Dashboard setelah Anda
                    <strong>
                        Login,
                    </strong>
                </li>
                <li>
                    6. Pembuatan pengaduan dapat dilakukan pada halaman berikut :
                    <a href="#">
                        Ikuti Tautan
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="floating-buttons">
        <button>
            <a href="{{route('reports.monitoring')}}">
            <i class="fas fa-exclamation">
            </i></a>
        </button>
        <button>
            <a href="{{ route('report.create') }}">
            <i class="fas fa-pen">
            </i>
        </button>
        <button>
            <a href="{{ route('logout.proses') }}">
            <i class="fas fa-running">
            </i>
        </button>
    </a>
    </div>
</body>
<script>
    function incrementViewers(reportId, element) {
        fetch(`/reports/${reportId}/increment-viewers`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const viewerCount = element.querySelector('.fas.fa-eye + span');
                viewerCount.textContent = data.viewers;
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>


</html>