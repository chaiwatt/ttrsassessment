
$(document).ready(function(){
    openWSConnection();
});

$(document).on('click', '#cardreader', function() {
    let data = {
        type: "cardreader"                       
    };
    sendMessage(data);
});


function disConnect() {
    webSocket.close();
}

function openWSConnection() {
    let webSocketURL = null;
    let protocol = "ws" ;
    let hostname = "localhost" ;
    let port     = "8088" ;
    let endpoint = ""; 
    webSocketURL = protocol + "://" + hostname + ":" + port + endpoint;
    console.log("openWSConnection::Connecting to: " + webSocketURL);
    
    try {
        webSocket = new WebSocket(webSocketURL);
        webSocket.onopen = function(openEvent) {
            console.log("WebSocket OPEN: " + JSON.stringify(openEvent, null, 4));
            // $('#cardreader').prop("disabled", false);
            $("#card_reader").addClass('text-success');
        };
        webSocket.onclose = function (closeEvent) {
            $("#card_reader").addClass('text-danger');
            console.log("WebSocket CLOSE: " + JSON.stringify( closeEvent.data + ' ' + closeEvent.code, null, 4));
            // $('#cardreader').prop("disabled", true);
        };
        webSocket.onerror = function (errorEvent) {
            $("#card_reader").addClass('text-danger');
            console.log("WebSocket ERROR: " + JSON.stringify(errorEvent.data, null, 4));
            // $('#cardreader').prop("disabled", true);
        };
        webSocket.onmessage = function (messageEvent) {
            let wsMsg = JSON.parse(messageEvent.data);
            // console.log(messageEvent.data);
            // //console.log("WebSocket MESSAGE: " + wsMsg.PictureBase64);
            if(wsMsg.Type == "register"){
                registerBibding(wsMsg);
            }
            // if(wsMsg.Type == "printque"){
            //     console.log("print que");
            // }
            // if(wsMsg.Type == "hid"){
            //     console.log(wsMsg.Hid);
            //     //$('#patientsearch').val(wsMsg.Hid);
            //     patientsearch(wsMsg.Hid.trim());
            // }
        };
    } catch (exception) {
        // console.error(exception);
    }
}

function sendMessage(data) {
    if (webSocket.readyState != WebSocket.OPEN) {
        console.error("webSocket is not open: " + webSocket.readyState);
        return;
    }
    webSocket.send(JSON.stringify(data));
}

function registerBibding(wsMsg){
    $('#imgbase64fromcard').width(150); // Units are assumed to be pixels
    $('#imgbase64fromcard').height(170);
    $('#imgbase64fromcard').addClass('border border-dark');
    $('#name').val(wsMsg.Name);
    $('#lastname').val(wsMsg.Lastname);
    $('#hid').val(wsMsg.Hid);
    $('#address').val(wsMsg.Address);
    $('#dob').val(wsMsg.Dob);
    $('#hidden_amphur').val(wsMsg.Amphur);
    $('#hidden_tambol').val(wsMsg.Tambol);
    $("#prefix option:contains("+wsMsg.Prefix+")").attr('selected', true).change();
    $("#province option:contains("+wsMsg.Province+")").attr('selected', true).change();
    $('#base64fromcard').val(wsMsg.PictureBase64);
    imgbase64fromcard.setAttribute('src', "data:image/jpg;base64," + wsMsg.PictureBase64);
}