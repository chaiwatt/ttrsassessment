<table>
    <thead>
    <tr>
        <th style="text-align: center">รายการ</th>
        <th style="text-align: center">ผู้ดาวน์โหลด</th>
        <th style="text-align: center">วันที่</th>
    </tr>
    </thead>
    <tbody>

    @foreach($downloadstats as $downloadstat)
            <tr>
                <td>{{ $downloadstat->document }}</td>
                <td>{{ $downloadstat->user->name }} {{ $downloadstat->user->lastname }}</td>
                <td style="text-align: center">{{ $downloadstat->created_at }}</td>
            </tr>
    @endforeach
    </tbody>
</table>