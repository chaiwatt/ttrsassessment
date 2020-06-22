import * as ThaiWord from './thaiword.js';

$("#companyprofile_input").on('keyup', function (e) {
    if (e.keyCode === 13) {
        console.log(ThaiWord.countCharTh('สวัสดี จ๊ะ'));

        var html = `<input type="text" name ="companyprofile[]" id="" value="${$(this).val()}" class="form-control" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_companyprofile_wrapper').append(html);
    }
});

$('#companyprofile_input').keyup(function(){   
    console.log(ThaiWord.countCharTh($(this).val()));

});

