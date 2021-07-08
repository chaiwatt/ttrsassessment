

$(function() {
    $('.timeformat').toArray().forEach(function(field){
        new Cleave(field, {
            time: true,
            timePattern: ['h', 'm']
        })
    });	

    $('.dmyformat').toArray().forEach(function(field){
        new Cleave(field, {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        })
    });	

    $('.numeralformat2').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            numeralPositiveOnly: true,
            numeralIntegerScale: 2
        })
    });	
    $('.numeralformat10').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralPositiveOnly: true,
            numeralIntegerScale: 10
        })
    });	
    $('.stringformat10').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [10],
            delimiter: ''
        })
    });
    $('.stringformat20').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [20],
            delimiter: ''
        })
    });
    $('.stringformat30').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [30],
            delimiter: ''
        })
    });
    $('.stringformat40').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [40],
            delimiter: ''
        })
    });
    $('.stringformat50').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [50],
            delimiter: ''
        })
    });
    $('.stringformat60').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [60],
            delimiter: ''
        })
    });
    $('.stringformat200').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [200],
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
    $('.numeralformat3').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            // numeralThousandsGroupStyle: 'thousand',
            numeralPositiveOnly: true,
            numeralIntegerScale: 3
        })
    });
    $('.numeralformat4').toArray().forEach(function(field){
        new Cleave(field, {
            numericOnly: true,
            blocks: [4]
        })
    });
    $('.decimalformat').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            numeralDecimalScale: 15
        })
    });
});
