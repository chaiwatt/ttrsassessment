<table>
    <thead>
    <tr>
        <th>เลขที่โครงการ</th>
        <th>เลขที่คำขอ Mini TBP</th>
        <th>เลขที่คำขอ Full TBP</th>
        <th>ชื่อโครงการ</th>
        <th>ชื่อบริษัท</th>
        <th>สถานะการได้ใบรับรอง</th>
        <th>ประเภทธุรกิจ</th>
        <th>ผลิต/บริการ</th>
        <th>M-S-M-L</th>
        <th>ISIC Code</th>
        <th>ประเภทธุรกิจตามรหัส ISIC</th>
        <th>ประเภทอุตสาหกรรม</th>
        <th>ลักษณะธุรกิจ</th>
        <th>ชื่อผู้ติดต่อ</th>
        <th>ตำแหน่ง</th>
        <th>E-mail</th>
        <th>เบอร์โทรศัพท์</th>
        <th>ที่ตั้งสถานประกอบการ/สำนักงานใหญ่</th>
        <th>สำนักงานสาขา/โรงงาน</th>
        <th>วันที่อนุมัติ Mini TBP</th>
        <th>วันที่อนุมัติ Full TBP</th>
        <th>สถานะการประเมิน</th>
        <th>คะแนน</th>
        <th>เกรด</th>
        <th>วันที่ออกหนังสือแจ้งผล</th>
        <th>เลขที่ใบรับรอง</th>
        <th>วันที่ออกใบรับรอง</th>
        <th>Leader</th>
        <th>ผู้เชี่ยวชาญ</th>
        <th>JD</th>
        <th>ความต้องการด้านการเงิน (Finance)</th>
        <th>ความต้องการที่ไม่ใช่การเงิน (Non-Finance)</th>
        <th>ผลการดำเนินงาน</th>
        <th>วงเงินที่ได้รับการอนุมัติ (บาท)</th>
        <th>ระยะเวลาการดำเนินงาน Mini TBP (วัน)</th>
        <th>ระยะเวลาการดำเนินงาน Full TBP (วัน)</th>
        <th>ระยะเวลารอประเมิน (วัน)</th>
        <th>ระยะเวลาได้รับใบรับรอง (วัน)</th>
        <th>ระยะเวลาการดำเนินโครงการ (วัน)</th>
    </tr>
    </thead>
    <tbody>

    @foreach($fulltbps as $fulltbp)
    
        @php
            $minitbp = $fulltbp->minitbp;
            $businessplan = $minitbp->businessplan;
            $company = $businessplan->company;
            $projectgrade = $fulltbp->projectgrade;
            $resultissuedate = $fulltbp->resultissuedate(8);
            $projectassignment = $businessplan->projectassignment;
            $projectmembers = $fulltbp->projectmember;
            $financemessagearr = array();
            if(!Empty($minitbp->finance1)){
                array_push($financemessagearr,"ขอสินเชื่อธนาคาร" . $minitbp->bank->name . " จำนวน " . $minitbp->finance1_loan . " บาท");
            }
            if(!Empty($minitbp->finance2)){
                array_push($financemessagearr,"ขอรับการค้ำประกันสินเชื่อฯ บสย. (บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)");
            }
            if(!Empty($minitbp->finance3)){
                array_push($financemessagearr,"โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)");
            }
            if(!Empty($minitbp->finance4)){
                array_push($financemessagearr,"บริษัทร่วมทุน (สวทช.) วงเงินที่ต้องการ " .  	$minitbp->finance4_joint . " บาท สัดส่วนลงทุน บริษัท(%) " .  	$minitbp->finance4_joint_min . " สัดส่วนลงทุน สวทช.(%) " . $minitbp->finance4_joint_max);
            }
            $nonefinancemessagearr = array();
            if(!Empty($minitbp->nonefinance1)){
                array_push($nonefinancemessagearr,"โครงการขึ้นทะเบียนบัญชีนวัตกรรมไทย");
            }
            if(!Empty($minitbp->nonefinance2)){
                array_push($nonefinancemessagearr,"รับรองสิทธิประโยชน์ทางภาษี");
            }
            if(!Empty($minitbp->nonefinance3)){
                array_push($nonefinancemessagearr,"โครงการ spin-off");
            }
            if(!Empty($minitbp->nonefinance4)){
                array_push($nonefinancemessagearr,"ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ");
            }
            if(!Empty($minitbp->nonefinance5)){
                array_push($nonefinancemessagearr,"โครงการสนับสนุนผู้ประกอบการภาครัฐ ดังรายละเอียด " . $minitbp->nonefinance5_detail);
            }
            if(!Empty($minitbp->nonefinance6)){
                array_push($nonefinancemessagearr,"อื่นๆ ดังรายละเอียด " . $minitbp->nonefinance6_detail);
            }
        @endphp
        @if ($businessplan->business_plan_status_id > 2)
            <tr>
                <td>{{ $businessplan->code }}</td>
                <td>{{ $minitbp->minitbp_code }}</td>
                <td>{{ $fulltbp->fulltbp_code }}</td>
                <td>{{ $minitbp->project }}</td>
                <td>{{ $company->name }}</td>
                <td>
                    @if ($businessplan->business_plan_status_id == 10 )
                            ได้รับใบรับรองแล้ว
                        @else
                            ยังไม่ได้รับใบรับรอง
                    @endif
                </td>

                <td>{{ $company->businesstype->name }}</td>
                <td>{{ $company->companyservicetype }}</td>
                <td>{{ $company->companysize }}</td>
                <td>{{ $company->isicsub->code }}</td>
                <td>{{ $company->isicsub->name }}</td>
                <td>{{ $company->industrygroup->name }}</td>
                <td>{{ $company->isic->name }}</td>
                <td>{{ $minitbp->contactpersonprefix->name }}{{ $minitbp->contactname }}  {{ $minitbp->contactlastname }}</td>
                <td>{{ $minitbp->contactposition }}</td>
                <td>{{ $minitbp->contactemail }}</td>
                <td>{{ $minitbp->contactphone }}</td>
                <td>{{ $company->companyaddress[0]->address }} ตำบล{{$company->companyaddress[0]->tambol->name}}  อำเภอ{{$company->companyaddress[0]->amphur->name}} จังหวัด{{$company->companyaddress[0]->province->name}} รหัสไปรษนีย์ {{$company->companyaddress[0]->postalcode}}</td>
                <td>
                    @if ($company->companyaddress->count() > 1)
                    {{ $company->companyaddress[1]->address }} ตำบล{{$company->companyaddress[1]->tambol->name}}  อำเภอ{{$company->companyaddress[1]->amphur->name}} จังหวัด{{$company->companyaddress[1]->province->name}} รหัสไปรษนีย์ {{$company->companyaddress[1]->postalcode}}
                    @endif
                </td>
                <td>{{ $businessplan->minitbpapprovedate }}</td>
                <td>{{ $businessplan->fulltbpapprovedate }}</td>
                <td>
                    @if ($fulltbp->status == 2)
                        กำลังดำเนินการ
                        @elseif($fulltbp->status == 3)
                        เสร็จสิ้น
                    @endif
                </td>
                <td>
                    @if (!Empty($projectgrade))
                        {{number_format($projectgrade->percent, 2)}}
                    @endif
                </td>
                <td>
                    @if (!Empty($projectgrade))
                        {{$projectgrade->grade}}
                    @endif
                </td>
                <td>
                    @if (!Empty($resultissuedate))
                        {{$resultissuedate}}
                    @endif
                </td>
                <td>{{ $businessplan->code }}</td>
                <td>
                    @if (!Empty($resultissuedate))
                        {{$resultissuedate}}
                    @endif
                </td>
                <td>
                    @if (!Empty($projectassignment))
                    {{$projectassignment->leader->prefix->name}}{{$projectassignment->leader->name}}  {{$projectassignment->leader->lastname}}
                    @endif
                </td>
                <td>
                    @foreach ($projectmembers as $key => $projectmember)
                        {{$projectmember->user->prefix->name}}{{$projectmember->user->name}}  {{$projectmember->user->lastname}}
                        @if ($key != $projectmembers->count()-1)
                        ,
                        @endif
                    @endforeach
                </td>
                <td>{{$fulltbp->jduser->prefix->name}}{{$fulltbp->jduser->name}}  {{$fulltbp->jduser->lastname}}</td>
                <td>
                    @foreach ($financemessagearr as $key => $financemessagear)
                    {{$key + 1 }}. {{$financemessagear}} &nbsp;
                    @endforeach
                </td>
                <td>
                    @foreach ($nonefinancemessagearr as $key => $nonefinancemessagear)
                    {{$key + 1 }}. {{$nonefinancemessagear}} &nbsp;
                    @endforeach
                </td>
                <td>
                    @if ($fulltbp->status == 2)
                        กำลังดำเนินการ
                        @elseif($fulltbp->status == 3)
                        เสร็จสิ้น
                    @endif
                </td>
                <td>
                    
                </td>
                <td>
                    {{$businessplan->minitbpduration}}
                </td>
                <td>
                    {{$businessplan->fulltbpduration}}
                </td>
                <td>
                    {{$businessplan->assessmentduration}}
                </td>
                <td>
                    {{$businessplan->certificateduration}}
                </td>
                <td>
                    {{$businessplan->projectduration}}
                </td>
            </tr>
        @endif

    @endforeach
    </tbody>
</table>