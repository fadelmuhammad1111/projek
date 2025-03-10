<html>

<head>
    <title>
        Pengaduan
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .post-content a {
            text-decoration: none;
            color: black;
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

        .post-content .vote:hover {
            color: red;
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

        .floating-buttons a {
            color: white;
        }

        .like-button {
            cursor: pointer;
            color: gray;
        }

        .like-button.liked {
            color: red;
        }

        span .like-count {
            color: gray;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
        }

    </style>
</head>

<body>
    @if (session()->has('success'))
    <p>Anda Berhasil Login</p>
    @endif
    <div class="container">
        <div class="main-content">
            <div class="search-bar">
                <form action="{{ route('landing') }}" method="GET"> 
                    <select name="cari" id="provinsi">
                        <option disabled selected>Pilih provinsi</option>
                        @foreach ($province as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                <button type = "submit">
                        Pilih
                    </button>
                </form>
                
            </div>
            @foreach ($Reports as $report)
            <div class="post" data-id="{{ $report->id }}">
                <img alt="..." src="{{ asset('storage/' . $report->image) }}" width="150" height="100" />
                <div class="post-content">
                    <a href="{{ route('detail.show', ['id' => $report->id]) }}">
                        <h3>{{ $report->description }}</h3>
                    </a>
                    <div class="meta">
                        <span>
                            <i class="fas fa-eye"></i>
                            <span class="view-count">{{ $report->viewers }}</span>
                        </span>
                        <span>
                            <i class="fas fa-heart like-button {{ in_array(auth()->id(), json_decode($report->voting ?? '[]')) ? 'liked' : '' }}" data-id="{{ $report->id }}"> <span class="like-count">{{ $report->likes }}</span>
                            </i>
                        </span>
                        <span>{{ $report->user->email }}</span>
                        <span>{{ \Carbon\Carbon::parse($report->created_at)->diffForHumans() }}</span>
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
            <i class="fas fa-home">
            </i>
        </button>
        <button>
            <a href="{{ route('akun.monitoring') }}">
                        <i class="fas fa-exclamation">
                        </i>
                    </a>
        </button>
        <a href="{{ route('akun.create') }}">
        <button>
            <i class="fas fa-pen">
            </i>
        </button>
    </a>
    </div>
    <script>
        async function postData(url, data) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(data),
        });
        return response.json();
    } catch (error) {
        console.error('Error:', error);
        return null;
    }
}

document.querySelectorAll('.like-button').forEach(button => {
    button.addEventListener('click', async function () {
        const reportId = this.getAttribute('data-id');
        const response = await postData(`/akun/reports/${reportId}/like`, {});
        if (response && response.success) {
            this.querySelector('.like-count').textContent = response.likes;
        } else {
            alert(response ? response.message : 'Failed to like the report.');
        }
    });
});

// Update view count saat laporan detail dibuka
async function updateViewCount(reportId) {
    try {
        const response = await fetch(`/reports/${reportId}/view`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
        });

        const data = await response.json();
        if (data.success) {
            const viewCount = document.querySelector(`.post[data-id="${reportId}"] .view-count`);
            viewCount.textContent = data.viewers; // Update view count
        }
    } catch (error) {
        console.error('Error updating view count:', error);
    }
}

// Tambahkan event listener di semua post-content links (link menuju halaman detail)
    document.querySelectorAll('.post-content a').forEach(link => {
        link.addEventListener('click', async function(event) {
            event.preventDefault(); // Mencegah pemuatan halaman baru
            const reportId = this.closest('.post').getAttribute('data-id');
            
            // Update view count tanpa reload halaman
            await updateViewCount(reportId);
            
            // Arahkan ke halaman detail
            window.location.href = this.href;
        });
    });

    async function updateViewCount(reportId) {
        try {
            const response = await fetch(`/reports/${reportId}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            const data = await response.json();
            if (data.success) {
                const viewCountElement = document.querySelector(`.post[data-id="${reportId}"] .view-count`);
                viewCountElement.textContent = data.viewers; // Update view count
            }
        } catch (error) {
            console.error('Error updating view count:', error);
        }
    }





    </script>
</body>
</html>