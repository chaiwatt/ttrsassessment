<table>
    <thead>
    <tr>
        <th>ตำแหน่งรับผิดชอบ</th>
        <th>ชื่อ-นามสกุล</th>
    </tr>
    </thead>
    <tbody>

        <tbody >
            <tr>
                <td>Leader</td>  
                <td>
                    @if (!Empty($projectassignment->leader_id))
                    {{$projectassignment->leader->name}} {{$projectassignment->leader->lastname}}
                    @endif
                </td>                                     
            </tr>  
            <tr>
                <td>Co-Leader</td>  
                <td>
                    @if (!Empty($projectassignment->coleader_id))
                        {{$projectassignment->coleader->name}} {{$projectassignment->coleader->lastname}}
                    @endif                                                   
                </td>                                   
            </tr>
            @foreach ($expertassignments as $key => $expertassignment)
            <tr>
                @if ($key == 0)
                <td rowspan="{{$expertassignments->count()}}" >ผู้เชี่ยวชาญ</td>  
                @endif
                <td>
                 {{$expertassignment->user->name}} {{$expertassignment->user->lastname}} {{$expertassignment->isExternal($expertassignment->user_id)}}
                </td>                                
            </tr>
            @endforeach   
        </tbody>
</table>