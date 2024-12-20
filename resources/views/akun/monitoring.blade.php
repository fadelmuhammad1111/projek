<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .header .logo {
            display: flex;
            align-items: center;
        }

        .header .logo i {
            font-size: 24px;
            margin-right: 10px;
        }

        .header .logo span {
            font-size: 18px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }

        .complaint-card {
            background-color: gray;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .complaint-card h2 {
            margin-top: 0;
        }

        .details {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            border-bottom: 1px solid white;
        }

        .details span {
            cursor: pointer;
            padding: 10px;
            color: white;
            border-bottom: white
        }

        ul {
            color: white;
        }

        .info-section {
            display: none;
            /* Konten disembunyikan di awal */
            background-color: #3e424b;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;

        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
        }

        .floating-buttons button {
            background-color: #a9a9a9;
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

        .floating-buttons a {
            color: white;
        }

        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <i class="fas fa-desktop"></i>
            <span>Pantau Pengaduan</span>
        </div>
    </div>
    @foreach ($reports as $report)
        <div class="content">
            <div class="complaint-card">
                <h2>Pengaduan {{ \Carbon\Carbon::parse($report->created_at)->format('d F Y') }}</h2>
                <div class="details">
                    <span id="show-data-{{ $loop->index }}">Data</span>
                    <span id="show-image-{{ $loop->index }}">Gambar</span>
                    <span id="show-status-{{ $loop->index }}">Status</span>
                </div>
                <div class="info-section" id="data-section-{{ $loop->index }}">
                    <ul>
                        <li>Tipe: {{ $report->type }}</li>
                        <br>
                        <li>Lokasi: {{ $report->province }}, {{ $report->regency }}, {{ $report->subdistrict }},
                            {{ $report->village }}</li>
                        <br>
                        <li>Deskripsi: {{ $report->description }}</li>
                    </ul>
                </div>
                <div class="info-section" id="image-section-{{ $loop->index }}">
                    @if ($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar" width="200"
                            height="150">
                    @endif
                </div>
                <div class="info-section" id="status-section-{{ $loop->index }}">
                    <h3>Status Pengaduan</h3>
                    <p>
                        @if ($report->status === 'DONE')
                            Pengaduan telah ditanggapi, dengan status: <strong>DONE</strong>
                        @else
                            Pengaduan belum direspons petugas.
                        @endif
                    </p>
                    @if ($report->status === 'DONE')
                        <p>{{ \Carbon\Carbon::parse($report->updated_at)->format('d F Y') }}:
                            {{ $report->response_message }}</p>
                    @else
                        <form action="{{ route('akun.destroy', $report->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <p>Ingin menghapus data pengaduan?</p>
                            <button type="submit" class="btn-delete">HAPUS</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div class="floating-buttons">
        <button>
            <a href="{{ route('akun.index') }}">
                <i class="fas fa-home">
                </i>
        </button>
        <button>
            <a href="{{ route('akun.monitoring') }}">
                <i class="fas fa-exclamation">
                </i></a>
        </button>
        <button>
            <a href="{{ route('akun.create') }}">
                <i class="fas fa-pen">
                </i>
        </button>
        </a>
    </div>
    <script>
        // Loop untuk setiap laporan
        @foreach ($reports as $report)
            const showData{{ $loop->index }} = document.getElementById("show-data-{{ $loop->index }}");
            const showImage{{ $loop->index }} = document.getElementById("show-image-{{ $loop->index }}");
            const showStatus{{ $loop->index }} = document.getElementById("show-status-{{ $loop->index }}");

            const dataSection{{ $loop->index }} = document.getElementById("data-section-{{ $loop->index }}");
            const imageSection{{ $loop->index }} = document.getElementById("image-section-{{ $loop->index }}");
            const statusSection{{ $loop->index }} = document.getElementById("status-section-{{ $loop->index }}");

            // Fungsi untuk menyembunyikan semua konten
            function hideAllSections{{ $loop->index }}() {
                dataSection{{ $loop->index }}.style.display = "none";
                imageSection{{ $loop->index }}.style.display = "none";
                statusSection{{ $loop->index }}.style.display = "none";
            }

            // Tambahkan event listener pada tombol
            showData{{ $loop->index }}.addEventListener("click", () => {
                hideAllSections{{ $loop->index }}();
                dataSection{{ $loop->index }}.style.display = "block";
            });

            showImage{{ $loop->index }}.addEventListener("click", () => {
                hideAllSections{{ $loop->index }}();
                imageSection{{ $loop->index }}.style.display = "block";
            });

            showStatus{{ $loop->index }}.addEventListener("click", () => {
                hideAllSections{{ $loop->index }}();
                statusSection{{ $loop->index }}.style.display = "block";
            });
        @endforeach
    </script>
</body>

</html>