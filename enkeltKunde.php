<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <!--<h2><script>document.write(Session.get("UserName"));</script></h2>-->
            <h2><span class="header-img"><?php
                    getCustomerFromCookie();
                    print_r($_SESSION["Kunde"]->c_name);
                    ?></span></h2>
        </div>
        <br>
        <div class="col span_1_of_2" align="right">
            <button type="button" class="btn btn-black" onclick="location.href='opretOpgave.php'">Ny Opgave</button>
        </div>
        <div class="col span_1_of_2 hidden" align="right" id="edit">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Rediger <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a href="opretKunde.php?editing=edit">Rediger</a></li>
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
                    <li><a onclick="SetCookie('orderby', 'red', '1'); SetCookie('state', '1', '1'); location.reload()">Rød</a></li>
                    <li><a onclick="SetCookie('orderby', '#FFCC00', '1'); SetCookie('state', '1', '1'); location.reload()">Gul</a></li>
                    <li><a onclick="SetCookie('orderby', 'black', '1'); SetCookie('state', '1', '1'); location.reload()">Almindelig</a></li>
                    <li><a onclick="SetCookie('orderby', 'green', '1'); SetCookie('state', '1', '1'); location.reload()">Grøn</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_fromweek', '1'); SetCookie('state', '0', '1'); location.reload()">Uge</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_assigned', '1'); SetCookie('state', '0', '1'); location.reload()">Medarbejder</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'tc_date', '1'); SetCookie('state', '0', '1'); location.reload()">Kommentar</button>
            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
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
                <th>Medarb.</th>
                <th>Kommentar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ctasks = getTasksFromCustomer();
            foreach ($ctasks as $ctask) {
                ?>
                <tr>
                    <td><?php echo $ctask->t_fromweek ?>/<?php echo $ctask->t_toweek ?></td>
                    <td><button class="btn btn-link btn-xs link-style" onclick="taskRedirect('<?php echo $ctask->t_id ?>')"><span style="color: <?php echo $ctask->t_state ?>">●</span> <?php echo $ctask->t_title ?></td>
                    <td><button class="btn btn-link btn-xs link-style" onclick="redirect('<?php echo $ctask->t_assigned ?>')"><?php echo $ctask->t_assigned ?></button></td>
                    <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                    <td><?php echo $ctask->tc_datetime ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<br>
<div class="dcenter">
    <div id="cssmenu" align="center" style="color: white; text-transform: uppercase">
        <br>
        <li>Kontaktperson: <?php echo $_SESSION["Kunde"]->c_conperson ?> // Telefon: <?php echo $_SESSION["Kunde"]->c_connumber ?> // Tildelt: <?php echo getAssignedAssociateName($_SESSION["Kunde"]->c_assigned);?></li>
        <br>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Du er ved at slette en kunde. Er du sikker på du vil det?</p>
            </div>
            <form class="modal-footer" role="form" action="database/actions/deleteCustomer.php" method="post">
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
        <span class="text-danger">Kunde blev ikke slettet. Forbindelsen til databasen fejlede. Genindlæs og prøv igen.</span>
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
<?php
include './include/bottom.inc.php';
?>

