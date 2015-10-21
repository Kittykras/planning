<?php
include './include/top.inc.php';
include './include/menubar.inc.php';
?>
<link rel="stylesheet" href="input-styles.css">
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Opgave</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Opgave</span></h2>
        </div>
    </div>
</div>
<div class="vertically-align" align="center">
    <div class="form-group">
        <input name="title" type="text" class="form-control input-style" id="title" placeholder="Titel">
    </div>
    <div class="form-group">
        <input name="descr" type="text" class="form-control input-style" id="descr" placeholder="Beskrivelse">
    </div>
    <div class='form-group'>
        <select class="form-control input-style" name='stat' id="stat">
            <option value="black">Alm.</option>
            <option value="#FFCC00">Gul</option>
            <option value="red">Rød</option>
            <option value="green">Grøn</option>
        </select>
    </div>
    <div class='form-group'>
        <select class="form-control input-style" name='assi' id="assi">
            <?php
            foreach ($users as $user) {
                ?>    
                <option value="<?php echo $user->a_username; ?>"><?php echo $user->a_name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <div class="col span_1_of_2"><input name="hour" type="number" step="1" class="form-control input-style" id="hour" placeholder="Timer"></div>
        <div class="col span_1_of_2"><input name="hour" type="number" step="15" max="60" class="form-control input-style" id="hour" placeholder="Minutter"></div>
    </div>
    <!--<br>-->
    <div class='form-group'>
        <select class="form-control input-style" name='assi' id="assi">
            <?php
            for ($index = 1; $index < 53; $index++) {
                ?>    
                <option value="<?php echo $index; ?>"><?php echo $index; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <select class="form-control input-style" name='assi' id="assi">
            <?php
            for ($index = 1; $index < 53; $index++) {
                ?>    
                <option value="<?php echo $index; ?>"><?php echo $index; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <textarea class="form-control input-style" rows="5" id="comment" placeholder="Kommentarer"></textarea>
    </div>
    <button type="submit" class="btn btn-black" id="btnCreate">Opret Kunde</button>
    <button type="submit" class="btn btn-black hidden" formaction="database/actions/alterCustomer.php" id="btnAlter">Rediger Kunde</button>
</form>
</div>
<input type="hidden" id="cName" name="cName" value="<?php echo $_SESSION["Kunde"]->c_name ?>"/>
<input type="hidden" id="cAcro" name="cAcro" value="<?php echo $_SESSION["Kunde"]->c_acronym ?>"/>
<input type="hidden" id="cCont" name="cCont" value="<?php echo $_SESSION["Kunde"]->c_conperson ?>"/>
<input type="hidden" id="cTlf" name="cTlf" value="<?php echo $_SESSION["Kunde"]->c_connumber ?>"/>
<input type="hidden" id="cBran" name="cBran" value="<?php echo $_SESSION["Kunde"]->c_branch ?>"/>
<input type="hidden" id="cAssi" name="cAssi" value="<?php echo $_SESSION["Kunde"]->c_assigned ?>"/>
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