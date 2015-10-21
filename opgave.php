<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
include './database/taskHandler.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead"><span class="header-img"><span style="color: <?php echo $_SESSION["Task"]->t_state ?>">●</span> <?php
                    getTaskFromCookie();
                    print_r($_SESSION["Task"]->t_title);
                    ?></span></h4>
            <h2 class="chead"><span class="header-img"><span style="color: <?php echo $_SESSION["Task"]->t_state ?>">●</span> <?php
                    getTaskFromCookie();
                    print_r( $_SESSION["Task"]->t_title);
                    ?></span></h2>
        </div>
        <br>
        <div class="col span_1_of_2 hidden" align="right" id="edit">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Rediger <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a href="opretOpgave.php?editing=edit">Rediger</a></li>
                    <li><a data-toggle="modal" data-target="#deleteModal">Slet</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Du er ved at slette en opgave. Er du sikker på du vil det?</p>
                </div>
                <form class="modal-footer" role="form" action="database/actions/deleteTask.php" method="post">
                    <button type="submit" class="btn btn-black">Ja</button>
                    <button type="button" class="btn btn-black" data-dismiss="modal">Nej</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container dcenter" align="center">
    <p><?php print_r($_SESSION["Task"]->t_description); ?><br>Tildelt: <?php print_r(getAssignedAssociateName($_SESSION["Task"]->t_assigned));?><br>Fra Uge: <?php print_r($_SESSION["Task"]->t_fromweek); ?> // Til Uge: <?php print_r($_SESSION["Task"]->t_toweek); ?> </p>
</div>
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Opgave blev ikke slettet. Forbindelsen til databasen fejlede. Genindlæs og prøv igen.</span>
    </div>
    <?php
}
?>
<script>
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1) {
            $("div#edit").removeClass("hidden");
        }
    });
</script>
</body>
</html>