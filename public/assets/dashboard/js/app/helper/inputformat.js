$(function() {
    $('.numeralformat10').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralPositiveOnly: true,
            numeralIntegerScale: 10
        })
    });	
    $('.stringformat60').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [60],
            delimiter: ''
        })
    });
    $('.numeralformatyear').toArray().forEach(function(field){
        new Cleave(field, {
            numericOnly: true,
            blocks: [4]
        })
    });
    $('.numeralformatpostal').toArray().forEach(function(field){
        new Cleave(field, {
            numericOnly: true,
            blocks: [5]
        })
    });
    $('.numeralformath13').toArray().forEach(function(field){
        new Cleave(field, {
            numericOnly: true,
            blocks: [13]
        })
    });
    $('.numeralformathphone').toArray().forEach(function(field){
        new Cleave(field, {
            numericOnly: true,
            blocks: [13]
        })
    });
    $('.numeralformat2').toArray().forEach(function(field){
        new Cleave(field, {
            numericOnly: true,
            blocks: [2]
        })
    });
});
