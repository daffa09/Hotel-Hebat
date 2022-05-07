<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotaMail;

class ReservasiController extends Controller
{

    public function indexPesan()
    {
        // ! menampilkan semua data reservasi pada tabel reservasi
        $item = TipeKamar::all();
        return view('reservasi.index', [
            "title" => "Form Pemesanan",
            'active' => 'Pemesanan',
            'kamar' => $item
        ]);
    }


    public function cekKamar(Request $request)
    {

        try {

            // ! tangkap data dari form pemesanan
            $validated = $request->validate([
                'tgl_checkin'       => 'required',
                'tgl_checkout'      => 'required',
                'jml_kamar'      => 'required',
                'id_tipe_kamar'     => 'required',
            ]);

            if ($validated) {

                // ! cek jumlah kamar yang tersedia
                if ($request->tgl_checkout < $request->tgl_checkin) {
                    return redirect('/')->with('failed', 'Tanggal Checkout tidak boleh lebih kecil dari tanggal checkin');
                } else {
                    $cekKamar = TipeKamar::where('id', $request->id_tipe_kamar)->first();
                    if ($cekKamar->jumlah_kamar > $request->jml_kamar) {

                        // ! jika jumlah kamar tersedia maka akan menampilkan form reservasi 
                        $data = TipeKamar::get();
                        return view('reservasi.booking', [
                            'status'            => 'success',
                            'kamar'             => $data,
                            'tgl_checkin'       => $request->tgl_checkin,
                            'tgl_checkout'      => $request->tgl_checkout,
                            'jml_kamar'         => $request->jml_kamar,
                            'gambar'            => $cekKamar->gambar,
                            'id_tipe_kamar'     => $request->id_tipe_kamar,
                            'nama_kamar'        => $cekKamar->nama_kamar,
                            'active'            => 'Pemesanan',
                            'title'             => "Form Pemesanan"
                        ]);
                    } else {
                        // ! jika jumlah kamar tidak tersedia maka akan menampilkan pesan kamar tidak tersedia
                        $data = TipeKamar::get();
                        return redirect()->route('home', [
                            'tipe_kamar'         => $data
                        ])->with('failed', 'Maaf, kamar tidak tersedia sesuai jumlah yang diinginkan.');
                    }
                }
            }
        } catch (\Throwable $th) {
            // ! jika terjadi error maka akan menampilkan pesan error
            return redirect('/')->with('failed', 'Data Input Tidak Valid');
        }
    }

    public function pemesanan($id)
    {
        // ! menampilkan data reservasi berdasarkan id
        $kamar = TipeKamar::where('id', $id)->first();
        $tgl_checkin = '';
        $tgl_checkout = '';
        $id_tipe_kamar = $kamar->id;
        $nama_kamar = $kamar->nama_kamar;
        $jml_kamar = '';
        $gambar = $kamar->gambar;
        $active = 'Pemesanan';
        $title = "Form Pemesanan";
        return view('reservasi.pesan', compact('active', 'title', 'tgl_checkin', 'tgl_checkout', 'id_tipe_kamar', 'nama_kamar', 'jml_kamar', 'gambar', 'id', 'kamar'));
    }

    public function PesanReservasi(Request $request)
    {

        DB::beginTransaction();

        try {

            // ! tangkap data dari form pemesanan
            $this->validate($request, [
                'tgl_checkin'       => 'required',
                'tgl_checkout'      => 'required',
                'id_tipe_kamar'     => 'required',
                'jml_kamar'         => 'required',

                'nama_pemesan'      => 'required',
                'email'             => 'required',
                'no_tlp'            => 'required',
                'nama_tamu'         => 'required',
            ]);

            $jml_kamar = $request->jml_kamar;
            $id_tipe_kamar = $request->get('id_tipe_kamar');
            $cekKamar = TipeKamar::find($id_tipe_kamar);

            if ($cekKamar) {

                // ! cek tanggal checkout agar tidak lebih kecil dari tanggal checkin 
                if ($request->tgl_checkout < $request->tgl_checkin) {
                    return redirect('/pemesanan')->with('failed', 'Tanggal Checkout tidak boleh lebih kecil dari tanggal checkin');
                } else {
                    // ! cek jumlah kamar yang tersedia
                    if ($jml_kamar < $cekKamar->jumlah_kamar) {

                        $model = new Reservasi;
                        $model->nama_pemesan = $request->nama_pemesan;
                        $model->email = $request->email;
                        $model->nama_tamu = $request->nama_tamu;
                        $model->no_tlp = $request->no_tlp;
                        $model->tgl_pesan = now()->format('Y-m-d');
                        $model->tgl_checkin = $request->tgl_checkin;
                        $model->tgl_checkout = $request->tgl_checkout;
                        $model->jml_kamar = $request->jml_kamar;
                        $model->id_tipe_kamar = $request->get('id_tipe_kamar');
                        $model->save();

                        $pesan = "Reservasi Berhasil, mohon untuk menunggu email konfirmasi";
                        $status = "Pending";
                        $title_cetak = "Cetak Nota";

                        $cekKamar = TipeKamar::find($model->id_tipe_kamar);
                        $nama_kamar = $cekKamar->nama_kamar;

                        Mail::to($model->email)->send(new NotaMail($model, $pesan, $title_cetak, $status, $nama_kamar));

                        DB::commit();

                        return redirect('/')->with('success', 'Reservasi Berhasil, mohon untuk menunggu email konfirmasi');
                    } else {
                        DB::rollback();
                        return redirect('/pemesanan')->with('failed', 'Stok kamar tidak tersedia!');
                    }
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/pemesanan')->with('failed', 'Data input tidak valid, silakan coba lagi nanti!');
        }
    }
}
