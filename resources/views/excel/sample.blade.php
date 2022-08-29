<table>
    <tr>
        <td>NIP</td>
        <td>Nama Pegawai</td>
        <td>Bonus</td>
        <td>Lembur</td>
        <td>Tunjangan Kinerja</td>
        <td>PPH21</td>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->nip }}</td>
            <td>{{ $user->name }}</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
    @endforeach
</table>
