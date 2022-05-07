<?php

namespace Database\Seeders;

use App\Models\FasilitasHotel;
use App\Models\FasilitasKamar;
use App\Models\TipeKamar;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Fasilitas_List = "CREATE VIEW fasilitas_list AS SELECT `tipe_kamar`.id, `tipe_kamar`.nama_kamar,`tipe_kamar`.gambar, (SELECT GROUP_CONCAT(`nama_fasilitas_kamar`) FROM `fasilitas_kamar`  WHERE fasilitas_kamar.id_tipe_kamar = tipe_kamar.id  ) as fasilitas_list FROM `fasilitas_kamar` INNER JOIN `tipe_kamar` ON `fasilitas_kamar`.id_tipe_kamar = `tipe_kamar`.id  GROUP BY id_tipe_kamar ORDER BY tipe_kamar.id ASC"

        // Data_Reservasi = "CREATE VIEW data_reservasi AS SELECT reservasi.id, reservasi.nama_pemesan, reservasi.email, reservasi.nama_tamu, reservasi.no_tlp, reservasi.tgl_pesan, reservasi.tgl_checkin, reservasi.tgl_checkout, reservasi.jml_kamar, reservasi.status, tipe_kamar.nama_kamar FROM reservasi INNER JOIN tipe_kamar ON reservasi.id_tipe_kamar = tipe_kamar.id"

        // Trigger_tambah_stok_kamar(before, table=reservasi, update) = "BEGIN                                    
        // UPDATE tipe_kamar SET jumlah_kamar = jumlah_kamar + NEW.jml_kamar WHERE id = NEW.id_tipe_kamar;
        // END"

        // Trigger_kurang_stok_kamar(after, table=reservasi, insert) = "BEGIN                                    
        // UPDATE tipe_kamar SET jumlah_kamar = jumlah_kamar - NEW.jml_kamar WHERE id = NEW.id_tipe_kamar;
        // END"

        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'resepsionis',
            'email' => 'resepsionis@gmail.com',
            'password' => bcrypt('resepsionis'),
            'role' => 'resepsionis'
        ]);

        TipeKamar::create([
            'nama_kamar' => 'Deluxe',
            'jumlah_kamar' => '100',
            'gambar' => 'deluxe'
        ]);

        TipeKamar::create([
            'nama_kamar' => 'Superior',
            'jumlah_kamar' => '80',
            'gambar' => 'superior'
        ]);

        // TipeKamar::factory(10)->create();

        FasilitasKamar::create([
            'id_tipe_kamar' => '1',
            'nama_fasilitas_kamar' => 'TV'
        ]);

        FasilitasKamar::create([
            'id_tipe_kamar' => '1',
            'nama_fasilitas_kamar' => 'Kamar Mandi'
        ]);

        FasilitasKamar::create([
            'id_tipe_kamar' => '2',
            'nama_fasilitas_kamar' => 'Sofa'
        ]);

        FasilitasHotel::create([
            'nama_fasilitas_hotel' => 'Wifi',
            'keterangan' => 'Free Wifi',
            'gambar' => 'wifi.png'
        ]);

        FasilitasHotel::create([
            'nama_fasilitas_hotel' => 'Kolam Renang',
            'keterangan' => 'Kolam Renang Bersama',
            'gambar' => 'kolam_renang.png'
        ]);
    }
}
