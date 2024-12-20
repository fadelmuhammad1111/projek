<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <title>Detail Pengaduan</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background: linear-gradient(200deg, gray, white);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            background-color: #00796b;
            color: white;
            padding: 15px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .card-body p {
            margin: 10px 0;
        }

        .card-body p span {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #00796b;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004d40;
        }


        .like-button {
            cursor: pointer;
            color: red;
        }


    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            Detail Pengaduan
        </div>
        <div class="card-body">
            <p><span>Provinsi:</span> {{ $detail->province }}</p>
            <p><span>Kabupaten/Kota:</span> {{ $detail->regency }}</p>
            <p><span>Kecamatan:</span> {{ $detail->district }}</p>
            <p><span>Desa/Kelurahan:</span> {{ $detail->village }}</p>
            <p><span>Type:</span> {{ $detail->type }}</p>
            <p><span>Detail Keluhan:</span> {{ $detail->description }}</p>
            <p><span>Bukti Gambar:</span></p>
            <div class="text-center">
                <img src="{{ asset('storage/' . $detail->image) }}" alt="Bukti" class="img-fluid rounded">
            </div>
            <i class="fas fa-heart like-button {{ in_array(auth()->id(), json_decode($report->voting ?? '[]')) ? 'liked' : '' }}"></i>
            <span class="like-count">{{ $detail->likes }}</span><br>
            <i class="fas fa-eye"></i>
            <span class="view-count">{{ $detail->viewers }}</span>
        </div>
        <div class="card-footer">
            <form action="{{ route('detail.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Tambahkan Komentar</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Tulis komentar Anda..."></textarea>
                </div>
                <input type="hidden" name="report_id" value="{{ $detail->id }}">
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
            <hr>
            <h5>Komentar:</h5>
            <ul class="list-group">
                @foreach($detail->comments as $comment)
                    <li class="list-group-item">
                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                        <small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer text-center">
            <a href="/index" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</body>
</html>
