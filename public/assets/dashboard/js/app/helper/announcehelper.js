$(document).on('change', '#announcecategory', function(e) {
    var html ='';
    showAnnounce($(this).val()).then(data => {
        console.log(data);
        data.forEach(function (announce,index) {
            html += `<p class="announce-p"><i class="icofont-ui-folder"></i> ${announce.day} ${announce.month} ${announce.year} (${announce.announcecategory['name']}) <a class="ml-3" href="${route.url}/announcenews/${announce.slug}" > ${announce.title}</a></p>
            <hr class="announce-hr">`
            });
        $("#announce_wrapper").html(html);
    }).catch(error => {})
});

function showAnnounce(categoryid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/showannounce`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            categoryid : categoryid
        },
        success: function(data) {
            resolve(data)
        },
        error: function(error) {
            reject(error)
        },
        })
    })
  }

  $(document).on('keyup', '#search', function(e) {
    var html ='';
    searchAnnounce($(this).val()).then(data => {
        console.log(data);
        data.forEach(function (announce,index) {
            html += `<p class="announce-p"><i class="icofont-ui-folder"></i> ${announce.day} ${announce.month} ${announce.year} (${announce.announcecategory['name']}) <a class="ml-3" href="${route.url}/announcenews/${announce.slug}" > ${announce.title}</a></p>
            <hr class="announce-hr">`
            });
        $("#announce_wrapper").html(html);
    }).catch(error => {})
});

  function searchAnnounce(search){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/searchannounce`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            search : search
        },
        success: function(data) {
            resolve(data)
        },
        error: function(error) {
            reject(error)
        },
        })
    })
  }
