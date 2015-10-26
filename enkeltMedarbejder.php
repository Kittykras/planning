<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <!--<h2><script>document.write(Session.get("UserName"));</script></h2>-->
            <h2><span class="header-img"><?php getUserFromCookie(); print_r($_SESSION["UserName"]->a_name); ?></span></h2>
        </div>
        <br>
        <div class="col span_1_of_2 hidden" align="right" id="edit">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Rediger <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a href="opretMedarbejder.php?editing=edit">Rediger</a></li>
                    <li><a data-toggle="modal" data-target="#deleteModal">Slet</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row" align="center">
        <div class="btn-group">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Status <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a href="#">Rød</a></li>
                    <li><a href="#">Gul</a></li>
                    <li><a href="#">Almindelig</a></li>
                    <li><a href="#">Grøn</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-black">Uge</button>
            <button type="button" class="btn btn-black">Kunde</button>
        </div>
    </div>
</div>
<br>
<div class="panel panel-default dcenter">
    <table class="table table-condensed table-responsive">
        <thead class="thead-style">
            <tr>
                <th>Uge</th>
                <th>Opgave</th>
                <th>Kunde</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $atasks = getTasksFromAs();
            foreach ($atasks as $atask) {
                ?>
                <tr>
                    <td><?php echo $atask->t_fromweek ?>/<?php echo $atask->t_toweek ?></td>
                    <td><button class="btn btn-link btn-xs link-style" onclick="taskRedirect('<?php echo $atask->t_id ?>')"><span style="color: <?php echo $atask->t_state ?>">●</span> <?php echo $atask->t_title ?></td>
                    <td><button class="btn btn-link btn-xs link-style" onclick="cusRedirect('<?php echo $atask->t_customer ?>')"><?php echo $atask->t_customer ?></button></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Du er ved at slette en medarbejder. Er du sikker på du vil det?</p>
            </div>
            <form class="modal-footer" role="form" action="database/actions/deleteAssociate.php" method="post">
                <button type="submit" class="btn btn-black">Ja</button>
                <button type="button" class="btn btn-black" data-dismiss="modal">Nej</button>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Medarbejder blev ikke slettet. Forbindelsen til databasen fejlede. Genindlæs og prøv igen.</span>
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

