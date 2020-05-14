<footer id="footer" class="mt-0">
    <div class="container my-4">
        <div class="row py-5">
            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                <h5 class="text-5 text-transform-none font-weight-light text-color-light mb-4">{{trans('lang.contactdetail')}}</h5>
                <p class="text-4 mb-0">{{$generalinfo->address}} ตำบล{{$generalinfo->tambol->name}} อำเภอ{{$generalinfo->amphur->name}} จังหวัด{{$generalinfo->province->name}} {{$generalinfo->postalcode}}</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                <h5 class="text-5 text-transform-none font-weight-light text-color-light mb-4">{{trans('lang.openhour')}}</h5>
                <p class="text-4 mb-0">จันทร์-ศุกร์: <span class="text-color-light">{{$generalinfo->workdaytime}}</span></p>
                <p class="text-4 mb-0">เสาร์: <span class="text-color-light">{{$generalinfo->saturdaytime}}</span></p>
                <p class="text-4 mb-0">อาทิตย์: <span class="text-color-light">{{$generalinfo->sundaytime}}</span></p>
            </div>
            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                <h5 class="text-5 text-transform-none font-weight-light text-color-light mb-4">{{trans('lang.callus')}}</h5>
                <p class="text-4 mb-0">โทรศัพท์: <span class="text-color-light">{{$generalinfo->phone1}} {{$generalinfo->phone2}}</span></p>
                <p class="text-4 mb-0">แฟ็กซ์: <span class="text-color-light">{{$generalinfo->fax}}</span></p>
            </div>
            <div class="col-md-6 col-lg-3">
                <h5 class="text-5 text-transform-none font-weight-light text-color-light mb-4">Social Media</h5>
                <ul class="footer-social-icons social-icons m-0">
                    <li class="social-icons-facebook"><a href="{{$generalinfo->facebook}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-icons-youtube"><a href="{{$generalinfo->youtube}}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-copyright footer-copyright-style-2 pb-4">
            <div class="py-2">
                <div class="row py-4">
                    <div class="col d-flex align-items-center justify-content-center mb-4 mb-lg-0">
                        <p>© {{trans('lang.copyright')}} {{date("Y")}} {{$generalinfo->company}} {{URL('')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>