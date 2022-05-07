<?php

namespace App\Http\Controllers;

use DB;
use Throwable;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use App\Models\FasilitasKamar;

class FasilitasKamarController extends Controller
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

        // ! menampilkan semua fasilitas kamar pada tabel fasilitas_kamar
        $items = DB::table('tipe_kamar')
            ->select('fasilitas_kamar.id', 'tipe_kamar.nama_kamar', 'fasilitas_kamar.nama_fasilitas_kamar')
            ->join('fasilitas_kamar', 'tipe_kamar.id', 'fasilitas_kamar.id_tipe_kamar')
            ->orderBy('tipe_kamar.id', 'ASC')
            ->paginate(7)->withQueryString();

        $username = auth()->user()->username;
        $active = 'Fasilitas Kamar';
        $title = "Fasilitas Kamar";

        // !  jika terdapat pencarian maka akan menampilkan hasil pencarian
        if ($search) {
            $items = DB::table('tipe_kamar')
                ->select('fasilitas_kamar.id', 'tipe_kamar.nama_kamar', 'fasilitas_kamar.nama_fasilitas_kamar')
                ->join('fasilitas_kamar', 'tipe_kamar.id', 'fasilitas_kamar.id_tipe_kamar')
                ->where("tipe_kamar.nama_kamar", "LIKE", "%$search%")
                ->paginate(7)->withQueryString();
        }

        return view('dashboard.admin.fasilitasKamar.index', compact('username', 'active', 'items', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ! menampilkan form untuk menambahkan data fasilitas kamar
        $this->authorize('admin');
        $username = auth()->user()->username;
        $kamar = TipeKamar::all();
        $active = 'Fasilitas Kamar';
        $title = "Tambah Fasilitas Kamar";

        return view('dashboard.admin.fasilitasKamar.create', compact('username', 'active', 'title', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ! memulai database transaction
        DB::beginTransaction();

        try {

            // ! menangkap data dari form
            $this->validate($request, [
                'id_tipe_kamar' => 'required',
                'nama_fasilitas_kamar' => 'required'
            ]);

            $cek =  DB::select('SELECT * FROM fasilitas_kamar WHERE id_tipe_kamar = ? AND nama_fasilitas_kamar = ?', [$request->get('id_tipe_kamar'), $request->nama_fasilitas_kamar]);

            // ! jika data fasilitas kamar sudah ada maka akan menampilkan pesan error
            if ($cek) {
                DB::rollback();
                return redirect('/dashboard/fasilitasKamar')->with('failed', 'Data sudah ada!');
            } else {
                $model = new FasilitasKamar;
                $model->id_tipe_kamar = $request->get('id_tipe_kamar');
                $model->nama_fasilitas_kamar = $request->nama_fasilitas_kamar;
                $model->save();
                // ! jika berhasil menyimpan data maka akan menampilkan pesan success
                DB::commit();

                return redirect('/dashboard/fasilitasKamar')->with('success', 'Data Berhasil Ditambah!');
            }
        } catch (Throwable $e) {
            // ! jika gagal menyimpan data maka akan menampilkan pesan error
            DB::rollback();
            return redirect('/dashboard/fasilitasKamar')->with('failed', 'Data Gagal Ditambah!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ! menampilkan form untuk mengubah data fasilitas kamar berdasar id
        $this->authorize('admin');
        $model = FasilitasKamar::find($id);
        $username = auth()->user()->username;
        $kamar = TipeKamar::all();
        $active = 'Fasilitas Kamar';
        $title = "Edit Fasilitas Kamar";
        return view('dashboard.admin.fasilitasKamar.edit', compact('model', 'username', 'active', 'title', 'kamar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // ! memulai database transaction
        DB::beginTransaction();

        try {

            $cek =  DB::select('SELECT * FROM fasilitas_kamar WHERE id_tipe_kamar = ? AND nama_fasilitas_kamar = ?', [$request->get('id_tipe_kamar'), $request->nama_fasilitas_kamar]);

            // ! jika data fasilitas kamar sudah ada maka akan menampilkan pesan error
            if ($cek) {
                DB::rollback();
                return redirect('/dashboard/fasilitasKamar')->with('failed', 'Data sudah ada!');
            } else {
                $model = FasilitasKamar::find($id);
                $model->id_tipe_kamar = htmlspecialchars($request->id_tipe_kamar);
                $model->nama_fasilitas_kamar = htmlspecialchars($request->nama_fasilitas_kamar);
                $model->updated_at = now();
                $model->save();
                // ! jika berhasil menyimpan data maka akan menampilkan pesan success
                DB::commit();

                return redirect('/dashboard/fasilitasKamar')->with('success', 'Data Berhasil DiUpdate!');
            }
        } catch (\Throwable $th) {
            // ! jika gagal menyimpan data maka akan menampilkan pesan error
            DB::rollback();
            return redirect('/dashboard/fasilitasKamar')->with('failed', 'Data Gagal DiUpdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ! memulai database transaction
        DB::beginTransaction();

        try {

            $model = FasilitasKamar::find($id);
            $model->delete();
            // ! jika berhasil menghapus data maka akan menampilkan pesan success
            DB::commit();
            return redirect('/dashboard/fasilitasKamar')->with('success', 'Data Berhasil Dihapus!');
        } catch (\Throwable $th) {
            // ! jika gagal menghapus data maka akan menampilkan pesan failed
            DB::rollback();
            return redirect('/dashboard/fasilitasKamar')->with('failed', 'Data Gagal Dihapus!');
        }
    }
}
