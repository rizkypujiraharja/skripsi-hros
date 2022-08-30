@php
    function rupiah($nominal) {
        if(!$nominal) {
            return "-";
        }
        return number_format($nominal, 0, ',', '.');
    }
@endphp

<html>
    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                color: #333;
                font-size: 9pt;
            }
            .page-break {
                page-break-after: always;
            }
            .wtg-logo {
                height: 40px;
            }
            .service-contract-label {
                font-size: 24pt;
                font-weight: bold;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th {
                text-align: left;
            }
            th, td {
                padding: 2px 5px;
            }
            .title-section {
                text-align: left;
                font-size: 11pt;
                color: #2d84c8;
                font-weight: bold;
            }
            .table-border, .table-border tr, .table-border td, .table-border th {
                border: 1px solid;
            }
            .border {
                border: 1px solid;
            }
            .text-center {
                text-align: center;
            }
            .text-right {
                text-align: right;
            }
            .mt-5 {
                margin-top: 5px;
            }
            .mt-10 {
                margin-top: 10px;
            }
            .mt-20 {
                margin-top: 20px;
            }
            .mt-30 {
                margin-top: 30px;
            }
            .mb-5 {
                margin-bottom: 5px;
            }
            .mb-10 {
                margin-bottom: 10px;
            }
            .mb-20 {
                margin-bottom: 20px;
            }
            .mb-30 {
                margin-bottom: 30px;
            }
            .mr-3 {
                margin-right: 3px;
            }
            .mr-5 {
                margin-right: 5px;
            }
            .mr-10 {
                margin-right: 10px;
            }
            .mr-15 {
                margin-right: 15px;
            }
            .mr-20 {
                margin-right: 20px;
            }
            .p-5 {
                padding: 5px;
            }
            .p-10 {
                padding: 10px;
            }
            .pl-5 {
                padding-left: 5px;
            }
            .pl-10 {
                padding-left: 10px;
            }
            .pl-20 {
                padding-left: 10px;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <div  style="border-bottom: 3px solid #000">
            <center>
                <img src="data:image/png;base64, {{ $logo }}" width="150"/>
                <br>
                <div class="mt-5 mb-5">
                    <b>
                        PT ORDIVO TEKNOLOGI INDONESIA<br>
                        Jl. Gegerkalong Hilir No.73, Sukarasa, Sukasari, Kota Bandung<br>
                        Telp 02220272818 Fax 02220272818<br>
                        Email Ordivo@gmail.com Website OrderOnline.id
                    </b>
                </div>
            </center>
        </div>
        <div class="mt-10">
            <center>
                <span style="font-size: 12pt">
                    <b>
                        {{ $sallary->periode() }}
                    </b>
                </span>
            </center>

            <table class="mt-10">
                <tr>
                    <td>Nip</td>
                    <td width="200">: {{ $sallary->user->nip }}</td>
                    <td>Jabatan</td>
                    <td>: {{ $sallary->user->division->name }} - {{ $sallary->user->position }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $sallary->user->name }}</td>
                    <td>NPWP</td>
                    <td>: {{ $sallary->user->npwp }}</td>
                </tr>
            </table>

            <table class="mt-20">
                <tr>
                    <td colspan="3"><b>PENDAPATAN</b></td>
                    <td></td>
                    <td colspan="3"><b>POTONGAN</b></td>
                </tr>
                <tr>
                    <td width="25%">Gaji Pokok</td>
                    <td width="5%">Rp.</td>
                    <td width="10%" align="right">{{ rupiah($sallary->basic_salary) }}</td>

                    <td width="5%"></td>

                    <td width="25%">PPH21</td>
                    <td width="5%">Rp.</td>
                    <td width="10%" align="right">{{ rupiah($sallary->pph21) }}</td>
                </tr>

                <tr>
                    <td>Biaya Dibayar Pemberi Kerja</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->employer_pays_fee) }}</td>

                    <td></td>

                    <td>Biaya Jabatan</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->position_allowance) }}</td>
                </tr>

                <tr>
                    <td>Bonus</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->bonus) }}</td>

                    <td></td>

                    <td>BPJS (JHT)</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->jht) }}</td>
                </tr>

                <tr>
                    <td>Lembur</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->overtime) }}</td>

                    <td></td>

                    <td>BPJS (JHT)</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->bpjs) }}</td>
                </tr>

                <tr>
                    <td>Tunjangan Kinerja</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->performance_allowance) }}</td>

                    <td></td>

                    <td>Piutang Karyawan</td>
                    <td>Rp.</td>
                    <td align="right">{{ rupiah($sallary->receivable_employee) }}</td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td><b>JUMLAH PENDAPATAN</b></td>
                    <td><b>Rp.</b></td>
                    <td align="right"><b>{{ rupiah($sallary->getTotalSallary()) }}</b></td>

                    <td></td>

                    <td><b>JUMLAH POTONGAN<b></td>
                    <td><b>Rp.</b></td>
                    <td align="right"><b>{{ rupiah($sallary->getCutsSallary()) }}</b></td>
                </tr>
            </table>

            <div class="mt-10 pl-10" style="font-size:11pt">
                <b>
                    <span>Gaji Bersih :</span>
                    <span style="background-color: #ddd">{{ $sallary->getTotalFinalSallaryRupiah() }}</span>
                </b>
            </div>

            <table>
                <tr>
                    <td width="70%"></td>
                    <td align="center">
                        Bandung, {{ $sallary->created_at->format('Y-m-d') }}<br>
                        Finance & Accounting
                        <br><br><br><br><br>
                        <i>
                            Siti Nurohmah
                        </i>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
