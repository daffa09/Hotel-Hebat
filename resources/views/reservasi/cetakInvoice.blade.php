<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title_cetak }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style_bukti_pesan.css') }}" rel="stylesheet">
    <style>
        @media print {
            .hidden-print {
                display: none;
            }

            .invoice {
                margin-top: -50px;
            }
        }

        .badge {
            border-radius: 9px;
            margin-top: 15px;
            margin-right: -50px;
            margin-left: 50px;
        }
    </style>
</head>

<body>

    <body>

        <div id="invoice">

            <div class="toolbar hidden-print">
                <div class="text-right">
                    <a href="{{ url('/dashboard/reservasi') }}" class="btn btn-warning"><i
                            class="fa fa-print"></i>Kembali</a>
                    <input type="button" class="btn btn-info" value="Print As PDF" onclick="window.print();">
                </div>
                <hr>
            </div>

            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <header>
                        <div class="row">
                            <div class="col">
                                <a target="_blank" href="home">
                                    <img src="{{ asset('assets/img/banner.png') }}" class="rounded-circle" alt=""
                                        width="100" height="100">
                                </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name">
                                    <a target="_blank" href="\">
                                        Hotel Hebat
                                    </a>
                                </h2>
                                <div>SMK Tunas Media, DPK 2022, INA</div>
                                <div>(123) 456-789</div>
                                <div>hotelHebat@gmail.com</div>
                            </div>
                        </div>
                    </header>
                    <main>

                        <div class="row contacts">
                            <div class="col invoice-to">
                                <h2 class="to">Pemesan : {{ $nama_pemesan }}</h2>
                                <h2 class="to">Tamu : {{ $nama_tamu }}</h2>
                                <div class="address">Depok, TM 01234, Indonesia</div>
                                <div class="email"><a href="mailto:{{ $email }}">{{ $email }}</a></div>

                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">Pemesanan</h1>
                                <div class="date">Date: {{ $tgl_pesan }}</div>
                            </div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Status</th>
                                    <th class="text-left">KAMAR</th>
                                    <th class="text-center">CHEECK IN</th>
                                    <th class="text-center">CHECK OUT</th>
                                    <th class="text-center">JUMLAH KAMAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if ($status == "Check In")
                                    <td class="badge bg-success text-white">{{ $status }}
                                    </td>
                                    @elseif ($status == "Check Out")
                                    <td class="badge bg-primary text-white">{{ $status }}
                                    </td>
                                    @else
                                    <td class="badge bg-danger text-white">{{ $status }}
                                    </td>
                                    @endif
                                    <td class="text-left">
                                        <h2>{{ $nama_kamar }}</h2>
                                    </td>
                                    <td class="unit text-center">{{ $tgl_checkin }}</td>
                                    <td class="qty text-center">{{ $tgl_checkout }}</td>
                                    <td class="total text-center">{{ $jml_kamar }}</td>
                                </tr>
                                </tfoot>
                        </table>
                        <div class="mt-4 mb-2">Thank you!</div>
                        <div class="notices">
                            <div>NOTICE:</div>
                            <div class="notice">{{ $pesan }}</div>
                        </div>
                    </main>
                    <footer>
                        Bukti pemesanan kamar Hotel Hebat - TM - Indonesia.
                    </footer>
                </div>
                <div></div>
            </div>
        </div>

    </body>

</html>