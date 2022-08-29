<table>
    <tr>
        <td>NIP</td>
        <td>Nama Pegawai</td>
        <td>Gaji Pokok</td>
        <td>Biaya Dibayar Pemberi Kerja</td>
        <td>Bonus</td>
        <td>Lembur</td>
        <td>Tunjangan Kinerja</td>
        <td>PPH21</td>
        <td>Biaya Jabatan</td>
        <td>BPJS (KJT)</td>
        <td>BPJS Kesehatan</td>
        <td>Piutang Karyawan</td>
    </tr>
    @foreach ($sallaries as $sallary)
        <tr>
            <td>{{ $sallary->user->nip }}</td>
            <td>{{ $sallary->user->name }}</td>
            <td>{{ $sallary->basic_salary }}</td>
            <td>{{ $sallary->employer_pays_fee }}</td>
            <td>{{ $sallary->bonus }}</td>
            <td>{{ $sallary->overtime }}</td>
            <td>{{ $sallary->performance_allowance }}</td>
            <td>{{ $sallary->pph21 }}</td>
            <td>{{ $sallary->position_allowance }}</td>
            <td>{{ $sallary->jht }}</td>
            <td>{{ $sallary->bpjs }}</td>
            <td>{{ $sallary->receivable_employee }}</td>
        </tr>
    @endforeach
</table>
