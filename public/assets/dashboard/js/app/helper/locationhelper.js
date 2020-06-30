import * as Geo from './location.js'

$("#province").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphur").html(html);
        $("#amphur option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});
$("#amphur").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#tambol").html(html);
        $("#tambol option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});


$("#factoryprovince").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#factoryamphur").html(html);
        $("#factoryamphur option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});

$("#factoryamphur").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#factorytambol").html(html);
        $("#factorytambol option:contains("+$(this).find("option:selected").text()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});