<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<link rel="stylesheet" href="styles/input-styles.css">
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Medarbejder</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Medarbejder</span></h2>
        </div>
        <br>
        <div class="col span_1_of_2" align="right">
            <button type="submit" form="form" class="btn btn-black" id="btnCreate">Opret Medarbejder</button>
            <button type="submit" form="form" class="btn btn-black hidden" formaction="database/actions/alterAssociate.php" id="btnAlter">Rediger Medarbejder</button>
        </div>
    </div>
</div>
<div class="vertically-align" align="center">
    <form id="form" role="form" action="database/actions/createAssociate.php" method="post">
        <div class="form-group">
            <input name="newName" type="text" class="form-control input-style" id="newName" placeholder="Navn">
        </div>
        <div class="form-group">
            <input name="newUser" type="text" class="form-control input-style" id="newUser" placeholder="Brugernavn(max 4 bogstaver)">
        </div>
        <div class="form-group">
            <input name="newPwd" type="text" class="form-control input-style" id="newPwd" placeholder="Kodeord">
        </div>
        <div class='form-group'>
            <select class="form-control input-style" name='newPriv' id="newPriv">
                <option value="3">Alm. Medarbejder</option>
                <option value="2">Projektleder</option>
                <option value="1">Admin</option>
            </select>
        </div>
    </form>
</div>
<input type="hidden" id="aName" name="aName" value="<?php echo $_SESSION["UserName"]->a_name ?>"/>
<input type="hidden" id="aUser" name="aUser" value="<?php echo $_SESSION["UserName"]->a_username ?>"/>
<input type="hidden" id="aPwd" name="aPwd" value="<?php echo $_SESSION["UserName"]->a_password ?>"/>
<input type="hidden" id="aPriv" name="aPriv" value="<?php echo $_SESSION["UserName"]->a_privileges ?>"/>
<?php
//echo $_GET["editing"];
if (isset($_GET["error"])) {
    if ($_GET["editing"] === "edit") {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i redigeringen af medarbejder. Tjek at alle felter er udfyldt, eller, hvis du er ved at ændre brugernavn, om det nye brugernavn evt. allerede existerer.</span>
        </div>
        <?php
    } else {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i oprettelsen af medarbejder. Tjek at alle felter er udfyldt, eller om brugernavn evt. allerede existerer.</span>
        </div>
        <?php
    }
}
?>
<script language="javascript" type="text/javascript">
    var $_GET = {};

    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }

        $_GET[decode(arguments[1])] = decode(arguments[2]);
    });
    $(document).ready(function () {
        if ($_GET["editing"] === "edit") {
            var name = $('#aName').val();
            var user = $('#aUser').val();
            var pwd = $('#aPwd').val();
            var priv = $('#aPriv').val();
            document.getElementById("editH4").innerHTML = "Rediger Medarbejder";
            document.getElementById("editH2").innerHTML = "Rediger Medarbejder";
            $("button#btnAlter").removeClass("hidden");
            $("button#btnCreate").addClass("hidden");
            document.getElementById("newName").value = name;
            document.getElementById("newUser").value = user;
            document.getElementById("newPwd").value = pwd;
            document.getElementById("newPriv").value = priv;
        }
    });
</script>
</body>
</html>