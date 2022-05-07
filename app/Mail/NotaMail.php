<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotaMail extends Mailable
{
    public $model, $pesan, $title_cetak, $status, $nama_kamar;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model, $pesan, $title_cetak, $status, $nama_kamar)
    {
        $this->model = $model;
        $this->pesan = $pesan;
        $this->title_cetak = $title_cetak;
        $this->status = $status;
        $this->nama_kamar = $nama_kamar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('hotelHebat1234@gmail.com')
            ->subject('Nota Reservasi Hotel Hebat')
            ->view('reservasi.cetak');
    }
}
