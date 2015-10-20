<?php
include './include/top.inc.php';
include './include/menubar.inc.php';
?>
<link rel="stylesheet" href="input-styles.css">
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col">
            <h4 class="chead" id="editH4">Opret Medarbejder</h4>
            <h2 class="chead" id="editH2">Opret Medarbejder</h2>
        </div>
    </div>
</div>
<div class="vertically-align" align="center">
    <form role="form" action="database/actions/createAssociate.php" method="post">
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
        <!--        <div class="dropdown" style='width: 142px' id='newPriv'>
                    <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown" style='width: 142px'>
                        Rettigheder <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-black" role="menu">
                        <li id='1'><a href="#">Admin</a></li>
                        <li id='2'><a href="#">Projektleder</a></li>
                        <li id='3'><a href="#">Alm. Medarbejder</a></li>
                    </ul>
                </div>-->
        <button type="submit" class="btn btn-black" id="btnCreate">Opret Medarbejder</button>
        <button type="submit" class="btn btn-black hidden" formaction="database/actions/alterAssociate.php" id="btnAlter">Rediger Medarbejder</button>
    </form>
</div>

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
$name = $_SESSION["UserName"]->a_name;
echo $name;
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
            var name = <?php echo json_encode($name);?>;
            document.getElementById("editH4").innerHTML = "Rediger Medarbejder";
            document.getElementById("editH2").innerHTML = "Rediger Medarbejder";
            $("button#btnAlter").removeClass("hidden");
            $("button#btnCreate").addClass("hidden");
            document.getElementById("newName").innerHTML = name;
        }
    });
</script>
</body>
</html>