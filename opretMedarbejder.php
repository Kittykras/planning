<?php
include './include/top.inc.php';
include './include/menubar.inc.php';
?>
<link rel="stylesheet" href="login.css">
<script src="login.js"></script>
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
            <input name="newName" type="text" class="form-control" id="newName" placeholder="Navn">
        </div>
        <div class="form-group">
            <input name="newUser" type="text" class="form-control" id="newUser" placeholder="Brugernavn">
        </div>
        <div class="form-group">
            <input name="newPwd" type="text" class="form-control" id="newPwd" placeholder="Kodeord">
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown" style='width: 142px'>
                Rettigheder <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-black" role="menu">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Projektleder</a></li>
                <li><a href="#">Alm. Medarbejder</a></li>
            </ul>
        </div>
        <br>
        <button type="submit" class="btn btn-black">Opret Medarbejder</button>
    </form>
</div>

</body>
</html>