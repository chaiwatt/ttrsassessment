@extends('layouts.login')
    @if( Session::has('error') )
        <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">{{ Session::get('error') }}</span>
        </div>
    @endif
@section('content')
    <div id="modal_term" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header pb-3">
                    <h5 class="modal-title">นโยบายและข้อกำหนด</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body py-0">
                    {!!$generalinfo->consent!!}
                </div>
                <div class="modal-footer pt-3">
                    <button type="button" class="btn btn-link" data-dismiss="modal">ปิด</button>
                    <button type="button" id="btnaccept" class="btn bg-primary" data-dismiss="modal" disabled>ยอมรับ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="login-form" style="width:600px">
        <div class="card mb-0">
            <div class="card mb-0">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                <ul class="nav nav-tabs nav-justified alpha-grey mb-0" id="usertype">
                    <li class="nav-item bg-info-300" value="1"><a href="#login-tab1" class="nav-link border-y-0 border-left-0 active" data-toggle="tab"><h6 class="my-1"><span style="font-size: 18px">ผู้ขอรับการประเมิน</span></h6></a></li>
                    <li class="nav-item bg-teal-300" value="2"><a href="#login-tab2" class="nav-link border-y-0 border-right-1" data-toggle="tab"><h6 class="my-1" style="font-size: 18px">เจ้าหน้าที่ TTRS</h6></a></li>
                    <li class="nav-item bg-warning-300" value="3"><a href="#login-tab3" class="nav-link border-y-0 border-right-0" data-toggle="tab"><h6 class="my-1" style="font-size: 18px">ผู้เชี่ยวชาญ</h6></a></li>
                </ul>
                
                <div class="tab-content card-body">
                    <div class="tab-pane fade show active" id="login-tab1">
                        
                        <div class="text-center mb-3 mb-md-2" style="font-size:40px">
                            สมัครสมาชิก
                        </div>
        
                    </div>
                    <div class="tab-pane fade" id="login-tab2">
                        <div class="text-center mb-3 mb-md-2" style="font-size:40px">
                            สมัครสมาชิก
                        </div>
                    </div>
                    <div class="tab-pane fade" id="login-tab3">
                        <div class="text-center mb-3 mb-md-2" style="font-size:40px">
                            สมัครสมาชิก
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
                    
                    <div class="form-group form-group-feedback form-group-feedback-left" id="userselect">                    
                        <select id="usergroup" name="usergroup" data-placeholder="ประเภท" class="form-control form-control-lg form-control-select2">
                            @foreach ($usergroups as $usergroup)
                                <option value="{{$usergroup->id}}" >{{$usergroup->name}}</option> 
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group" id="vatwrapper" >
                        <input id="vatno" type="text" class="form-control form-control-lg numeralformath13 @error('vatno') is-invalid @enderror" name="vatno" value="{{ old('vatno') }}" placeholder="เลขประจำตัวผู้เสียภาษีอากร/บัตรประชาชน" >
                        <label id="vatnomessage" class="validation-invalid-label" hidden><small id="msg"></small></label>
                        @error('vatno')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                        <input type="text" name="companyname" id="companyname" hidden>
                    </div>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="name" type="text" class="form-control form-control-lg stringformat60 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="ชื่อ" autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                        @error('name')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>             
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="lastname" type="text" class="form-control form-control-lg stringformat60 @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"  placeholder="นามสกุล" autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                        @error('lastname')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>    
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="email" type="email" class="form-control form-control-lg stringformat60 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="อีเมล" title="โปรดใช้อีเมลที่สามารถส่งข้อมูล เพื่อยืนยันตัวบุคคลได้">
                        <div class="form-control-feedback">
                            <i class="icon-mention text-muted"></i>
                        </div>
                        @error('email')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="phone" type="phone" class="form-control form-control-lg numeralformathphone @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="เบอร์มือถือ">
                        <div class="form-control-feedback">
                            <i class="icon-phone2 text-muted"></i>
                        </div>
                        @error('phone')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="pwd-container">
                        <div class="form-group form-group-feedback form-group-feedback-left" >
                            <input id="password" type="password" class="form-control form-control-lg engonly @error('password') is-invalid @enderror" name="password" title="ใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษเท่านั้น รวมกันอย่างน้อย 8 ตัวอักษร" placeholder="ใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษเท่านั้น รวมกันอย่างน้อย 8 ตัวอักษร">
                            <div class="form-control-feedback">
                                <i class="icon-eye-blocked text-muted toggle_password"></i>
                            </div>
                            @error('password')
                                <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                            @enderror
                            {{-- <small class="form-text text-right pwstrength_viewport_verdict"></small> --}}
                            
                        </div>
        
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input id="password-confirm" type="password" class="form-control engonly form-control-lg" name="password_confirmation" title="ใช้ได้เฉพาะตัวอักษรและภาษาอังกฤษเท่านั้น" placeholder="ยืนยันรหัสผ่าน">
                            <div class="form-control-feedback ">
                                <i class="icon-eye-blocked text-muted toggle_password"></i>
                            </div>
                            {{-- <div class="col-sm-12" style="padding-top: 5px;"> --}}
                            <div class="pwstrength_viewport_progress" style="padding-top: 10px;"></div>
                            {{-- </div> --}}
                        </div>

                    </div>

                    <div class="form-group d-flex align-items-center">
                        <a href="#" data-toggle="modal" data-target="#modal_term" class="text-primary"><u>ยอมรับนโยบายและข้อกำหนด</u></a>  
                    </div>
                    <input id="user_type" type="text" class="form-control form-control-lg" name="user_type" hidden>
                    <div class="form-group">
                        <button type="submit" id="term" class="btn btn-primary btn-block" disabled><span style="font-size: 18px">สมัครสมาชิก</span>  <i class="icon-circle-right2 ml-2"></i></button>
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
        <script src="{{asset('assets/dashboard/js/plugins/cleave/cleave.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
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
                    // showStatus: true,
                    // showProgressBar: false,
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

            $(document).on('keyup', '#password', function(e) {
                if($(this).val() == ''){
                    $(".pwstrength_viewport_progress").attr("hidden",true);
                }else{
                    $(".pwstrength_viewport_progress").attr("hidden",false);
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

        $(document).on('keyup', '.engonly', function(e) {
                var pattern_eng = /^[0-9a-zA-Z]+$/;
                if(!$(this).val().match(pattern_eng) && $(this).val() != ''){
                    $(this).val('')
                    Swal.fire({
                        title: 'ผิดพลาด...',
                        text: 'ใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษเท่านั้น รวมกันอย่างน้อย 8 ตัวอักษร',
                    }).then((result) => {});
                    return false;
                }
        });

        </script>	
    @stop

@endsection




