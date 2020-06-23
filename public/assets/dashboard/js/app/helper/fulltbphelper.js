import * as ThaiWord from './thaiword.js';


$(document).on('keyup', '#companyprofile_input', function(e) {
    if (e.keyCode === 13) {
        console.log(ThaiWord.countCharTh('สวัสดี จ๊ะ'));

        var html = `<input type="text" name ="companyprofile[]" id="xx" value="${$(this).val()}" class="form-control companyprofileclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_companyprofile_wrapper').append(html);
    }
});



$(document).on('keyup', '.companyprofileclass', function(e) {
    console.log(ThaiWord.countCharTh($(this).val()));
    $('#companyprofiletextlength').html((90-ThaiWord.countCharTh($(this).val())));
});