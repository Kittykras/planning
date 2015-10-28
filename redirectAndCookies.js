function SetCookie(c_name, value, expiredays) {
    var exdate = new Date()
    exdate.setDate(exdate.getDate() + expiredays)
    document.cookie = c_name + "=" + escape(value) +
            ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
}
function SetActive(aktiv) {
    SetCookie('medarbejder', '', '1');
    SetCookie('kunder', '', '1');
    SetCookie('overblik', '', '1');
    SetCookie('timeoversigt', '', '1');
    SetCookie('login', '', '1');
    switch (aktiv) {
        case 'medarbejder':
            SetCookie('medarbejder', 'active', '1');
            break;
        case 'kunder':
            SetCookie('kunder', 'active', '1');
            break;
        case 'overblik':
            SetCookie('overblik', 'active', '1');
            break;
        case 'timeoversigt':
            SetCookie('timeoversigt', 'active', '1');
            break;
        case 'login':
            SetCookie('login', 'active', '1');
            break;
    }
}
function redirect(user) {
    document.cookie = "UserName=" + user;
    window.location = 'enkeltMedarbejder.php';
}
function cusRedirect(cust) {
    document.cookie = "Kunde=" + cust;
    window.location = 'enkeltKunde.php';
}
function taskRedirect(task) {
    document.cookie = "Task=" + task;
    window.location = "opretOpgave.php?editing=edit";
}


