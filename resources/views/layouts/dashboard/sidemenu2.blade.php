    <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.')?'nav-item-expanded nav-item-open':''}}">
    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>ตั้งค่า</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="ตั้งค่า">
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.dashboard')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ทั่วไป</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ทั่วไป">
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.prefix')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.prefix')?'active':''}}">คำนำหน้าชื่อ</a></li>	
              
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.educationlevel')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.educationlevel')?'active':''}}">ระดับการศึกษา</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.businesstype')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.businesstype')?'active':''}}">ประเภทธุรกิจ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.industrygroup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.industrygroup')?'active':''}}">กลุ่มอุตสาหกรรม</a></li>
               
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.businessplanstatus')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.businessplanstatus')?'active':''}}">สถานะโครงการ</a></li>
                <li class="nav-item"><a href="{{route('setting.admin.dashboard.popup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.dashboard.popup')?'active':''}}">ข้อความ Popup</a></li>
             
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.website')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>เว็บไซต์</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
             
                <li class="nav-item"><a href="{{route('setting.admin.website.page')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.page')?'active':''}}">หน้าบทความ</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.website.webpage')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website')?'active':''}}">หน้าเพจ</a></li>		             
              
                <li class="nav-item"><a href="{{route('setting.admin.website.menu')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.menu')?'active':''}}">เมนู</a></li>	
             
                <li class="nav-item"><a href="{{route('setting.admin.website.frontpage')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.frontpage')?'active':''}}">หน้า Billboard</a></li>	
                <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage')?'nav-item-expanded':''}}">
                    <a href="#" class="nav-link"><span>หน้าแรก (Homepage)</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="เว็บไซต์">
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.layout')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.layout')?'active':''}}">Layout</a></li>		             
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.banner')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.banner')?'active':''}}">Banner</a></li>		             
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.service')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.service')?'active':''}}">ขั้นตอนการบริการ</a></li>		             
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.industryugroup')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.industryugroup')?'active':''}}">ผลการดำเนินงาน</a></li>	
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.pillar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.pillar')?'active':''}}">แนะนำบริการ</a></li>	
                        <li class="nav-item"><a href="{{route('setting.admin.website.homepage.faq')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.website.homepage.faq')?'active':''}}">คำถามที่พบบ่อย</a></li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><span>Custom Section</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Custom Section">
                                @for ($i = 6; $i <= 10; $i++)
                                    <li class="nav-item" style="margin-left:15px"><a href="{{route('setting.admin.website.homepage.customsection',['id' => $i])}}" class="nav-link">Section {{$i-5}}</a></li>		             
                                @endfor
                                
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{route('landing.sitemap')}}" class="nav-link {{starts_with(Route::currentRouteName(),'landing.sitemap')?'active':''}}" target="_blank" >Sitemap</a></li>	
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
              
                <li class="nav-item"><a href="{{route('setting.admin.assessment.pillar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.pillar')?'active':''}}">Pillar</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.assessment.subpillar')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.subpillar')?'active':''}}">Sub Pillar</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.assessment.subpillarindex')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.subpillarindex')?'active':''}}">Sub Pillar Index</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.assessment.criteria')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.criteriagroup')?'active':''}}">Criteria</a></li>
                <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.assessment')?'nav-item-expanded':''}}">
                    <a href="#" class="nav-link"><span>Extra Criteria</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Extra Criteria">
                        <li class="nav-item"><a href="{{route('setting.admin.assessment.extracategory')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.extracriteria')?'active':''}}">Extra Category</a></li>		             
                        <li class="nav-item"><a href="{{route('setting.admin.assessment.extracriteria')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.assessment.extracriteria')?'active':''}}">Extra Criteria</a></li>		             
                    </ul>
                </li>	             
            </ul>
        </li>
   
        <li class="nav-item nav-item-submenu {{starts_with(Route::currentRouteName(),'setting.admin.system')?'nav-item-expanded':''}}">
            <a href="#" class="nav-link"><span>ระบบ</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="ระบบ">
                <li class="nav-item"><a href="{{route('setting.admin.system')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.system')?'active':''}}">ตั้งค่าระบบ</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.system.projectflow')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.system.projectflow')?'active':''}}">Control Flow</a></li>		             
                <li class="nav-item"><a href="{{route('setting.admin.system.contactinfo')}}" class="nav-link {{starts_with(Route::currentRouteName(),'setting.admin.system.contactinfo')?'active':''}}">ข้อมูลการติดต่อ</a></li>
            </ul>
        </li>
     
    </ul>	
    </li>


