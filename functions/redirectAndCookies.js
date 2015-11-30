//Function to set cookie with name, value and how many days it should last
function SetCookie(c_name, value, expiredays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate()+1);
    document.cookie = c_name + "=" + value + ";expires=" + exdate.toGMTString() + ";path=/planning/";
}
//Function to set active menuitem
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
//Functions to redirect the user to the chosen page with the right values
function redirect(user, href) {
    SetActive('medarbejder');
    SetCookie('UserName', user, '1');
    SetCookie('orderby', 't_fromWeek', '1');
    SetCookie('state', '0', '1');
    SetCookie('previous', href, '1');
    window.location = 'singleAssociate.php';
}
function cusRedirect(cust, href) {
//    window.alert('hej' + cust);
    SetActive('kunder');
    SetCookie('Kunde', htmlEntities(cust), '1');
    SetCookie('orderby', 't_fromWeek', '1');
    SetCookie('state', '0', '1');
    SetCookie('previous', href, '1');
    window.location = 'singleCustomer.php';
}
function taskRedirect(task, href) {
    SetActive('kunder');
    SetCookie('Task', task, '1');
    SetCookie('previous', href, '1');
    window.location = "taskForm.php?edit";
}

function htmlEntities(str) {
    var text = String(str).replace("Ø", "oe", true).replace("Æ", "ae").replace("Å", "aaa").replace("æ", "ae").replace("ø", "oe").replace("å", "aaa");
//    window.alert(text);
    return text;
    
}
