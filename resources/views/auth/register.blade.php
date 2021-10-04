@extends('layouts.login')
    @if( Session::has('error') )
        <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">{{ Session::get('error') }}</span>
        </div>
    @endif
@section('content')
    <div id="modal_term" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header pb-3">
                    <h5 class="modal-title">นโยบายและข้อกำหนด (กรุณาเลื่อนอ่านเพื่อยอมรับ)</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body py-0">
                    <div class="form-group"  >
                        {!!$generalinfo->consent!!}
                    </div>
                    <div class="form-group float-right"  >
                        <button type="button" id="btnaccept2" class="btn bg-primary" data-dismiss="modal">ยอมรับ</button>
                    </div>
                    
                </div>
                <div class="modal-footer pt-3">
                    {{-- <button type="button" class="btn btn-link" data-dismiss="modal">ปิด</button>
                    <button type="button" id="btnaccept" class="btn bg-primary" data-dismiss="modal" disabled>ยอมรับ</button> --}}
                </div>
            </div>
        </div>
    </div>


<!-- Content area -->
{{-- <div class="content d-flex justify-content-center align-items-center">
    <form action="index.html" class="flex-fill">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="text-center mb-3">
                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                </div>
                <div class="card mb-0">
                    
                    <div class="card-body">
                       
                        <ul class="nav nav-tabs nav-justified alpha-grey mb-0" id="usertype">
                            <li class="nav-item bg-info-300" style="margin-right:5px" value="1"><a href="#login-tab1" class="nav-link border-y-0 border-left-0 active" data-toggle="tab"><h6 class="my-1"><span style="font-size: 18px">ผู้ขอรับการประเมิน</span></h6></a></li>
                            <li class="nav-item bg-teal-300" style="margin-right:5px" value="2"><a href="#login-tab2" class="nav-link border-y-0 border-right-1" data-toggle="tab"><h6 class="my-1" style="font-size: 18px">เจ้าหน้าที่ TTRS</h6></a></li>
                            <li class="nav-item bg-warning-300" style="margin-right:5px" value="3"><a href="#login-tab3" class="nav-link border-y-0 border-right-0" data-toggle="tab"><h6 class="my-1" style="font-size: 18px">ผู้เชี่ยวชาญ</h6></a></li>
                        </ul>

                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="text" class="form-control" placeholder="Choose username">
                            <div class="form-control-feedback">
                                <i class="icon-user-plus text-muted"></i>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control" placeholder="First name">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-check text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control" placeholder="Second name">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-check text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="password" class="form-control" placeholder="Create password">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="password" class="form-control" placeholder="Repeat password">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="email" class="form-control" placeholder="Your email">
                                    <div class="form-control-feedback">
                                        <i class="icon-mention text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="email" class="form-control" placeholder="Repeat email">
                                    <div class="form-control-feedback">
                                        <i class="icon-mention text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-input-styled" checked data-fouc>
                                    Send me <a href="#">test account settings</a>
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-input-styled" checked data-fouc>
                                    Subscribe to monthly newsletter
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-input-styled" data-fouc>
                                    Accept <a href="#">terms of service</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> Create account</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> --}}
<!-- /content area -->

    
 <div class="login-form" style="width:800px">
    <div class="text-center mb-2">
        <a href="{{url('')}}"><img  src="{{asset('assets/dashboard/images/headerlogowhite.png')}}" alt=""></a>   
    </div>
        <div class="card mb-0">
            <div class="card mb-0">
                {{-- <div class="text-center mb-0">
                    
                    <img  src="{{asset('assets/dashboard/images/loginlogo.png')}}" alt="">
                </div> --}}

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                <ul class="nav nav-tabs nav-justified alpha-grey " id="usertype" >
                    <li class="nav-item bg-info-300" style="margin-right:5px" value="1"><a href="#login-tab1" class="nav-link border-y-0 border-left-0 register active" data-toggle="tab" ><h6 class="my-1"><span style="font-size: 18px;">ผู้ขอรับการประเมิน</span></h6></a></li>
                    <li class="nav-item bg-teal-300" style="margin-right:5px" value="2"><a href="#login-tab2" class="nav-link border-y-0 border-left-0 register" data-toggle="tab"><h6 class="my-1"><span style="font-size: 18px">ผู้ขอรับการประเมิน</span></h6></a></li>
                    {{-- <li class="nav-item bg-teal-300" style="margin-right:5px" value="2"><a href="#login-tab2" class="nav-link border-y-0 border-right-0" data-toggle="tab"><h6 class="my-1" style="font-size: 18px">เจ้าหน้าที่ TTRS</h6></a></li> --}}
                    {{-- <li class="nav-item bg-warning-300" style="margin-right:5px" value="3"><a href="#login-tab3" class="nav-link border-y-0 border-right-1" data-toggle="tab"><h6 class="my-1" style="font-size: 18px">ผู้เชี่ยวชาญ</h6></a></li> --}}
                    <li class="nav-item bg-warning-300" style="margin-right:5px" value="3"><a href="#login-tab3" class="nav-link border-y-0 border-left-0 register" data-toggle="tab"><h6 class="my-1"><span style="font-size: 18px">ผู้ขอรับการประเมิน</span></h6></a></li>
                </ul>
                
                <div class="tab-content card-body" style="margin-top:-20px">
                    {{-- <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div> --}}
                    <div class="tab-pane fade show active" id="login-tab1">
                        
                        <div class="text-center mb-3 mb-md-2" style="font-size:32px">
                            ผู้ขอรับการประเมิน
                        </div>
        
                    </div>
                    <div class="tab-pane fade" id="login-tab2">
                        <div class="text-center mb-3 mb-md-2" style="font-size:32px">
                            เจ้าหน้าที่ TTRS
                        </div>
                    </div>
                    <div class="tab-pane fade" id="login-tab3">
                        <div class="text-center mb-3 mb-md-2" style="font-size:32px">
                            ผู้เชี่ยวชาญ
                        </div>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input-styled" name="expert" value="1" checked data-fouc>
                                    ผู้เชี่ยวชาญภายใน
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input-styled" name="expert" value="2" data-fouc>
                                    ผู้เชี่ยวชาญภายนอก
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-feedback form-group-feedback-left" id="userselect">                    
                                <select id="usergroup" name="usergroup" data-placeholder="ประเภท" class="form-control form-control-lg form-control-select2">
                                    @foreach ($usergroups as $usergroup)
                                        <option value="{{$usergroup->id}}" >{{$usergroup->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="vatwrapper" >
                                <input id="vatno" type="text" maxlength="13" class="form-control form-control-lg allownumericwithoutdecimal @error('vatno') is-invalid @enderror" name="vatno" value="{{ old('vatno') }}" placeholder="เลขประจำตัวผู้เสียภาษีอากร/บัตรประจำตัวประชาชน" >
                                <label id="vatnomessage" class="validation-invalid-label" hidden><small id="msg"></small></label>
                                @error('vatno')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror
                                <input type="text" name="companyname" id="companyname" hidden>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="name" type="text" class="form-control form-control-lg stringformat60 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="ชื่อ" autofocus>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                @error('name')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="lastname" type="text" class="form-control form-control-lg stringformat60 @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"  placeholder="นามสกุล" autofocus>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                @error('lastname')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="email" type="email" class="form-control form-control-lg stringformat60 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="อีเมล" title="โปรดใช้อีเมลที่สามารถส่งข้อมูล เพื่อยืนยันตัวบุคคลได้">
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                                @error('email')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror
                                <span id="email_input_error" class="form-text text-danger" hidden  ><i class="icon-cancel-circle2 text-danger"></i> รูปแบบอีเมลไม่ถูกต้อง</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="phone" type="text" maxlength="10" name="phone" class="form-control form-control-lg allownumericwithoutdecimal @error('phone') is-invalid @enderror"  value="{{ old('phone') }}"  placeholder="เบอร์โทรศัพท์มือถือ">
                                <span id="phone_input_error" class="form-text text-danger" hidden  ><i class="icon-cancel-circle2 text-danger"></i> เบอร์โทรศัพท์ไม่ถูกต้อง</span>
                                <div class="form-control-feedback">
                                    <i class="icon-phone2 text-muted"></i>
                                </div>
                                @error('phone')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                              <div class="input-group form-group form-group-feedback form-group-feedback-left" >
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" title="ข้อแนะนำ: กรุณาใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษ รวมกันอย่างน้อย 8 ตัวอักษร" placeholder="รหัสผ่าน">
                                
                                <div class="form-control-feedback">
                                    <i class="icon-eye-blocked text-muted toggle_password"></i>
                                </div>
                                
                                @error('password')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror
                                
                                <span class="input-group-append">
                                    <button class="btn btn-light" type="button" id="genpassword" >สุ่มรหัสผ่าน</button>
                                </span>
                                <span id="password_input_error" class="form-text text-danger" hidden  ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษ รวมกันอย่างน้อย 8 ตัวอักษร</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" title="ข้อแนะนำ: กรุณาใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษ รวมกันอย่างน้อย 8 ตัวอักษร" placeholder="ยืนยันรหัสผ่าน">
                                <div class="form-control-feedback ">
                                    <i class="icon-eye-blocked text-muted toggle_password"></i>
                                </div>
                            </div>
                        </div>
   

                        <div class="col-md-12" id="pwd-container">
                            
                          
                            
                            <div class="pwstrength_viewport_progress"></div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group d-flex align-items-center">
                                <a href="#" data-toggle="modal" data-target="#modal_term" class="text-primary"><u>ยอมรับนโยบายและข้อกำหนด</u></a>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input id="user_type" type="text" class="form-control form-control-lg" name="user_type" hidden>
                            <div class="form-group">
                                <button type="submit" id="term" class="btn btn-primary btn-block" disabled><span style="font-size: 18px">สมัครสมาชิก</span>  <i class="icon-circle-right2 ml-2"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="{{ route('login') }}" class="btn btn-light btn-block"><span style="font-size: 18px">{{trans('lang.login')}}</span></a>
                            </div>
                        </div>
                    </div>
                    
              
    
                
                               
                       
                    
    
                    

        
                   


                </div>
                </form>
            </div>
        </div>
    </div> 

    @section('pageScript')
        <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switchery.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/plugins/pwstrength/pwstrength.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/plugins/sweetalert2/sweetalert2.js')}}"></script>
        {{-- <script src="{{asset('assets/dashboard/js/plugins/cleave/cleave.min.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=1')}}"></script> --}}
        <script type="module" src="{{asset('assets/dashboard/js/app/helper/registerhelper.js')}}"></script>
        <script>
                var route = {
                url: "{{ url('/') }}",
                token: $('meta[name="csrf-token"]').attr('content'),
            };

            jQuery(document).ready(function () {
                "use strict";
                var options = {};
                options.ui = {
                    container: "#pwd-container",
                    addRule: function (name, method, score, active) {
                        this.each(function (idx, el) {
                            var options = $(el).data("pwstrength");
                            options.rules[name] = active;
                            options.ruleScores[name] = score;
                            options.validationRules[name] = method;
                        });
                    },
                    viewports: {
                        progress: ".pwstrength_viewport_progress"
                    },
                        showVerdictsInsideProgressBar: true
                };
                $('#password').pwstrength(options);
            });
            $(".nav-item").on('click', function() {
                $('#user_type').val($(this).val());
            });
            $(".toggle_password").click(function() {
                var check = $('#password').attr("type");
                if (check == "password") {
                    $('.toggle_password').removeClass("icon-eye-blocked");
                    $('.toggle_password').addClass("icon-eye");
                    $('#password').attr("type", "text");
                    $('#password-confirm').attr("type", "text");
                } else {
                    $('.toggle_password').addClass("icon-eye-blocked");
                    $('.toggle_password').removeClass("icon-eye");
                    $('#password').attr("type", "password");
                    $('#password-confirm').attr("type", "password");
                }
            });
            $(document).on('change', '#email', function(e) {
                if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@(\w)+(?:\.[a-zA-Z0-9-]+)*$/.test($('#email').val())== false)
                {
                    $("#email_input_error").attr("hidden",false);
                    $('#email').val('') ;
                    return;
                }else{
                    $("#email_input_error").attr("hidden",true);
                }
            });

            $(document).on('keyup', '#password', function(e) {
                this.selectionStart = this.selectionEnd = this.value.length;
                var patt = /[ก-๙]/g;
                var res = patt.test($(this).val());
                if(res == true &&  $(this).val() != ''){
                   $(this).val().substring(0, $(this).val().length - 1);
                   $(this).val(($(this).val().substring(0, $(this).val().length - 1)));
                }
            });

            $(document).on('keyup', '#password-confirm', function(e) {
                this.selectionStart = this.selectionEnd = this.value.length;
                var patt = /[ก-๙]/g;
                var res = patt.test($(this).val());
                if(res == true &&  $(this).val() != ''){
                   $(this).val().substring(0, $(this).val().length - 1);
                   $(this).val(($(this).val().substring(0, $(this).val().length - 1)));
                }
            });

            $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                setCookie('lastTab', $(e.target).attr("href"), 100);
            })

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + "; " + expires;
            }

            var lastabcookie = getCookie('lastTab');
            $('.nav-tabs a[href="'+lastabcookie+'"]').tab('show');
            if(lastabcookie == '#login-tab2'){
                $('#user_type').val('2');
            }else if(lastabcookie == '#login-tab3'){
                $('#user_type').val('3');
            }else{
                $('#user_type').val('1');
            }

            $(document).on('change', '#usergroup', function(e) {
                if($(this).val() == 1){
                    setCookie('lastGroup', 1, 100);
                }else{
                    setCookie('lastGroup', 2, 100);
                }
            });

            $(document).on("change","input[type=radio]",function(){
                var expert=$('[name="expert"]:checked').val();
                if($(this).val() == 1){
                    setCookie('experttype', 1, 100);
                }else{
                    setCookie('experttype', 2, 100);
                }
            });

            var lasusergroupcookie = getCookie('lastGroup');  //นิติบุคคล บุคคลธรรมดา
            if(lasusergroupcookie == '' || lasusergroupcookie == 1){
                $('#usergroup').val(1);
                $('#usergroup').select2().trigger('change');
            }else{
                $('#usergroup').val(2);
                $('#usergroup').select2().trigger('change');
            }

            var expertvalue = getCookie('experttype');  //ผู้เชี่ยวชายภายนอก ภายใน
            $("input[name='expert'][value='"+expertvalue+"']").prop('checked', true);

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length,c.length);
                    }
                }
                return "";
            }

        $(document).on('change', '#phone', function(e) {
            if($(this).val().length < 9 || $(this).val().length > 10 ){
                $(this).val('')
                $("#phone_input_error").attr("hidden",false);
            }else{
                
                $("#phone_input_error").attr("hidden",true);
            }
        });

        $(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        
        $(document).on('click', '#genpassword', function(e) {
            var genpass = password_generator(10);
            $('#password').attr("type", "text");
            $('#password').val(genpass);
            $('#password-confirm').val(genpass);
            $('#password').keyup();
        });

        function password_generator( len ) {
            var length = (len)?(len):(10);
            var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
            var numeric = '0123456789';
            var punctuation = '@$&_-';
            var password = "";
            var character = "";
            var crunch = true;
            while( password.length<length ) {
                entity1 = Math.ceil(string.length * Math.random()*Math.random());
                entity2 = Math.ceil(numeric.length * Math.random()*Math.random());
                entity3 = Math.ceil(punctuation.length * Math.random()*Math.random());
                hold = string.charAt( entity1 );
                hold = (password.length%2==0)?(hold.toUpperCase()):(hold);
                character += hold;
                character += numeric.charAt( entity2 );
                character += punctuation.charAt( entity3 );
                password = character;
            }
            password=password.split('').sort(function(){return 0.5-Math.random()}).join('');
            return password.substr(0,len);
        }
        </script>	
    @stop

@endsection




