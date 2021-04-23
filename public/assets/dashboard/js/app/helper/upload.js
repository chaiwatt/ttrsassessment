
function upload(file){
    var formData = new FormData();
    formData.append('file',file);
    // return ;
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/upload/upload`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: formdata,
        //   contentType: false,
        //   processData: false,
          success: function(data) {
            resolve(data)
          },
          error: function(error) {
            reject(error)
          },
        })
      })
}

export {upload}