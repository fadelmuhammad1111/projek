<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    // Menangani proses login
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = $request->only(['email', 'password']);
        if(Auth::attempt($user)) {
            return redirect()->route('akun.index')->with('success', 'Login Telah Berhasil');
        }else {
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar!');
        }

    $credentials = $request->only('email', 'password');

    

    // Jika pengguna belum terdaftar, buat akun baru
    

    // Login otomatis setelah registrasi
    
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }

    public function landing(){
        return view('index');
    }

    public function index(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';

        $response = $client->request('GET', $url);

        $content = $response->getBody()->getContents();
        $dataArray = json_decode($content, true);
        $Reports = Reports::query();

        if ($request->has('cari')) {
            $Reports = $Reports->where('province', $request->cari);
        }

        $Reports = $Reports->get();

        return view('index', ['province' => $dataArray], compact('Reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'type' => 'required|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'image' => 'nullable|image|max:2048',
            'statement' => 'accepted',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Reports::create([
            'user_id' => auth()->id(),
            'description' => $request->description,
            'type' => $request->type,
            'province' => $request->province,
            'regency' => $request->regency,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'voting' => json_encode([]),
            'viewers' => 0,
            'image' => $imagePath,
            'statement' => true,
        ]);
        // atau jika seluruh data input akan dimasukkan langsung ke db bisa dengan perintah Medicine::create($request->all());
        return redirect()->route('akun.index')->with('success', 'Berhasil mengirimkan laporan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reports $Reports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reports $Reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reports $Reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reports $Reports)
    {
        //
    }
}
