function addClusterTransaction(assessmentgroupid,clusterid,subclusterid,subclusterweight,extrafactorid,extrafactorscore,subextrafactorid,subextrafactorscore,subextrafactorscoreinp,extrafactorscoreinp){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/assessment/clustertransaction/add`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            assessmentgroupid : assessmentgroupid,
            clusterid : clusterid,
            subclusterid : subclusterid,
            subclusterweight : subclusterweight,
            extrafactorid : extrafactorid,
            extrafactorscore : extrafactorscore,
            subextrafactorid : subextrafactorid,
            subextrafactorscore : subextrafactorscore,
            subextrafactorscoreinp : subextrafactorscoreinp,
            extrafactorscoreinp : extrafactorscoreinp
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

export {addClusterTransaction}