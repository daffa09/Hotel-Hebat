<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotaMail;
use DB;

class Reservasi extends Model
{
    use HasFactory;

    // ! gunakan tabel reservasi
    protected $table = 'reservasi';
    protected $guarded = ['id'];

    public function TipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe_kamar');
    }

    public static function cek_Check_in()
    {
        DB::begintransaction();

        try {
            $cek = Reservasi::all();
            $title_cetak = "Cetak Nota";
            $pesan = "Check In Berhasil, mohon untuk tidak terlambat saat check in kamar";
            $status = "Check In";
            for ($i = 0; $i < count($cek); $i++) {

                // ! mengecek apakah tanggal check in sudah lewat atau belum, sekaligus memeriksa status pending
                if (now()->format('Y-m-d') >= $cek[$i]->tgl_checkin and $cek[$i]->status == 'Pending') {
                    $model = Reservasi::find($cek[$i]->id);
                    $cekKamar = TipeKamar::find($model->id_tipe_kamar);
                    $nama_kamar = $cekKamar->nama_kamar;

                    //!  Update Status Reservasi 
                    DB::update("UPDATE reservasi SET status = 'Check In' WHERE id = '" . $cek[$i]->id . "'");
                    DB::commit();

                    // ! mengirim email checkin ke pemesan
                    Mail::to($model->email)->send(new NotaMail($model, $pesan, $title_cetak, $status, $nama_kamar));
                }
            }
        } catch (\Throwable $th) {
            // ! jika ada error maka rollback
            DB::rollback();
            return redirect('/dashboard/reservasi')->with('failed', 'Terjadi Kesalahan!');
        }
    }

    public static function cek_Check_Out()
    {
        DB::begintransaction();

        try {
            $cek = Reservasi::all();
            $title_cetak = "Cetak Nota";
            $pesan = "Check Out Berhasil, terima kasih telah menggunakan layanan kami";
            $status = "Check Out";

            for ($i = 0; $i < count($cek); $i++) {

                // ! mengecek apakah tanggal check out sudah lewat atau belum, sekaligus memeriksa status check in
                if (now()->format('Y-m-d') >= $cek[$i]->tgl_checkout and $cek[$i]->status == 'Check In') {

                    $model = Reservasi::find($cek[$i]->id);
                    $cekKamar = TipeKamar::find($model->id_tipe_kamar);
                    $nama_kamar = $cekKamar->nama_kamar;
                    $id_tipe_kamar = $cekKamar->id;

                    //!  Update Status Reservasi 
                    DB::update("UPDATE reservasi SET status = 'Check Out' WHERE id = '" . $cek[$i]->id . "'");

                    //! untuk mengembalikan jumlah stok pada table "tipe_kamar"
                    DB::update("UPDATE tipe_kamar SET jumlah_kamar = jumlah_kamar + '$model->jml_kamar' WHERE id = '$id_tipe_kamar'");
                    DB::commit();

                    // ! mengirim email checkout ke pemesan
                    Mail::to($model->email)->send(new NotaMail($model, $pesan, $title_cetak, $status, $nama_kamar));
                }
            }
        } catch (\Throwable $th) {
            // ! jika ada error maka rollback
            DB::rollback();
            return redirect('/dashboard/reservasi')->with('failed', 'Terjadi Kesalahan!');
        }
    }
}
