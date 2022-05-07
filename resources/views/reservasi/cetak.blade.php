<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title_cetak }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important;
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always;
            }

            .invoice>div:last-child {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>

    <body>

        <div id="invoice" style="padding: 30px;">

            <div class="invoice overflow-auto"
                style="position: relative; background-color: #FFF; min-height: 680px; padding: 15px;">
                <div style="min-width: 600px">
                    <header style="padding: 10px 0; margin-bottom: 20px; border-bottom: 1px solid #3989c6;">
                        <div class="row">
                            <div class="col company-details" style="text-align: right;">
                                <h2 class="name" style="margin-top: 0; margin-bottom: 0;">
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
                    <main style="padding-bottom: 50px;">

                        <div class="row contacts" style="margin-bottom: 20px;">
                            <div class="col invoice-to" style="text-align: left;">
                                <h2 class="to" style="margin-top: 0; margin-bottom: 0;">Pemesan : {{
                                    $model->nama_pemesan }}</h2>
                                <h2 class="to" style="margin-top: 0; margin-bottom: 0;">Tamu : {{ $model->nama_tamu }}
                                </h2>
                                <div class="address">Depok, TM 01234, Indonesia</div>
                                <div class="email"><a href="mailto:{{ $model->email }}">{{ $model->email }}</a></div>

                            </div>
                            <div class="col invoice-details" style="text-align: right;">
                                <h1 class="invoice-id" style="margin-top: 0; color: #3989c6;">Pemesanan</h1>
                                <div class="date">Date: {{ $model->tgl_pesan }}</div>
                            </div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0"
                            style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-bottom: 20px;"
                            width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                        Status</th>
                                    <th class="text-left"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                        KAMAR</th>
                                    <th class="text-center"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                        CHEECK IN</th>
                                    <th class="text-center"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                        CHECK OUT</th>
                                    <th class="text-center"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; white-space: nowrap; font-weight: 400; font-size: 16px;">
                                        JUMLAH KAMAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; border: none; margin-top: 15px; margin-right: -50px; margin-left: 50px;text-align: center">
                                        {{ $status }}</td>
                                    <td class="text-left"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; border: none; text-align: center">
                                        <h2>{{ $nama_kamar }}</h2>
                                    </td>
                                    <td class="unit text-center"
                                        style="padding: 15px; border-bottom: 1px solid #fff; border: none; background: #ddd; text-align: center; font-size: 1.2em;">
                                        {{ $model->tgl_checkin }}</td>
                                    <td class="qty text-center"
                                        style="padding: 15px; background: #eee; border-bottom: 1px solid #fff; border: none; text-align: center; font-size: 1.2em;">
                                        {{ $model->tgl_checkout }}</td>
                                    <td class="total text-center"
                                        style="padding: 15px; border-bottom: 1px solid #fff; border: none; background: #3989c6; text-align: center; font-size: 1.2em; color: #fff;">
                                        {{ $model->jml_kamar }}</td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="mt-4 mb-2">Thank you!</div>
                        <div class="notices" style="padding-left: 6px; border-left: 6px solid #3989c6;">
                            <div>NOTICE:</div>
                            <div class="notice" style="font-size: 1.2em;">{{ $pesan }}</div>
                        </div>
                    </main>
                    <footer
                        style="width: 100%; text-align: center; color: #777; border-top: 1px solid #aaa; padding: 8px 0;">
                        Bukti pemesanan kamar Hotel Hebat - TM - Indonesia.
                    </footer>
                </div>
                <div></div>
            </div>
        </div>

    </body>
</body>

</html>