function countCharTh(string){
    var c =0;
    var output = Object.assign([], string);
    for(var i=0;i<output.length;i++){
        var code = output[i].charCodeAt();
        if(!(code == 3633 || code >= 3636 && code <=3642 || code >= 3655 && code <= 3661 )){
            c++;
            // console.log(output[i] +': ' + output[i].charCodeAt()); 
            // https://www.alansofficespace.com/unicode/unicd3675.htm
        }
    }
    return c;
}

export {countCharTh}