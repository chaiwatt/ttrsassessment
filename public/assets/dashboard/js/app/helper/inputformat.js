

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
    $('.numeralformat9').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralPositiveOnly: true,
            numeralIntegerScale: 9
        })
    });
    
    $('.numeralformat8digit').toArray().forEach(function(field){
        // new Cleave(field, {
        //     numeral: true,
        //     numeralThousandsGroupStyle: 'thousand',
        //     numeralPositiveOnly: true,
        //     numeralIntegerScale: 10
        // })
        new Cleave(field, {
            numericOnly: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralPositiveOnly: true,
            numeralIntegerScale: 8,
            blocks: [8]
        })
    });	
    $('.stringformat10').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [10],
            delimiter: ''
        })
    });
    $('.stringformat15').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [15],
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
    $('.stringformat45').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [45],
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
    $('.stringformat80').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [80],
            delimiter: ''
        })
    });
    $('.stringformat90').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [90],
            delimiter: ''
        })
    });
    $('.stringformat100').toArray().forEach(function(field){
        new Cleave(field, {
            blocks: [100],
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
            blocks: [10]
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
