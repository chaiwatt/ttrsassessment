function getTodayThai() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = (today.getFullYear()+543);
    today = dd + '/' + mm + '/' + yyyy;
    return today;
  }

  function getTodayEng() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = (today.getFullYear());
    today = yyyy + '/' + mm + '/' + dd;
    return today;
  }

  export {getTodayThai,getTodayEng}