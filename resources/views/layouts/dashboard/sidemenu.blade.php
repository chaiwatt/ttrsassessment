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
<li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.') ? 'nav-item-expanded nav-item-open' : '' }}">
    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>ตั้งค่า</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="ตั้งค่า">
        <li class="nav-item"><a href="" class="nav-link">หมวดข่าว</a></li>
        <li class="nav-item"><a href="" class="nav-link">ป้ายกำกับ</a></li>	
        <li class="nav-item"><a href="" class="nav-link">ทั่วไป</a></li>									
        <li class="nav-item"><a href="" class="nav-link">ผู้ใช้งาน</a></li>	
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.dashboard') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>ทั่วไป</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ทั่วไป">
                <li class="nav-item"><a href="{{route('setting.dashboard.prefix')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.prefix') ? 'active' : '' }}">คำนำหน้าชื่อ</a></li>	
                <li class="nav-item"><a href="{{route('setting.dashboard.religion')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.religion') ? 'active' : '' }}">ศาสนา</a></li>										
                <li class="nav-item"><a href="{{route('setting.dashboard.country')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.country') ? 'active' : '' }}">ประเทศ</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.educationbranch')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.educationbranch') ? 'active' : '' }}">สาขาการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.educationlevel')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.educationlevel') ? 'active' : '' }}">ระดับการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.businesstype')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.businesstype') ? 'active' : '' }}">ประเภทธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.industrygroup')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.industrygroup') ? 'active' : '' }}">กลุ่มอุตสาหกรรม</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.registeredcapitaltype')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.registeredcapitaltype') ? 'active' : '' }}">การจดทะเบียน</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.businessplanstatus')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.businessplanstatus') ? 'active' : '' }}">สถานะการวางแผนธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('setting.dashboard.userposition')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.dashboard.userposition') ? 'active' : '' }}">ตำแหน่งผู้ใช้งาน</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.website') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>เว็บไซต์</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.website.pagestatus')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.website.pagestatus') ? 'active' : '' }}">สถานะเพจ</a></li>	
                <li class="nav-item"><a href="{{route('setting.website.pagecategory')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.website.pagecategory') ? 'active' : '' }}">หมวดหมู่เพจ</a></li>
                <li class="nav-item"><a href="{{route('setting.website.faqcategory')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.website.faqcategory') ? 'active' : '' }}">หมวดหมู่ Faq</a></li>
                <li class="nav-item"><a href="{{route('setting.website.tag')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.website.tag') ? 'active' : '' }}">ป้ายกำกับ</a></li>		             
                <li class="nav-item"><a href="{{route('setting.website.slide')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.website.slide') ? 'active' : '' }}">ภาพสไลด์</a></li>		             
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.company') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>บริษัท</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.company.edit',['userid' => Auth::user()->id])}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.company.edit') ? 'active' : '' }}">ข้อมูลบริษัท</a></li>		             
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(), 'setting.user') ? 'nav-item-expanded' : '' }}">
            <a href="#" class="nav-link"><span>ผู้ใช้งานระบบ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                <li class="nav-item"><a href="{{route('setting.user')}}" class="nav-link {{starts_with(Route::currentRouteName(), 'setting.user') ? 'active' : '' }}">ผู้ใช้งาน</a></li>		             
            </ul>
        </li>
    </ul>	
</li>