<html>

<head>
    <title>
        Keluhan Form
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .form-section {
            background-color: gray;
            padding: 20px;
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            color: white;
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-section label {
            color: white;
            margin-bottom: 5px;
        }

        .form-section input,
        .form-section select,
        .form-section textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        .form-section input[type="file"] {
            padding: 3px;
        }

        .form-section input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .form-section button {
            background-color: #004d40;
            color: white;
            padding: 3px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .image-section {
            width: 60%;
            position: relative;
        }

        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .floating-buttons {
            position: absolute;
            right: 20px;
            bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .floating-buttons a {
            background-color: #004d40;
            color: white;
            padding: 15px;
            border-radius: 50%;
            text-align: center;
            text-decoration: none;
            font-size: 1.5em;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .form-section,
            .image-section {
                width: 100%;
            }

            
        }
    </style>
    {{-- jQuery CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
</head>
<body>
    <div class="container">
        <div class="form-section">
            {{-- enctype untuk mengirim file --}}
            <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <h1>
                Keluhan
            </h1>
            <label for="provinsi">
                Provinsi*
            </label>
            <select id="provinsi"name="provinsi">
                <option>
                    Pilih
                </option>
            </select>
            <label for="kota">
                Kota/Kabupaten*
            </label>
            <select id="kota" name="kota">
                <option>
                    Pilih
                </option>
            </select>
            <label for="kecamatan">
                Kecamatan*
            </label>
            <select id="kecamatan" name="kecamatan">
                <option>
                    Pilih
                </option>
            </select>
            <label for="kelurahan">
                Kelurahan*
            </label>
            <select id="kelurahan" name="kelurahan">
                <option>
                    Pilih
                </option>
            </select>
            <label for="type">
                Type*
            </label>
            <select id="type" name="type">
                <option value="KEJAHATAN">
                    Kejahatan 
                </option>
                <option value="PEMBANGUNAN">
                    Pembangunan
                </option>
                <option value="SOSIAL">
                    Sosial
                </option>
            </select>
            <label for="detail">
                Detail Keluhan*
            </label>
            <textarea id="detail" rows="4" name="detail"></textarea>
            <label for="file">
                Gambar Pendukung*
            </label>
            <input id="file" type="file" name="gambar" />
            <div>
                <input id="agreement" type="checkbox" name="statement" />
                <label for="agreement">
                    Laporan yang disampaikan sesuai dengan kebenaran.
                </label>
            </div>
            <button type="submit">
                Kirim
            </button>
        </form>
        </div>
        <div class="image-section">
            <img alt=""
                src="{{ asset('image/fott.jpg') }}"
                >
            <div class="floating-buttons">
                <a href="{{route('landing_page')}}">
                    <i class="fas fa-home">
                    </i>
                </a>
                <a href="#">
                    <i class="fas fa-exclamation">
                    </i>
                </a>
                <a href="#">
                    <i class="fas fa-pen">
                    </i>
                </a>
            </div>
        </div>
    </div>
    {{-- Saat page beres loading akan di jalankan fungsi  --}}
    <script>
        $(document).ready(function () {
            // Load Provinces
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                type: 'GET',
                dataType: 'json',
                success: function (provinces) {
                    let options = '<option value="" selected disabled hidden>Pilih</option>';
                    provinces.forEach(province => {
                        options += `<option value="${province.id}">${province.name}</option>`;
                    });
                    $('#provinsi').html(options);
                },
                error: function (xhr, status, error) {
                    console.error('Failed to load provinces:', error);
                }
            });

            // Load Cities based on Province
            $('#provinsi').on('change', function () {
                const idProv = $(this).val();
                if (idProv) {
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${idProv}.json`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (cities) {
                            let options = '<option value="" selected disabled hidden>Pilih</option>';
                            cities.forEach(city => {
                                options += `<option value="${city.id}">${city.name}</option>`;
                            });
                            $('#kota').html(options);
                            $('#kecamatan').html('<option value="" selected disabled hidden>Pilih</option>');
                            $('#kelurahan').html('<option value="" selected disabled hidden>Pilih</option>');
                        },
                        error: function (xhr, status, error) {
                            console.error('Failed to load regencies:', error);
                        }
                    });
                }
            });

            // Load Districts based on City
            $('#kota').on('change', function () {
                const idKota = $(this).val();
                if (idKota) {
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${idKota}.json`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (districts) {
                            let options = '<option value="" selected disabled hidden>Pilih</option>';
                            districts.forEach(district => {
                                options += `<option value="${district.id}">${district.name}</option>`;
                            });
                            $('#kecamatan').html(options);
                            $('#kelurahan').html('<option value="" selected disabled hidden>Pilih</option>');
                        },
                        error: function (xhr, status, error) {
                            console.error('Failed to load districts:', error);
                        }
                    });
                }
            });

            // Load Villages based on District
            $('#kecamatan').on('change', function () {
                const idKec = $(this).val();
                if (idKec) {
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${idKec}.json`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (villages) {
                            let options = '<option value="" selected disabled hidden>Pilih</option>';
                            villages.forEach(village => {
                                options += `<option value="${village.id}">${village.name}</option>`;
                            });
                            $('#kelurahan').html(options);
                        },
                        error: function (xhr, status, error) {
                            console.error('Failed to load villages:', error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>