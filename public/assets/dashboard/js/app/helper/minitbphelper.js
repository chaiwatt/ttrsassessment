// import * as MiniTbp from './minitbp.js';

// $("#finance1").on('change', function() {
$(document).on('change', '#finance1', function(e) {   
    if($(this).is(":checked")){
        $("#financediv1").attr("hidden",false);
    }else{
        $("#financediv1").attr("hidden",true);
    }
});

// $("#finance4").on('change', function() {
$(document).on('change', '#finance4', function(e) {
    if($(this).is(":checked")){
        $("#financediv2").attr("hidden",false);
    }else{
        $("#financediv2").attr("hidden",true);
    }
});

// $("#nonefinance4").on('change', function() {
$(document).on('change', '#nonefinance4', function(e) {
    if($(this).is(":checked")){
        $("#nonefinancediv1").attr("hidden",false);
    }else{
        $("#nonefinancediv1").attr("hidden",true);
    }
});

// $("#nonefinance5").on('change', function() {
$(document).on('change', '#nonefinance5', function(e) {
    if($(this).is(":checked")){
        $("#nonefinancediv2").attr("hidden",false);
    }else{
        $("#nonefinancediv2").attr("hidden",true);
    }
});

// $("#finance1").on('change', function() {
$(document).on('change', '#finance1', function(e) {
    if($(this).is(":checked")){
        $("#financediv1").attr("hidden",false);
    }else{
        $("#financediv1").attr("hidden",true);
    }
});

$(document).on('change', '#usersignature', function(e) {
    if($(this).val() == 1){
        $("#signature_wrapper").attr("hidden",true);
    }else{
        $("#signature_wrapper").attr("hidden",false);
    }
});
