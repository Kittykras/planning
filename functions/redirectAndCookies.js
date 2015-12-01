//Function to set cookie with name, value and how many days it should last
function SetCookie(c_name, value) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate()+1);
    document.cookie = c_name + "=" + htmlEntities(value) + ";expires=" + exdate.toGMTString() + ";path=/planning/";
}
//Function to set active menuitem
function SetActive(aktiv) {
    SetCookie('medarbejder', '');
    SetCookie('kunder', '');
    SetCookie('overblik', '');
    SetCookie('timeoversigt', '');
    SetCookie('presse', '');
    SetCookie('online', '');
    SetCookie('login', '');
    switch (aktiv) {
        case 'medarbejder':
            SetCookie('medarbejder', 'active');
            break;
        case 'kunder':
            SetCookie('kunder', 'active');
            break;
        case 'overblik':
            SetCookie('overblik', 'active');
            break;
        case 'timeoversigt':
            SetCookie('timeoversigt', 'active');
            break;
        case 'presse':
            SetCookie('presse', 'active');
            break;
        case 'online':
            SetCookie('online', 'active');
            break;
        case 'login':
            SetCookie('login', 'active');
            break;
    }
}
//Functions to redirect the user to the chosen page with the right values
function redirect(user, href) {
    SetActive('medarbejder');
    SetCookie('UserName', user);
    SetCookie('orderby', 't_fromWeek');
    SetCookie('state', '0');
    SetCookie('previous', href);
    window.location = 'singleAssociate.php';
}
function cusRedirect(cust, href) {
//    window.alert('hej' + cust);
    SetActive('kunder');
    SetCookie('Kunde', cust);
    SetCookie('orderby', 't_fromWeek');
    SetCookie('state', '0');
    SetCookie('previous', href);
    window.location = 'singleCustomer.php';
}
function taskRedirect(task, href) {
    SetActive('kunder');
    SetCookie('Task', task);
    SetCookie('previous', href);
    window.location = "taskForm.php?edit";
}

function htmlEntities(str) {
    var text = str.replace(/[\ø]+/gi, 'oe').replace(/[\æ]+/gi, 'ae').replace(/[\å]+/gi, 'aa');
    return text;
}
