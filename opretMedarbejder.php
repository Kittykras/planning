<?php
include './include/top.inc.php';
include './include/menubar.inc.php';
?>
<link rel="stylesheet" href="input-styles.css">
<script src="error.js"></script>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col">
            <h4 class="chead">Opret Medarbejder</h4>
            <h2 class="chead">Opret Medarbejder</h2>
        </div>
    </div>
</div>
<div class="vertically-align" align="center">
    <form role="form" action="database/actions/createAssociate.php" method="post">
        <div class="form-group">
            <input name="newName" type="text" class="form-control input-style" id="newName" placeholder="Navn">
        </div>
        <div class="form-group">
            <input name="newUser" type="text" class="form-control input-style" id="newUser" placeholder="Brugernavn">
        </div>
        <div class="form-group">
            <input name="newPwd" type="text" class="form-control input-style" id="newPwd" placeholder="Kodeord">
        </div>
        <div class='form-group'>
            <select class="form-control input-style" name='newPriv'>
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
        <br>
        <button type="submit" class="btn btn-black">Opret Medarbejder</button>
    </form>
</div>

</body>
</html>
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Der er sket en fejl i oprettelsen af medarbejder. Tjek evt. om brugernavn allerede existerer.</span>
    </div>
    <?php
}
?>