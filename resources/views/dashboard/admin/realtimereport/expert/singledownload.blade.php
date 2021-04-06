@inject('getpercent', 'App\Helper\GetEvPercent')
<table>
    <thead>
    <tr>
        <th>ชื่อ-นามสกุล</th>
        <th>ที่อยู่ตามบัตรประจำตัวประชาชน</th>
        <th>ที่อยู่ที่ติดต่อได้</th>
        <th>โทรศัพท์</th>
        <th>อีเมล</th>
        <th>หน่วยงานที่สังกัด</th>
        <th>ตำแหน่ง</th>
        <th>วุฒิการศึกษาสูงสุด</th>
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
        @foreach($experts as $expert)
            @php
                $user = $expert->user;
                $projectmemberbelongeds = $expert->projectmember($user->id) 
                // $minitbp = $fulltbp->minitbp;
                // $businessplan = $minitbp->businessplan;
                // 
                // $projectgrade = $fulltbp->projectgrade;
                // $resultissuedate = $fulltbp->resultissuedate(8);
                // $projectassignment = $businessplan->projectassignment;
                // $projectmembers = $fulltbp->projectmember;
                // $financemessagearr = array();
            @endphp
                <tr>
                    @php
                        $userprefix = $user->prefix->name;
                        if($userprefix == 'อื่นๆ'){
                            $userprefix = $user->alter_prefix;
                        }
                    @endphp 
                    <td>{{ $userprefix }}{{ $user->name }}  {{ $user->lastname }}</td>
                    <td>{{ $user->address }} ตำบล{{ $user->province($user->province_id) }} อำเภอ{{ $user->amphur($user->amphur_id) }} จังหวัด{{ $user->tambol($user->tambol_id) }} รหัสไปรษณีย์ {{$user->postal}}</td>
                    <td>{{ $user->address1 }} ตำบล{{ $user->province($user->province1_id) }} อำเภอ{{ $user->amphur($user->amphur1_id) }} จังหวัด{{ $user->tambol($user->tambol1_id) }} รหัสไปรษณีย์ {{$user->postal1}}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $expert->position }}</td>
                    <td>{{ $expert->organization }}</td>
                    <td>{{ $expert->educationlevel->name }}</td>
                    <td>{{ !Empty($expert->expereinceyear) ? $expert->expereinceyear :0 }} ปี {{ !Empty($expert->expereincemonth) ? $expert->expereincemonth :0 }} เดือน</td>
                    <td>{{ $expert->expertbranch->name }}</td>
                    <td>
                        @if ($expert->expertfield->count() > 0)
                            @foreach ($expert->Expertfield as $key => $expertfield)
                            อันดับที่ {{$key + 1}}. {{$expertfield->detail}} &nbsp;
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $projectmemberbelongeds->count() }}</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercent($user->id), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($user->id,1), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($user->id,2), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($user->id,3), 2) }} %</td>
                    <td>{{ number_format($getpercent::getEvOverAveragePercentByPillar($user->id,4), 2) }} %</td>
                    
                    {{-- <td>{{ $businessplan->code }}</td>
                    <td>{{ $minitbp->minitbp_code }}</td>
                    <td>{{ $fulltbp->fulltbp_code }}</td>
                    <td>{{ $minitbp->project }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->companyservicetype }}</td> --}}
        @endforeach

    </tbody>
</table>