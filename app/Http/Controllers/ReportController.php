<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use App\Models\Comment;

class ReportController extends Controller
{
    public function create(){
        return view('article.create_report');
    }

    public function show($id)
    {
        // Ambil laporan berdasarkan ID beserta komentar yang terkait
        $report = Report::with('comments')->findOrFail($id);

        // Return ke view detail laporan
        return view('reports.show', compact('report'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $report = Report::findOrFail($id);

        // Simpan komentar dengan otomatis menggunakan data pengguna yang login
        Comment::create([
            'report_id' => $report->id,
            'user_id' => auth()->id(), // jika user login
            'comment' => $request->comment,
        ]);

        return redirect()->route('reports.show', $report->id)->with('success', 'Komentar berhasil ditambahkan!');
    }

        public function store(Request $request){
        $validated_data = $request->validate([
            'detail' => 'required',
            'type' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'gambar' => 'required',
        ]);
        // Mengecek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // upload gambar
            $validated_data['gambar'] = $request->file('gambar')->store('images/pengaduan', 'public');
        }
        

            Report::create([
                // user_id diisi dengan id user yang sedang login
                'user_id' => auth()->user()->id,
                'description' => $request->detail,
                'type' => $request->type,
                'province' => $request->provinsi,
                'regency' => $request->kota,
                'subdistrict' => $request->kecamatan,
                'village' => $request->kelurahan,
                'image' => $validated_data['gambar'],
                'statement' => $request->statement == 'on' ? true : false,
            ]);

            return redirect()->route('reports.monitoring')->with('success', 'Pengaduan berhasil dikirim');
        }

        public function monitoring()
        {
            // Ambil data laporan hanya untuk user yang sedang login
            $reports = Report::where('user_id', auth()->user()->id)->latest()->get();

            // Kirim data ke view monitoring
            return view('reports.monitoring', compact('reports'));
        }

        public function destroy($id)
        {
            $report = Report::findOrFail($id);

            // Hanya pengguna yang sama yang bisa menghapus laporannya sendiri
            if ($report->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
            }
            $report->delete();
            return redirect()->route('reports.monitoring')->with('success', 'Pengaduan berhasil dihapus.');
        }



        public function vote($id)
        {
            $report = Report::findOrFail($id);
    
            // Tambahkan vote
            $report->increment('votes');
    
            // Redirect kembali ke halaman sebelumnya
            return redirect()->back()->with('success', 'Vote berhasil ditambahkan!');
        }

        public function incrementViewers($id)
        {
            $report = Report::findOrFail($id); // Cari laporan berdasarkan ID
            $report->viewers += 1;             // Tambah jumlah viewers
            $report->save();                   // Simpan perubahan

            return response()->json(['success' => true, 'viewers' => $report->viewers]);
        }



}