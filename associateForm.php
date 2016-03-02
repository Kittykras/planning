<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<link rel="stylesheet" href="styles/input-styles.css">
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Medarbejder</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Medarbejder</span></h2>
        </div>
        <br>
    </div>
</div>
<!-- Form for creating/altering selected associate -->
<div class="vertically-align" align="center">
    <form id="form" role="form" action="database/actions/createAssociate.php" method="post">
        <div class="form-group">
            <input name="newName" type="text" class="form-control input-style" id="newName" placeholder="Navn">
        </div>
        <div id="usererror">
            <div class="form-group">
                <input name="newUser" type="text" class="form-control input-style" id="newUser" placeholder="Brugernavn(max 4 bogstaver)" onblur="checkUser()">
            </div>
        </div>
        <div class="form-group">
            <input name="newPwd" type="text" class="form-control input-style" id="newPwd" placeholder="Kodeord">
        </div>
        <div class="form-group">
            <input name="newMail" type="text" class="form-control input-style" id="newMail" placeholder="Email">
        </div>
        <div class='form-group'>
            <select class="form-control input-style" name='newPriv' id="newPriv">
                <option value="3">Medarbejder</option>
                <option value="2">Projektleder</option>
                <option value="1">Admin</option>
            </select>
        </div>
    </form>
    <!-- Button for submitting form -->
    <button type="submit" form="form" class="btn btn-black span_1_of_3" id="btnCreate">Gem</button>
    <button type="submit" form="form" class="btn btn-black span_1_of_3 hidden" formaction="database/actions/alterAssociate.php" id="btnAlter">Gem</button>
</div>
<!-- Hidden values to fill out form -->
<input type="hidden" id="aName" name="aName" value="<?php echo $_SESSION["UserName"]->a_name ?>"/>
<input type="hidden" id="aUser" name="aUser" value="<?php echo $_SESSION["UserName"]->a_username ?>"/>
<input type="hidden" id="aPwd" name="aPwd" value="<?php echo $_SESSION["UserName"]->a_password ?>"/>
<input type="hidden" id="aPriv" name="aPriv" value="<?php echo $_SESSION["UserName"]->a_privileges ?>"/>
<input type="hidden" id="aMail" name="aMail" value="<?php echo $_SESSION["UserName"]->a_email ?>"/>
<!-- Errormessages -->
<?php
if (isset($_GET["error"])) {
    if (isset($_GET["edit"])) {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i redigeringen af medarbejder. Tjek at alle felter er udfyldt, eller, hvis du er ved at ændre brugernavn, om det nye brugernavn er på max 4 bogstaver, eller evt. allerede existerer.</span>
        </div>
        <?php
    } else {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i oprettelsen af medarbejder. Tjek at alle felter er udfyldt, og om brugernavn er på max 4 bogstaver, eller evt. allerede existerer.</span>
        </div>
        <?php
    }
}
?>
<!-- Javascript functions -->
<script language="javascript" type="text/javascript">
	//	Function to check if username already exists or is too long
    function checkUser() {
        var user = document.getElementById("newUser").value;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("usererror").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/checkAsUser.php?q=" + user, true);
        xmlhttp.send();
    }
    //    Function to prevent enter key from submitting
    $('#form').on('keyup keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code === 13) {
            e.preventDefault();
            return false;
        }
    });
//    Function for filling out form when altering associate
    $(window).load(function () {
        var editing = window.location.search;
        if (editing === "?edit") {
            var name = $('#aName').val();
            var user = $('#aUser').val();
            var pwd = $('#aPwd').val();
            var priv = $('#aPriv').val();
            var mail = $('#aMail').val();
            document.getElementById("editH4").innerHTML = "<span class='header-img'>Rediger Medarbejder</span>";
            document.getElementById("editH2").innerHTML = "<span class='header-img'>Rediger Medarbejder</span>";
            $("button#btnAlter").removeClass("hidden");
            $("button#btnCreate").addClass("hidden");
            document.getElementById("newName").value = name;
            document.getElementById("newUser").value = user;
            document.getElementById("newPwd").value = pwd;
            document.getElementById("newPriv").value = priv;
            document.getElementById("newMail").value = mail;
        }
    });
</script>
</body>
</html>