<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reports;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Reports = Reports::all();

        $provinceResponse = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $province = $provinceResponse->json();

        return view('index', compact('Reports', 'province'));
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

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat laporan.');
        }
        
        $request->validate([
            'description' => 'required|string',
            'type' => 'required|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'province' => 'required|string',
            'regency' => 'required|string',
            'subdistrict' => 'required|string',
            'village' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/pengaduan', 'public');
        }

        Reports::create([
            'user_id' => Auth::id(),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'province' => $request->input('province'),
            'regency' => $request->input('regency'),
            'subdistrict' => $request->input('subdistrict'),
            'village' => $request->input('village'),
            'voting' => json_encode([]),
            'viewers' => 0,
            'image' => $imagePath,
            'statement' => true,
        ]);

        return redirect()->route('akun.monitoring')->with('success', 'Laporan berhasil dibuat.');
    }

    public function incrementLikes($id)
    {
        $report = Reports::find($id);

        if (!$report) {
            return response()->json(['success' => false, 'message' => 'Report not found'], 404);
        }

        $voters = json_decode($report->voting, true) ?? [];
        $userId = Auth::id();


        $voters[] = $userId;
        $report->voting = json_encode($voters);
        $report->likes += 1;
        $report->save();

        return response()->json(['success' => true, 'likes' => $report->likes]);
    }


    public function show($id)
    {
        $report = Reports::with('comments.user')->findOrFail($id);
        
        $report->viewers=$report->viewers + 1;
        $report->save();
        
        return view('akun.detail', ['detail' => $report]);
    }

    public function monitoring() {
        $reports = Reports::where('user_id', auth()->user()->id)->latest()->get();

        return view('akun.monitoring', compact('reports'));

    }

    // Menyimpan komentar baru
    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'report_id' => 'required|exists:reports,id',
        ]);

        Comment::create([
            'content' => $request->input('comment'),
            'report_id' => $request->input('report_id'),
            'user_id' => auth()->id(), // Menggunakan ID pengguna yang sedang login
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Reports::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item Sudah di Hapus');
    }
}
