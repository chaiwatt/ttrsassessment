
@php
    $test =2 ;
@endphp

{{-- @if ($test == 1) --}}
    @if (Auth::user()->user_type_id == 3)
    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.expert.report')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-stats-bars2"></i> <span>แดชบอร์ด</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="แดชบอร์ด">
        <li class="nav-item"><a href="{{route('dashboard.expert.report')}}" class="nav-link">รายงาน</a></li>
        @if (Auth::user()->expertdetail->expert_type_id == 1)
            <li class="nav-item"><a href="{{route('dashboard.admin.project.assessment')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.assessment')?'active':''}}">ลงคะแนน
                @if ($sharenotificationbubbles->where('notification_sub_category_id',7)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>								
        @endif
    </ul>
    </li>
    @endif

    @if (Auth::user()->user_type_id >=4 )
    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.report')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-stats-bars2"></i> <span>แดชบอร์ด</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="แดชบอร์ด">
        <li class="nav-item"><a href="{{route('dashboard.admin.report')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.report')?'active':''}}">หน้าแรก</a></li>     
    </ul>
    </li>
    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.project')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-archive"></i> <span>โครงการ</span>
        @if ($sharenotificationbubbles->where('notification_category_id','1')->count() > 0)
            @if ($sharenotificationbubbles->where('notification_category_id','1')->where('notification_sub_category_id','6')->count() > 0)
                @if (Auth::user()->user_type_id == 5)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            @else
                <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
            @endif
        @endif

    </a>
    <ul class="nav nav-group-sub" data-submenu-title="โครงการ">
        @if (Auth::user()->user_type_id >=5)
            <li class="nav-item"><a href="{{route('dashboard.admin.project.projectassignment')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.projectassignment')?'active':''}}">การมอบหมาย
                @if ($sharenotificationbubbles->where('notification_sub_category_id',1)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li> 
            <li class="nav-item"><a href="{{route('dashboard.admin.project.invoice')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.invoice')?'active':''}}">ใบแจ้งหนี้
                @if ($sharenotificationbubbles->where('notification_sub_category_id',3)->count() > 0)
                <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
            @endif
            </a></li>	
            <li class="nav-item"><a href="{{route('dashboard.admin.project.minitbp')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.minitbp')?'active':''}}">แบบคำขอรับบริการประเมิน
                @if ($sharenotificationbubbles->where('notification_sub_category_id',4)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>	
            <li class="nav-item"><a href="{{route('dashboard.admin.project.fulltbp')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.fulltbp')?'active':''}}">แบบฟอร์มแผนธุรกิจเทคโนโลยี
                @if ($sharenotificationbubbles->where('notification_sub_category_id',5)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>
            @if (Auth::user()->user_type_id == 5)
                <li class="nav-item"><a href="{{route('dashboard.admin.project.evweight')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.evweight')?'active':''}}">กำหนด Weight
                    @if ($sharenotificationbubbles->where('notification_sub_category_id',6)->count() > 0)
                        <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                    @endif
                </a></li>	
            @endif
            <li class="nav-item"><a href="{{route('dashboard.admin.project.assessment')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.assessment')?'active':''}}">ลงคะแนน
                @if ($sharenotificationbubbles->where('notification_sub_category_id',7)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>	 
        @endif

        @if (Auth::user()->user_type_id == 4 && Auth::user()->isLeader() != 0)
            <li class="nav-item"><a href="{{route('dashboard.admin.project.invoice')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.invoice')?'active':''}}">ใบแจ้งหนี้
                @if ($sharenotificationbubbles->where('notification_sub_category_id',3)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>	
            <li class="nav-item"><a href="{{route('dashboard.admin.project.minitbp')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.minitbp')?'active':''}}">แบบคำขอรับบริการประเมิน
                @if ($sharenotificationbubbles->where('notification_sub_category_id',4)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>	
            <li class="nav-item"><a href="{{route('dashboard.admin.project.fulltbp')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.fulltbp')?'active':''}}">แบบฟอร์มแผนธุรกิจเทคโนโลยี
                @if ($sharenotificationbubbles->where('notification_sub_category_id',5)->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a></li>
        @endif

        @if (Auth::user()->user_type_id == 4 && Auth::user()->isProjectmember() != 0)
            <li class="nav-item"><a href="{{route('dashboard.admin.project.assessment')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.project.assessment')?'active':''}}">ลงคะแนน</a></li>	 
        @endif
        
    </ul>
    </li>
    
    @if (Auth::user()->user_type_id == 4 && Auth::user()->isLeader() != 0 )
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.calendar')?'nav-item-expanded nav-item-open':''}}">
            <a href="#" class="nav-link"><i class="icon-clipboard2"></i> <span>ปฏิทิน</span>
                @if ($sharenotificationbubbles->where('notification_category_id','2')->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="ปฏิทิน">
                <li class="nav-item"><a href="{{route('dashboard.admin.calendar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.calendar')?'active':''}}">ปฏิทิน
                    @if ($sharenotificationbubbles->where('notification_sub_category_id',8)->count() > 0)
                        <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                    @endif
                </a></li>
            </ul>
        </li>
    @endif

        @if (Auth::user()->user_type_id >= 5)
            <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.assessment')?'nav-item-expanded nav-item-open':''}}">
            <a href="#" class="nav-link"><i class="icon-clipboard2"></i> <span>ประเมิน</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="ประเมิน">
                    <li class="nav-item"><a href="{{route('dashboard.admin.assessment')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.assessment')?'active':''}}">สรุปคะแนน</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.evaluationresult')?'nav-item-expanded nav-item-open':''}}">
                <a href="#" class="nav-link"><i class="icon-trophy3"></i> <span>ผลการประเมิน</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="ประเมิน">
                    <li class="nav-item"><a href="{{route('dashboard.admin.evaluationresult')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.evaluationresult')?'active':''}}">รายงานผลการประเมิน</a></li>
                </ul>
            </li>
            @elseif(Auth::user()->user_type_id == 4)
                @if (Auth::user()->user_type_id == 4 && Auth::user()->isLeader() != 0 )
                    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.assessment')?'nav-item-expanded nav-item-open':''}}">
                    <a href="#" class="nav-link"><i class="icon-clipboard2"></i> <span>ประเมิน</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="ประเมิน">
                            <li class="nav-item"><a href="{{route('dashboard.admin.assessment')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.assessment')?'active':''}}">สรุปคะแนน</a></li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.evaluationresult')?'nav-item-expanded nav-item-open':''}}">
                        <a href="#" class="nav-link"><i class="icon-trophy3"></i> <span>ผลการประเมิน</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="ประเมิน">
                            <li class="nav-item"><a href="{{route('dashboard.admin.evaluationresult')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.evaluationresult')?'active':''}}">รายงานผลการประเมิน</a></li>
                        </ul>
                    </li>
                @endif
        @endif

    @endif

    @if (Auth::user()->user_type_id <=2 && !Empty(Auth::user()->company))
    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.company.report')?'nav-item-expanded nav-item-open':''}}">
        <a href="#" class="nav-link"><i class="icon-stats-bars2"></i> <span>แดชบอร์ด</span></a>
        <ul class="nav nav-group-sub" data-submenu-title="แดชบอร์ด">
            <li class="nav-item"><a href="{{route('dashboard.company.report')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.company.report')?'active':''}}">หน้าแรก</a></li>     
        </ul>
    </li>
    @if (!Empty(Auth::user()->company->businessplan))
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.company.project')?'nav-item-expanded nav-item-open':''}}">
            <a href="#" class="nav-link"><i class="icon-archive"></i> <span>โครงการ</span>
                @if ($sharenotificationbubbles->where('notification_category_id','1')->count() > 0)
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                @endif
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="โครงการ">
                @if (Auth::user()->company->businessplan->business_plan_status_id > 1 )
                    <li class="nav-item"><a href="{{route('dashboard.company.project.minitbp.edit',['id'=>Auth::user()->company->businessplan->minitbp->id])}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.company.project.minitbp')?'active':''}}">แบบคำขอรับบริการประเมิน
                        @if ($sharenotificationbubbles->where('notification_sub_category_id',4)->count() > 0)
                            <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                        @endif
                    </a></li>  
                    @if (Auth::user()->company->businessplan->business_plan_status_id > 3)
                        <li class="nav-item"><a href="{{route('dashboard.company.project.fulltbp.edit',['id'=>Auth::user()->company->businessplan->minitbp->fulltbp->id])}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.company.project.fulltbp')?'active':''}}">แบบฟอร์มแผนธุรกิจเทคโนโลยี
                            @if ($sharenotificationbubbles->where('notification_sub_category_id',5)->count() > 0)
                                <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                            @endif
                        </a></li>
                    @endif
                    @if (Auth::user()->company->businessplan->business_plan_status_id >= 8)
                        <li class="nav-item"><a href="{{route('dashboard.company.project.invoice')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.company.project.invoice')?'active':''}}">ใบแจ้งหนี้
                            @if ($sharenotificationbubbles->where('notification_sub_category_id',3)->count() > 0)
                                <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" style="margin-top:-5px;">ใหม่</span>
                            @endif
                        </a></li>
                    @endif
                @endif
            </ul>
        </li>
    @endif
    @endif

    @if (Auth::user()->user_type_id >=5)
    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-chart"></i> <span>รายงาน</span>
    </a>
    <ul class="nav nav-group-sub" data-submenu-title="รายงาน">
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>โครงการ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="โครงการ">
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.project')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project')?'active':''}}">ทั้งหมด</a></li>
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.project.bygrade')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project.bygrade')?'active':''}}">ตามเกรด</a></li>
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.project.byindustrygroup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project.byindustrygroup')?'active':''}}">ตามกลุ่มอุตสาหกรรม</a></li>
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.project.bybusinesstype')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project.bybusinesstype')?'active':''}}">ตามประเภทธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.project.regcapital')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project.regcapital')?'active':''}}">ตามทุนจดทะเบียน</a></li>
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.project.docdownload')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.project.docdownload')?'active':''}}">ดาวน์โหลดเอกสาร</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.officer')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>เจ้าหน้าที่ TTRS</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เจ้าหน้าที่ TTRS">
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.officer')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.officer')?'active':''}}">เจ้าหน้าที่ TTRS</a></li>	
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.expert')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ผู้เชี่ยวชาญ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ผู้เชี่ยวชาญ">
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.expert')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.expert')?'active':''}}">ผู้เชี่ยวชาญ</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.website')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>เว็บไซต์</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.website.visit')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.website.visit')?'active':''}}">การเข้าชมเว็บไซต์</a></li>
                <li class="nav-item"><a href="{{route('dashboard.admin.realtimereport.website.contact')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.realtimereport.website.contact')?'active':''}}">ข้อมูลการติดต่อ</a></li>
            </ul>
        </li>
     
    </ul>
    </li>

    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'dashboard.admin.search')?'nav-item-expanded nav-item-open':''}}">
        <a href="#" class="nav-link"><i class="icon-search4"></i> <span>ค้นหา</span>
         
        </a>
        <ul class="nav nav-group-sub" data-submenu-title="ค้นหา">
            
            <li class="nav-item"><a href="{{route('dashboard.admin.search.project')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.search.project')?'active':''}}">โครงการ</a></li>
            <li class="nav-item"><a href="{{route('dashboard.admin.search.company')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.search.company')?'active':''}}">ผู้รับการประเมิน</a></li>
            <li class="nav-item"><a href="{{route('dashboard.admin.search.expert')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.search.expert')?'active':''}}">ผู้เชี่ยวชาญ</a></li>
            <li class="nav-item"><a href="{{route('dashboard.admin.search.officer')}}" class="nav-link {{starts_with(Route::currentRouteName(),'dashboard.admin.search.officer')?'active':''}}">เจ้าหน้าที่ TTRS</a></li>
        </ul>
    </li>
    @endif

    @if (Auth::user()->user_type_id >= 5)
    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>ตั้งค่า</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="ตั้งค่า">
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.dashboard')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ทั่วไป</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ทั่วไป">
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.prefix')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.prefix')?'active':''}}">คำนำหน้าชื่อ</a></li>	
                {{-- <li class="nav-item"><a href="{{route('setting.admin.dashboard.religion')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.religion')?'active':''}}">ศาสนา</a></li>										
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.country')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.country')?'active':''}}">ประเทศ</a></li> --}}
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.educationbranch')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.educationbranch')?'active':''}}">สาขาการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.educationlevel')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.educationlevel')?'active':''}}">ระดับการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.businesstype')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.businesstype')?'active':''}}">ประเภทธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.industrygroup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.industrygroup')?'active':''}}">กลุ่มอุตสาหกรรม</a></li>
                {{-- <li class="nav-item"><a href="{{route('setting.admin.dashboard.registeredcapitaltype')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.registeredcapitaltype')?'active':''}}">การจดทะเบียน</a></li> --}}
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.businessplanstatus')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.businessplanstatus')?'active':''}}">สถานะโครงการ</a></li>
                {{-- <li class="nav-item"><a href="{{route('setting.admin.dashboard.userposition')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.userposition')?'active':''}}">ตำแหน่งผู้ใช้งาน</a></li> --}}
                {{-- <li class="nav-item"><a href="{{route('setting.admin.dashboard.expertposition')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.expertposition')?'active':''}}">ตำแหน่งผู้เชี่ยวชาญ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.banktype')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.banktype')?'active':''}}">ประเภทบัญชีเงินฝาก</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.bankaccount')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.bankaccount')?'active':''}}">บัญชีเงินฝาก</a></li> --}}
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.website')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>เว็บไซต์</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.admin.website.pagestatus')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.pagestatus')?'active':''}}">สถานะเพจ</a></li>	
                <li class="nav-item"><a href="{{route('setting.admin.website.pagecategory.create')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.pagecategory')?'active':''}}">หมวดหมู่เพจ</a></li>
                {{-- <li class="nav-item"><a href="{{route('setting.admin.website.faqcategory')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.faqcategory')?'active':''}}">หมวดหมู่คำถามที่พบบ่อย</a></li> --}}
                <li class="nav-item"><a href="{{route('setting.admin.website.faq')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.faq')?'active':''}}">คำถามที่พบบ่อย</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.website.tag')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.tag')?'active':''}}">ป้ายกำกับ</a></li>		             
                {{-- <li class="nav-item"><a href="{{route('setting.admin.website.slide')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.slide')?'active':''}}">ภาพสไลด์</a></li>		              --}}
                {{-- <li class="nav-item"><a href="{{route('setting.admin.website.introsection')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.introsection')?'active':''}}">Intro section</a></li>		              --}}
                <li class="nav-item"><a href="{{route('setting.admin.website.page')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.page')?'active':''}}">หน้าเพจ</a></li>		             
                {{-- <li class="nav-item"><a href="{{route('setting.admin.website.announce')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.announce')?'active':''}}">ประกาศ</a></li>	 --}}
                <li class="nav-item"><a href="{{route('setting.admin.website.menu.create')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.menu.create')?'active':''}}">เมนู</a></li>	
                {{-- <li class="nav-item"><a href="{{route('setting.admin.website.layout')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.layout')?'active':''}}">เลย์เอาท์</a></li>	 --}}
                <li class="nav-item"><a href="{{route('setting.admin.website.frontpage')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.frontpage')?'active':''}}">หน้าแรกพิเศษ</a></li>	
                <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage')?'nav-item-expanded':''}}">
                    <a href="#" class="nav-link"><span>หน้าแรก (Homepage)</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.banner')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.banner')?'active':''}}">Banner</a></li>		             
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.service')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.service')?'active':''}}">Service</a></li>		             
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.industryugroup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.industryugroup')?'active':''}}">กลุ่มอุตสาหกรรม</a></li>	
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.pillar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.pillar')?'active':''}}">Pillar</a></li>	
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.user')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ผู้ใช้งานระบบ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.admin.user')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.user')?'active':''}}">ผู้ใช้งาน</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.userlog')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.userlog')?'active':''}}">Log</a></li>		             
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.assessment')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>EV</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="EV">
                {{-- <li class="nav-item"><a href="{{route('setting.admin.assessment.criteriagroup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.criteriagroup')?'active':''}}">เกณฑ์การประเมิน</a></li>		              --}}
                {{-- <li class="nav-item"><a href="{{route('setting.admin.assessment.ev')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.ev')?'active':''}}">EV Template</a></li>		              --}}
                {{-- <li class="nav-item"><a href="{{route('setting.admin.assessment.evportion')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.evportion')?'active':''}}">EV Portion</a></li>		              --}}
                <li class="nav-item"><a href="{{route('setting.admin.assessment.pillar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.pillar')?'active':''}}">Pillar</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.assessment.subpillar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.subpillar')?'active':''}}">Sub Pillar</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.assessment.subpillarindex')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.subpillarindex')?'active':''}}">Sub Pillar Index</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.assessment.criteria')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.criteriagroup')?'active':''}}">Criteria</a></li>		             
            </ul>
        </li>
        @if (Auth::user()->user_type_id >= 5)
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.system')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ระบบ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ระบบ">
                <li class="nav-item"><a href="{{route('setting.admin.system')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.system')?'active':''}}">ตั้งค่าระบบ</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.system.projectflow')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.system.projectflow')?'active':''}}">Control Flow</a></li>		             
            </ul>
        </li>
        @endif
    </ul>	
    </li>
    @endif
{{-- @endif --}}


{{-- @if (Auth::user()->user_type_id <= 2 && !Empty(Auth::user()->company))
<li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>ตั้งค่า</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="ตั้งค่า">
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.user.company')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ข้อมูลกิจการ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ข้อมูลกิจการ">
                <li class="nav-item"><a href="{{route('setting.user.company.edit',['userid' => Auth::user()->id])}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.user.company.edit')?'active':''}}">ข้อมูลกิจการ</a></li>		             
            </ul>
        </li>
    </ul>	
</li>
@endif --}}
