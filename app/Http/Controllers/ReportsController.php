<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Reports = Reports::all();
    return view("index", compact('Reports'));
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
        $validate = $request->validate([
            'description' => 'required',
            'type' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'image' => 'nullable|image|max:2048',
            // 'statement' => 'accepted',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath= $request->file('image')->store('images/pengaduan', 'public');
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
        return redirect()->route('landing')->with('success', 'Berhasil mengirimkan laporan!');
    }


    // public function vote(Request $request,$id)
    // {
    //     $report = Report::findOrFail($id);
    //     $vote = $report->voting ?? [];

    //     if (!in_array(auth()->user()->id, $vote)) {
    //         $vote[] = auth()->user()->id;
    //         $report->voting = $vote;
    //         $report->save();
    //         return redirect()->back()->with('success', 'Anda Berhasil Memberikan Vote');
    //     } else {
    //         $key = array_search(auth()->user()->id, $vote);
    //         unset($vote[$key]);
    //         $report->voting = $vote;
    //         $report->save();
    //         return redirect()->back()->with('success', 'Anda Berhasil Menghapus Vote');
    //     }
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function view(Request $request,$id)
    // {
    //     $report = Report::with('user', 'comment')->FindOrFail($id);
    //     $report->viewers += 1;
    //     $report->save();

    //     return view('index', compact('report'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reports $reports)
    {
        //
    }
}
