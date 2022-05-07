<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
        $search = $request->get('search');

        // ! menampilkan semua tipe kamar pada tabel tipe_kamar
        $items = DB::table('tipe_kamar')
            ->select('id', 'nama_kamar', 'jumlah_kamar', 'gambar')
            ->orderBy('id', 'Desc')
            ->paginate(7)->withQueryString();

        $username = auth()->user()->username;
        $active = 'Tipe Kamar';
        $title = "Tipe Kamar";

        // !  jika terdapat pencarian maka akan menampilkan hasil pencarian
        if ($search) {
            $items = TipeKamar::where("nama_kamar", "LIKE", "%$search%")->paginate(5)->withQueryString();
        }

        return view('dashboard.admin.tipeKamar.index', compact('username', 'active', 'items', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ! menampilkan form untuk menambahkan data tipe kamar
        $username = auth()->user()->username;
        $active = 'Tipe Kamar';
        $title = "Lihat Tipe Kamar";

        return view('dashboard.admin.tipeKamar.create', compact('username', 'active', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            // ! tangkap data dari form
            $validateData = $request->validate([
                'nama_kamar' => 'required|max:255',
                'jumlah_kamar' => 'required|min:1',
                'gambar' => 'image|file|max:1024'
            ]);

            $cek = TipeKamar::where('nama_kamar', $request->nama_kamar)->first();

            // ! jika data sudah ada maka akan menampilkan pesan error
            if ($cek) {
                DB::rollback();
                return redirect('/dashboard/tipeKamar')->with('failed', 'Data sudah ada!');
            } else {

                if ($request->file('gambar')) {
                    $validateData['gambar'] = $request->file('gambar')->store('foto-tipeKamar');
                }

                // ! menyimpan data ke tabel tipe_kamar
                TipeKamar::create($validateData);
                DB::commit();

                return redirect('/dashboard/tipeKamar')->with('success', 'Data Berhasil Ditambah!');
            }
        } catch (\Throwable $th) {
            // ! jika terjadi error maka akan dikembalikan ke form tambah data
            DB::rollback();
            return redirect('/dashboard/tipeKamar')->with('failed', 'Data Gagal Ditambah!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipeKamar  $tipeKamar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ! menampilkan data tipe kamar berdasarkan id
        $this->authorize('admin');
        $model = TipeKamar::find($id);
        $username = auth()->user()->username;
        $active = 'Tipe Kamar';
        $title = "Lihat Tipe Kamar";

        return view('dashboard.admin.tipeKamar.show', compact('model', 'username', 'active', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipeKamar  $tipeKamar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ! menampilkan form untuk mengubah data tipe kamar berdadarkan id
        $this->authorize('admin');
        $model = TipeKamar::find($id);
        $username = auth()->user()->username;
        $active = 'Tipe Kamar';
        $title = "Edit Tipe Kamar";

        return view('dashboard.admin.tipeKamar.edit', compact('model', 'username', 'active', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipeKamar  $tipeKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {

            // ! tangkap data dari form lalu langsung update ke tabel tipe_kamar
            $model = TipeKamar::find($id);
            $model->nama_kamar = htmlspecialchars($request->nama_kamar);
            if ($request->file('gambar')) {
                if ($request->oldgambar) {
                    Storage::delete($request->oldgambar);
                }
                $model->gambar = $request->file('gambar')->store('foto-tipeKamar');
            }
            $model->jumlah_kamar = htmlspecialchars($request->jumlah_kamar);
            $model->updated_at = now();
            $model->save();
            DB::commit();

            return redirect('/dashboard/tipeKamar')->with('success', 'Data Berhasil DiUpdate!');
        } catch (\Throwable $th) {
            // ! jika terjadi error maka akan dikembalikan ke form edit data
            DB::rollback();
            return redirect('/dashboard/tipeKamar')->with('failed', 'Data Gagal DiUpdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipeKamar  $tipeKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();

        try {

            // ! mengambil data tipe kamar berdasarkan id
            $model = TipeKamar::find($id);
            if (Storage::delete($model->gambar)) {
                $model->delete();
            }
            // ! menghapus data tipe kamar
            DB::commit();
            return redirect('/dashboard/tipeKamar')->with('success', 'Data Berhasil Dihapus!');
        } catch (\Throwable $th) {
            // ! jika terjadi error maka akan mengirimkan pesan error
            DB::rollback();
            return redirect('/dashboard/tipeKamar')->with('failed', 'Data Gagal Dihapus!');
        }
    }
}
