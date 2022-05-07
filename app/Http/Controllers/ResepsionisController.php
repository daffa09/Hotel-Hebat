<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotaMail;

class ResepsionisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('resepsionis');
        // Reservasi::cek_Check_in();
        Reservasi::cek_Check_Out();
        $search = $request->get('search');
        $search_tgl = $request->get('search_tgl');

        // ! menampilkan semua data reservasi pada tabel reservasi
        $items = DB::table('reservasi')
            ->select('reservasi.id', 'reservasi.nama_pemesan', 'reservasi.email', 'reservasi.nama_tamu', 'reservasi.no_tlp', 'reservasi.tgl_pesan', 'reservasi.tgl_checkin', 'reservasi.tgl_checkout', 'reservasi.jml_kamar', 'reservasi.status', 'tipe_kamar.nama_kamar')
            ->join('tipe_kamar', 'reservasi.id_tipe_kamar', '=', 'tipe_kamar.id')
            ->orderBy('id', 'Desc')
            ->paginate(10)->withQueryString();

        $username = auth()->user()->username;
        $active = 'Data Reservasi';
        $title = "Data Reservasi";

        // !  jika terdapat pencarian maka akan menampilkan hasil pencarian berdasakaran nama tamu
        if ($search) {
            $items = Reservasi::where("nama_tamu", "LIKE", "%$search%")->paginate(7)->withQueryString();
        }
        // !  jika terdapat pencarian maka akan menampilkan hasil pencarian berdasarkan tanggal check in
        if ($search_tgl) {

            $items = Reservasi::where("tgl_checkin", "LIKE", "%$search_tgl%")->paginate(7)->withQueryString();
        }

        return view('dashboard.resepsionis.index', compact('username', 'active', 'items', 'title'));
    }


    public function cetakInvoice($id)
    {
        // ! menampilkan nota reservasi berdasarkan id 
        $cetak = Reservasi::find($id);
        $tipeKamar = TipeKamar::find($cetak->id_tipe_kamar);
        $title_cetak = 'Cetak Nota';
        $status = $cetak->status;
        $nama_kamar = $tipeKamar->nama_kamar;
        $nama_pemesan = $cetak->nama_pemesan;
        $email = $cetak->email;
        $nama_tamu = $cetak->nama_tamu;
        $no_tlp = $cetak->no_tlp;
        $tgl_pesan = now()->format('Y-m-d');
        $tgl_checkin = $cetak->tgl_checkin;
        $tgl_checkout = $cetak->tgl_checkout;
        $jml_kamar = $cetak->jml_kamar;

        if ($status == 'Check In') {
            $pesan = "Check In Berhasil, mohon untuk tidak terlambat saat check in kamar";
        } elseif ($status == 'Check Out') {
            $pesan = "Check Out Berhasil, terima kasih telah menggunakan layanan kami";
        } else {
            $pesan = "Batal Berhasil, mohon maaf atas ketidaknyamanan anda terhadap layanan kami";
        }
        return view('reservasi.cetakInvoice', compact('cetak', 'nama_kamar', 'title_cetak', 'nama_pemesan', 'email', 'nama_tamu', 'no_tlp', 'tgl_pesan', 'tgl_checkin', 'tgl_checkout', 'jml_kamar', 'status', 'pesan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservasi  $reservasi
     * @return \Illuminate\Http\Response
     */
    public function show(Reservasi $reservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservasi  $reservasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservasi  $reservasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservasi  $reservasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // ! memulai database transaction
        DB::begintransaction();

        try {

            $this->validate($request, [
                'id' => 'required',
                'status' => 'required'
            ]);

            $status = $request->status;
            $model = Reservasi::find($id);
            $cekKamar = TipeKamar::find($model->id_tipe_kamar);
            $nama_kamar = $cekKamar->nama_kamar;
            $id_tipe_kamar = $cekKamar->id;
            $title_cetak = "Cetak Nota";
            DB::commit();

            if ($status == 'Check In') {

                $pesan = "Check In Berhasil, mohon untuk tidak terlambat saat check in kamar";
                $status = "Check In";
                $tgl_sekarang = now()->format('Y-m-d');
                $mdl = Reservasi::find($id);

                //!  Update Status Reservasi menjadi check in dan ubah tanggal check in menjadi hari ini
                DB::update("UPDATE `reservasi` SET `status` = 'Check In', `tgl_checkin` = '$tgl_sekarang'  WHERE id = '$id'");

                $model = Reservasi::find($id);

                // ! mengirim email ke pemesan
                Mail::to($model->email)->send(new NotaMail($model, $pesan, $title_cetak, $status, $nama_kamar));

                return redirect('/dashboard/reservasi')->with('success', 'Data Berhasil DiUpdate!');
            } elseif ($status == 'Check Out') {

                $pesan = "Check Out Berhasil, terima kasih telah menggunakan layanan kami";
                $status = "Check out";
                $tgl_sekarang = now()->format('Y-m-d');
                $mdl = Reservasi::find($id);

                //!  Update Status Reservasi menjadi check out dan ubah tanggal check out menjadi hari ini
                DB::update("UPDATE `reservasi` SET `status` = 'Check Out', `tgl_checkout` = '$tgl_sekarang'  WHERE id = '$id'");

                //! untuk mengembalikan jumlah stok pada table "tipe_kamar"
                DB::update("UPDATE tipe_kamar SET jumlah_kamar = jumlah_kamar + '$mdl->jml_kamar' WHERE id = '$id_tipe_kamar'");

                $model = Reservasi::find($id);

                // ! mengirim email ke pemesan
                Mail::to($model->email)->send(new NotaMail($model, $pesan, $title_cetak, $status, $nama_kamar));

                return redirect('/dashboard/reservasi')->with('success', 'Data Berhasil DiUpdate!');
            } elseif ($status == 'Batal') {

                $pesan = "Batal Berhasil, mohon maaf atas ketidaknyamanan anda terhadap layanan kami";
                $status = "Batal";

                //!  Update Status Reservasi 
                DB::update("UPDATE `reservasi` SET `status` = 'Batal' WHERE id = '$id'");

                //! untuk mengembalikan jumlah stok pada table "tipe_kamar"
                DB::update("UPDATE tipe_kamar SET jumlah_kamar = jumlah_kamar + '$model->jml_kamar' WHERE id = '$id_tipe_kamar'");

                // ! mengirim email ke pemesan
                Mail::to($model->email)->send(new NotaMail($model, $pesan, $title_cetak, $status, $nama_kamar));

                return redirect('/dashboard/reservasi')->with('success', 'Data Berhasil DiUpdate!');
            } else {
                // ! jika gagal maka akan menampilkan pesan error
                DB::rollback();
                return redirect('/dashboard/reservasi')->with('failed', 'Terjadi Kesalahan!');
            }
        } catch (\Throwable $th) {
            //! jika gagal maka akan menampilkan pesan error
            DB::rollback();
            return redirect('/dashboard/reservasi')->with('failed', 'Terjadi Kesalahan!');
        }
    }
}
