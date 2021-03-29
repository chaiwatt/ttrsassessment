<table>
    <thead>
    <tr>
        <th>รายการ</th>
        <th>ผู้ดาวน์โหลด</th>
        <th>วันที่</th>
    </tr>
    </thead>
    <tbody>

    @foreach($downloadstats as $downloadstat)
            <tr>
                <td>{{ $downloadstat->document }}</td>
                <td>{{ $downloadstat->user->name }} {{ $downloadstat->user->lastname }}</td>
                <td>{{ $downloadstat->created_at }}</td>
            </tr>
    @endforeach
    </tbody>
</table>