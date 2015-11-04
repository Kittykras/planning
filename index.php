<?php
include 'include/top.inc.php';
?>
<link rel="stylesheet" href="styles/login.css">
<script src="functions/login.js"></script>
<div class="vertically-align" align="center">
    <form role="form" action="database/actions/checkLogin.php" method="post">
        <div class="form-group">
            <input name="user" type="text" class="form-control" id="user" placeholder="Brugernavn">
        </div>
        <div class="form-group">
            <input name="pwd" type="password" class="form-control" id="pwd" placeholder="Kodeord">
        </div>
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="remember_me"> Husk mig
        </label>
        <button type="submit" class="btn btn-black">Log Ind</button>
    </form>
</div>

</body>
</html>
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Forkert brugernavn og/eller kodeord</span>
    </div>
    <?php
}
?>