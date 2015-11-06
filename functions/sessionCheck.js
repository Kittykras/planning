$(document).ready(function () {
    function checkCookie() {
        var user = getCookie("UserName");
        if (user === "") {
            window.location = "index.php";
        }
    }
    checkCookie();
});