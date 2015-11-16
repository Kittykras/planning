function SetCookie(c_name, value, expiredays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" + value +
            ((expiredays === null) ? "" : ";expires=" + exdate.toGMTString()+";path=/planning/");
}
function SetActive(aktiv) {
    SetCookie('medarbejder', '', '1');
    SetCookie('kunder', '', '1');
    SetCookie('overblik', '', '1');
    SetCookie('timeoversigt', '', '1');
    SetCookie('presse', '', '1');
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
        case 'presse':
            SetCookie('presse', 'active', '1');
            break;
        case 'login':
            SetCookie('login', 'active', '1');
            break;
    }
}
function redirect(user) {
    SetActive('medarbejder');
    SetCookie('UserName', user, '1');
    window.location = 'singleAssociate.php';
}
function cusRedirect(cust) {
    SetActive('kunder');
    SetCookie('Kunde', cust, '1');
    window.location = 'singleCustomer.php';
}
function taskRedirect(task) {
    SetActive('kunder');
    SetCookie('Task', task, '1');
    window.location = "taskForm.php?editing=edit";
}


