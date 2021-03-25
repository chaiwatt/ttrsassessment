@inject('getpercent', 'App\Helper\GetEvPercent')
<table>
    <thead>
    <tr>
        <th>ชื่อ-สกุล</th>
        <th>ที่อยู่ตามบัตรประจำตัวประชาชน</th>
        <th>ที่อยู่ที่ติดต่อได้</th>
        <th>โทรศัพท์</th>
        <th>อีเมล</th>
        <th>หน่วยงานที่สังกัด</th>
        <th>ตำแหน่ง</th>
        <th>วุติการศึกษาสูงสุด</th>
        <th>ประสบการณ์การทำงาน</th>
        <th>สาขาความเชี่ยวชาญ</th>
        <th>ระดับความเชี่ยวชาญ</th>
        <th>จำนวนโครงการที่รับผิดชอบ</th>
        <th>ความแม่นยำการประเมินโดยรวม</th>
        <th>ความแม่นยำการประเมินการจัดการ</th>
        <th>ความแม่นยำการประเมินเทคโนโลยี</th>
        <th>ความแม่นยำการประเมินการรตลาด</th>
        <th>ความแม่นยำการประเมินธุรกิจ</th>
        
    </tr>
    </thead>
    <tbody>
        @foreach($officers as $officer)
            @php
                $user = $officer->user;
                $projectmemberbelongeds = $officer->projectmember($user->id) 
            @endphp
                <tr>
                    @php
                        $userprefix = $user->prefix->name;
                            if($userprefix == 'อื่น ๆ'){
                            $userprefix = $user->alter_prefix;
                        }
                    @endphp
                    <td>{{ $userprefix }}{{ $user->name }}  {{ $user->lastname }}</td>
                    <td>{{ $user->address }} ตำบล{{ $user->province($user->province_id) }} อำเภอ{{ $user->amphur($user->amphur_id) }} จังหวัด{{ $user->tambol($user->tambol_id) }} รหัสไปรษณีย์ {{$user->postal}}</td>
                    <td>{{ $user->address1 }} ตำบล{{ $user->province($user->province1_id) }} อำเภอ{{ $user->amphur($user->amphur1_id) }} จังหวัด{{ $user->tambol($user->tambol1_id) }} รหัสไปรษณีย์ {{$user->postal1}}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $officer->position }}</td>
                    <td>{{ $officer->organization }}</td>
                    <td>{{ $officer->educationlevel->name }}</td>
                    <td>{{ !Empty($officer->expereinceyear) ? $officer->expereinceyear :0 }} ปี {{ !Empty($officer->expereincemonth) ? $officer->expereincemonth :0 }} เดือน</td>
                    <td>{{ $officer->expertbranch->name }}</td>
                    <td>
                        @if ($officer->expertfield->count() > 0)
                            @foreach ($officer->expertfield as $key => $expertfield)
                            อันดับที่ {{$key + 1}}. {{$expertfield->detail}} &nbsp;
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $projectmemberbelongeds->count() }}</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercent($officer->user_id), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($officer->user_id,1), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($officer->user_id,2), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($officer->user_id,3), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($officer->user_id,4), 2) }} %</td>
        @endforeach

    </tbody>
</table>