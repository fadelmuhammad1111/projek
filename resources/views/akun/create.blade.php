<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Form Lokasi</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background: linear-gradient(200deg, gray, white);
            height: 120vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .btn-primary {
            background-color: #00796b;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004d40;
        }

        .form-label {
            font-weight: bold;
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #cccccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .icon a {
            text-decoration: none;
            color: black;
        }

        .icon:hover {
            background-color: #bfbfbf;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        {{$errors}}
        <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="left">
                <h4 class="text-center mb-4">Pilih Lokasi</h4>
                <div class="mb-3">
                    <label for="province" class="form-label">Provinsi</label>
                    <select id="province" name="province" class="form-control">
                        <option selected disabled hidden>Pilih</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="regency" class="form-label">Kabupaten/Kota</label>
                    <select id="regency" name="regency" class="form-control" disabled>
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label">Kecamatan</label>
                    <select id="district" name="subdistrict" class="form-control" disabled>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="village" class="form-label">Desa/Kelurahan</label>
                    <select id="village" name="village" class="form-control" disabled>
                        <option value="">Pilih Desa/Kelurahan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option selected disabled hidden>Pilih</option>
                        <option value="KEJAHATAN">KEJAHATAN</option>
                        <option value="PEMBANGUNAN">PEMBANGUNAN</option>
                        <option value="SOSIAL">SOSIAL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="descript" class="form-label">Detail Keluhan</label>
                    <input type="text" class="form-control" name="description" id="descript">
                </div>
                <div>
                    <input type="file" id="file" name="image" />
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <input type="checkbox" name="checkbox" id="checkbox" class="me-2">
                    <p class="m-0">Laporan yang diberikan sesuai dengan kebenaran.</p>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>
    </form>
    <div class="floating-icons">
        <div class="icon"><a href="/home">🏠︎</a></div>
        <div class="icon"><a href="#">!</a></div>
        <div class="icon"><a href="{{ route('akun.create') }}">🖉</a></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.get('/api/provinces', function (data) {
                data.forEach(function (province) {
                    $('#province').append(new Option(province.name, province.id));
                });
            });

            $('#province').on('change', function () {
                const provinceId = $(this).val();
                $('#regency').prop('disabled', true).empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                $('#district').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
                $('#village').prop('disabled', true).empty().append('<option value="">Pilih Desa/Kelurahan</option>');

                if (provinceId) {
                    $.get(`/api/regencies/${provinceId}`, function (data) {
                        $('#regency').prop('disabled', false);
                        data.forEach(function (regency) {
                            $('#regency').append(new Option(regency.name, regency.id));
                        });
                    });
                }
            });

            $('#regency').on('change', function () {
                const regencyId = $(this).val();
                $('#district').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
                $('#village').prop('disabled', true).empty().append('<option value="">Pilih Desa/Kelurahan</option>');

                if (regencyId) {
                    $.get(`/api/districts/${regencyId}`, function (data) {
                        $('#district').prop('disabled', false);
                        data.forEach(function (district) {
                            $('#district').append(new Option(district.name, district.id));
                        });
                    });
                }
            });

            $('#district').on('change', function () {
                const districtId = $(this).val();
                $('#village').prop('disabled', true).empty().append('<option value="">Pilih Desa/Kelurahan</option>');

                if (districtId) {
                    $.get(`/api/villages/${districtId}`, function (data) {
                        $('#village').prop('disabled', false);
                        data.forEach(function (village) {
                            $('#village').append(new Option(village.name, village.id));
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
