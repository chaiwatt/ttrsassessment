function checklink(position,hospital,branchname,createhospitallink,createbranchlink){
    if(parseInt(position) != 1){
        if ( hospital !== "") {
            if ( branchname !== "") {
                // console.log( branchname);
            }else{
                $('#branchname').text('ยังไม่ได้กำหนดสาขา!');
                // Swal.fire({
                // // icon: 'error',
                // title: 'แจ้งเตือน...',
                // text: 'ยังไม่ได้กำหนดสาขา!',
                // }).then((result) => {
                //     // alert(createbranchlink);
                //     $('#branchname').text('ยังไม่ได้กำหนดสาขา!');
                // })
            }
        }else{
            Swal.fire({
            // icon: 'error',
            title: 'ผิดพลาด...',
            text: 'ยังไม่ได้กำหนดสถานพยาบาล!',
            }).then((result) => {
                // alert(createhospitallink);
            })
        }
    }
}