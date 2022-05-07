<?php

namespace App\Http\Controllers;

use App\Models\FasilitasHotel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFasilitasHotelRequest;

class FasilitasHotelController extends Controller
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

        //! menampilkan semua fasilitas hotel pada tabel fasilitas_hotel
        $items = DB::table('fasilitas_hotel')
            ->select('id', 'nama_fasilitas_hotel', 'keterangan', 'gambar')
            ->orderBy('id', 'Desc')
            ->paginate(7)->withQueryString();

        $username = auth()->user()->username;
        $active = 'Fasilitas Hotel';
        $title = "Fasilitas Hotel";

        //!  jika terdapat pencarian maka akan menampilkan hasil pencarian
        if ($search) {
            $items = FasilitasHotel::where("nama_fasilitas_hotel", "LIKE", "%$search%")->paginate(5)->withQueryString();
        }

        return view('dashboard.admin.fasilitasHotel.index', compact('username', 'active', 'items', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //! menampilkan form untuk menambahkan data fasilitas hotel
        $this->authorize('admin');
        $username = auth()->user()->username;
        $active = 'Fasilitas Hotel';
        $title = "Tambah Fasilitas Hotel";

        return view('dashboard.admin.fasilitasHotel.create', compact('username', 'active', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFasilitasHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFasilitasHotelRequest $request)
    {
        // ! memulai database transaction
        DB::beginTransaction();

        try {

            $this->authorize('admin');
            $validateData = $request->validate([
                'nama_fasilitas_hotel' => 'required|max:255',
                'keterangan' => 'required|max:255',
                'gambar' => 'image|file|max:1024'
            ]);

            $cek = FasilitasHotel::where('nama_fasilitas_hotel', $request->nama_fasilitas_hotel)->first();

            //! jika nama fasilitas hotel sudah ada maka akan menampilkan pesan error
            if ($cek) {
                DB::rollBack();
                return redirect('/dashboard/fasilitasHotel')->with('failed', 'Data sudah ada!');
            } else {

                if ($request->file('gambar')) {
                    $validateData['gambar'] = $request->file('gambar')->store('foto-fasilitasHotel');
                }
                // ! menyimpan data fasilitas hotel ke dalam database
                FasilitasHotel::create($validateData);
                DB::commit();

                return redirect('/dashboard/fasilitasHotel')->with('success', 'Data Berhasil Ditambah!');
            }
        } catch (\Throwable $th) {
            // ! jika terjadi error maka akan dibatalkan database transaction
            DB::rollBack();
            return redirect('/dashboard/fasilitasHotel')->with('failed', 'Data Gagal Ditambah!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ! menampilkan detail data fasilitas hotel berdasarkan id
        $this->authorize('admin');
        $model = FasilitasHotel::find($id);
        $username = auth()->user()->username;
        $active = 'Fasilitas Hotel';
        $title = "Lihat Fasilitas Hotel";

        return view('dashboard.admin.fasilitasHotel.show', compact('model', 'username', 'active', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //! menampilkan form untuk mengubah data fasilitas hotel berdasaksa id 
        $this->authorize('admin');
        $model = FasilitasHotel::find($id);
        $username = auth()->user()->username;
        $active = 'Fasilitas Hotel';
        $title = "Edit Fasilitas Hotel";

        return view('dashboard.admin.fasilitasHotel.edit', compact('model', 'username', 'active', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFasilitasHotelRequest  $request
     * @param  \App\Models\FasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // ! memulai database transaction
        DB::beginTransaction();

        try {

            $model = FasilitasHotel::find($id);
            $model->nama_fasilitas_hotel = htmlspecialchars($request->nama_fasilitas_hotel);
            $model->keterangan = htmlspecialchars($request->keterangan);
            if ($request->file('gambar')) {
                if ($request->oldgambar) {
                    Storage::delete($request->oldgambar);
                }
                $model->gambar = $request->file('gambar')->store('foto-fasilitasHotel');
            }
            $model->updated_at = now();
            $model->save();
            // ! menyimpan data yang sudah di edit fasilitas hotel ke dalam database
            DB::commit();

            return redirect('/dashboard/fasilitasHotel')->with('success', 'Data Berhasil DiUpdate!');
        } catch (\Throwable $th) {
            // ! jika terjadi error maka akan dibatalkan transaksi database
            DB::rollBack();
            return redirect('/dashboard/fasilitasHotel')->with('failed', 'Data Gagal DiUpdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //! memulai database transaction
        DB::beginTransaction();

        try {

            $model = FasilitasHotel::find($id);
            if (Storage::delete($model->gambar)) {
                $model->delete();
            }
            // ! menghapus data fasilitas hotel berdasarkan id
            DB::commit();
            return redirect('/dashboard/fasilitasHotel')->with('success', 'Data Berhasil Dihapus!');
        } catch (\Throwable $th) {
            // ! jika gagal menghapus data fasilitas hotel maka akan menampilkan pesan error
            DB::rollBack();
            return redirect('/dashboard/fasilitasHotel')->with('failed', 'Data Gagal Dihapus!');
        }
    }
}
