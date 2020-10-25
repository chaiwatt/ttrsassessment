import * as Geo from './location.js'

// $("#province").change(function(){
$(document).on('change', '#province', function(e) {
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphur").html(html);
        $("#amphur option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});
$(document).on('change', '#amphur', function(e) {
// $("#amphur").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#tambol").html(html);
        $("#tambol option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on('change', '#factoryprovince', function(e) {
// $("#factoryprovince").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#factoryamphur").html(html);
        $("#factoryamphur option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});
$(document).on('change', '#factoryamphur', function(e) {
// $("#factoryamphur").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#factorytambol").html(html);
        $("#factorytambol option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on('change', '#province1', function(e) {
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphur1").html(html);
        $("#amphur1 option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on('change', '#amphur1', function(e) {
        Geo.tambol($(this).val()).then(data => {
            let  html = "";
            data.forEach((tambol,index) => 
                html += `<option value='${tambol.id}'>${tambol.name}</option>`
            )
            $("#tambol1").html(html);
            $("#tambol1 option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).trigger('change');
        })
        .catch(error => {
            console.log(error)
        })
    });