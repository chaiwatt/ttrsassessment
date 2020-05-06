<li class="nav-item nav-item-submenu ">
    <a href="#" class="nav-link"><i class="icon-chart"></i> <span>รายงาน</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="รายงาน">
        <li class="nav-item"><a href="" class="nav-link">รายงาน</a></li>										
    </ul>
</li>
<li class="nav-item nav-item-submenu">
    <a href="#" class="nav-link"><i class="icon-clipboard2"></i> <span>การประเมิน</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="รายการประเมิน">
        <li class="nav-item"><a href="" class="nav-link">รายการรอประเมิน</a></li>	
        <li class="nav-item"><a href="" class="nav-link">รายการผ่านประเมิน</a></li>										
    </ul>
</li>
@if (Auth::user()->user_type_id == 1)
<li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.') ? 'nav-item-expanded nav-item-open' : '' }}">
    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>ตั้งค่า</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="ตั้งค่า">
        <li class="nav-item"><a href="" class="nav-link">หมวดข่าว</a></li>
        <li class="nav-item"><a href="" class="nav-link">ป้ายกำกับ</a></li>	
        <li class="nav-item"><a href="" class="nav-link">ทั่วไป</a></li>									
        <li class="nav-item"><a href="" class="nav-link">ผู้ใช้งาน</a></li>	
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>ทั่วไป</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ทั่วไป">
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.prefix')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.prefix') ? 'active' : '' }}">คำนำหน้าชื่อ</a></li>	
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.religion')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.religion') ? 'active' : '' }}">ศาสนา</a></li>										
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.country')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.country') ? 'active' : '' }}">ประเทศ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.educationbranch')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.educationbranch') ? 'active' : '' }}">สาขาการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.educationlevel')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.educationlevel') ? 'active' : '' }}">ระดับการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.businesstype')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.businesstype') ? 'active' : '' }}">ประเภทธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.industrygroup')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.industrygroup') ? 'active' : '' }}">กลุ่มอุตสาหกรรม</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.registeredcapitaltype')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.registeredcapitaltype') ? 'active' : '' }}">การจดทะเบียน</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.businessplanstatus')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.businessplanstatus') ? 'active' : '' }}">สถานะการวางแผนธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.userposition')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.dashboard.userposition') ? 'active' : '' }}">ตำแหน่งผู้ใช้งาน</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.admin.website') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>เว็บไซต์</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.admin.website.pagestatus')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.website.pagestatus') ? 'active' : '' }}">สถานะเพจ</a></li>	
                <li class="nav-item"><a href="{{route('setting.admin.website.pagecategory')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.website.pagecategory') ? 'active' : '' }}">หมวดหมู่เพจ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.website.faqcategory')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.website.faqcategory') ? 'active' : '' }}">หมวดหมู่ Faq</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.website.tag')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.website.tag') ? 'active' : '' }}">ป้ายกำกับ</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.website.slide')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.website.slide') ? 'active' : '' }}">ภาพสไลด์</a></li>		             
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.admin.user') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>ผู้ใช้งานระบบ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.admin.user')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.user') ? 'active' : '' }}">ผู้ใช้งาน</a></li>		             
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.admin.assessment') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>การประเมิน</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.admin.assessment.criteriagroup')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.admin.assessment.criteriagroup') ? 'active' : '' }}">เกณฑ์การประเมิน</a></li>		             
            </ul>
        </li>
    </ul>
    	
</li>
@endif

@if (Auth::user()->user_type_id == 3)
<li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.') ? 'nav-item-expanded nav-item-open' : '' }}">
    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>ตั้งค่า</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="ตั้งค่า">
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.user.company') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>บริษัท</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.user.company.edit',['userid' => Auth::user()->id])}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.user.company.edit') ? 'active' : '' }}">ข้อมูลบริษัท</a></li>		             
            </ul>
        </li>
    </ul>	
</li>
@endif
