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
    <div class="login-form wmin-xl-500">
        <div class="card mb-0">
            <div class="card mb-0">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                <ul class="nav nav-tabs nav-justified alpha-grey mb-0" id="usertype">
                    <li class="nav-item" value="1"><a href="#login-tab1" class="nav-link border-y-0 border-left-0 active" data-toggle="tab"><h6 class="my-1">ผู้ขอรับการประเมิน</h6></a></li>
                    <li class="nav-item" value="2"><a href="#login-tab2" class="nav-link border-y-0 border-right-1" data-toggle="tab"><h6 class="my-1">เจ้าหน้าที่ TTRS</h6></a></li>
                    <li class="nav-item" value="3"><a href="#login-tab3" class="nav-link border-y-0 border-right-0" data-toggle="tab"><h6 class="my-1">ผู้เชี่ยวชาญ</h6></a></li>
                </ul>
                
                <div class="tab-content card-body">
                    <div class="tab-pane fade show active" id="login-tab1">
                        {{-- <div class="text-center mb-0">
                            <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                        </div> --}}
                        
                        <div class="text-center mb-3 mb-md-2" style="font-size:40px">
                            สมัครสมาชิก
                        </div>
        
                    </div>
                    <div class="tab-pane fade" id="login-tab2">
                        {{-- <div class="text-center mb-0">
                            <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                        </div> --}}
                        <div class="text-center mb-3 mb-md-2" style="font-size:40px">
                            สมัครสมาชิก
                        </div>
                    </div>
                    <div class="tab-pane fade" id="login-tab3">
                        <div class="text-center mb-3 mb-md-2" style="font-size:40px">
                            สมัครสมาชิก
                        </div>
                        {{-- <div class="text-center mb-0">
                            <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                        </div> --}}
                        <div class="form-group mb-3 mb-md-2">
                            {{-- <label class="d-block font-weight-semibold">ประเภทผู้เชี่ยวชาญ</label> --}}
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input-styled" name="expert" value="1" checked data-fouc>
                                    ผู้เชี่ยวชาญภายใน
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input-styled" name="expert" value="2" data-fouc>
                                    ผู้เชี่ยวชาญนอก
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group form-group-feedback form-group-feedback-left" id="userselect">                    
                        <select id="usergroup" name="usergroup" data-placeholder="ประเภท" class="form-control form-control-select2">
                            @foreach ($usergroups as $usergroup)
                                <option value="{{$usergroup->id}}" >{{$usergroup->name}}</option> 
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group" id="vatwrapper" >
                        <label for="" class="text-info"><small>ใช้ทดสอบ 0105547107432 0107546000229 0105550075163 0105552012126 0105548008098 0105552061356 0105553151791 0107548000609</small> </label>
                        <input id="vatno" type="number" class="form-control @error('vatno') is-invalid @enderror" name="vatno" value="{{ old('vatno') }}" placeholder="เลขประจำตัวผู้เสียภาษีอากร" >
                        <label id="vatnomessage" class="validation-invalid-label" hidden><small id="msg"></small></label>
                        <input type="text" name="companyname" id="companyname" hidden>
                    </div>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="ชื่อ" autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>             
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"  placeholder="นามสกุล" autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>    
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="อีเมล" title="โปรดใช้อีเมลที่สามารถส่งข้อมูล เพื่อยืนยันตัวบุคคลได้">
                        <div class="form-control-feedback">
                            <i class="icon-mention text-muted"></i>
                        </div>
                        @error('email')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="เบอร์มือถือ">
                        <div class="form-control-feedback">
                            <i class="icon-phone2 text-muted"></i>
                        </div>
                        @error('phone')
                            <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="pwd-container">
                        <div class="form-group form-group-feedback form-group-feedback-left" >
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" title="ใช้ได้เฉพาะตัวอักษรและภาษาอังกฤษเท่านั้น" placeholder="รหัสผ่าน">
                            <div class="form-control-feedback">
                                <i class="icon-eye-blocked text-muted toggle_password"></i>
                            </div>
                            @error('password')
                                <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                            @enderror
                            <small class="form-text text-right pwstrength_viewport_verdict"></small>
                        </div>
        
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" title="ใช้ได้เฉพาะตัวอักษรและภาษาอังกฤษเท่านั้น" placeholder="ยืนยันรหัสผ่าน">
                            <div class="form-control-feedback ">
                                <i class="icon-eye-blocked text-muted toggle_password"></i>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <a href="#" data-toggle="modal" data-target="#modal_term" class="text-primary"><u>ยอมรับนโยบายและข้อกำหนด</u></a>  
                    </div>
                    <input id="user_type" type="text" class="form-control" name="user_type" value="1" hidden>
                    <div class="form-group">
                        <button type="submit" id="term" class="btn btn-primary btn-block" disabled>สมัครสมาชิก <i class="icon-circle-right2 ml-2"></i></button>
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
                    showProgressBar: false,
                    addRule: function (name, method, score, active) {
                        this.each(function (idx, el) {
                            var options = $(el).data("pwstrength");
                            options.rules[name] = active;
                            options.ruleScores[name] = score;
                            options.validationRules[name] = method;
                        });
                    },
                    viewports: {
                        verdict: ".pwstrength_viewport_verdict"
                    }
                };
                $('#password').pwstrength(options);
            });

            $(".nav-item").on('click', function() {
                $('#user_type').val($(this).val());
                // if($(this).val()!=1){
                //     $("#vatnomessage").attr("hidden",true);
                //     $("#userselect").attr("hidden",true);
                //     $('#usergroup').val(2);
                //     $('#usergroup').select2().trigger('change');
                // }else{
                //     $("#userselect").attr("hidden",false);
                // }
            });
            $(".toggle_password").click(function() {
                console.log($('#password').attr("type"));
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
        </script>	
    @stop

@endsection




