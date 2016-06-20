<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead"><span class="header-img"><?php
                    getUserFromCookie();
                    print_r($_SESSION["UserName"]->a_name);
                    ?></span></h4>
            <h2 class="chead"><span class="header-img"><?php
                    getUserFromCookie();
                    print_r($_SESSION["UserName"]->a_name);
                    ?></span></h2>
        </div>
        <br>
        <!-- Buttons for the option to alter/delete this associate -->
        <div class="col span_1_of_2 hidden" align="right" id="edit">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Rediger <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a onclick="SetCookie('previous', window.location.href, '1');
                            location.href = 'associateForm.php?edit'">Rediger</a></li>
                    <li><a data-toggle="modal" data-target="#deleteModal">Slet</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Buttons for sorting table values -->
    <div class="row" align="center">
        <div id="btn-group-dest" class="btn-group">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Status <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a onclick="SetCookie('orderby', 'red', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Rød</a></li>
                    <li><a onclick="SetCookie('orderby', 'blue', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Blå</a></li>
                    <li><a onclick="SetCookie('orderby', '#FFCC00', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Gul</a></li>
                    <li><a onclick="SetCookie('orderby', 'white', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Almindelig</a></li>
                    <li><a onclick="SetCookie('orderby', 'green', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Grøn</a></li>
                </ul>
            </div>
            <?php
            if ($_COOKIE['showtask'] === '1') {
                ?>
                <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'color', '1');
                        SetCookie('state', '0', '1');
                        SetCookie('showtask', '0', '1');
                        changeBtnTitle()">Projekter</button>
                        <?php } else {
                        ?>
                <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'color', '1');
                        SetCookie('state', '0', '1');
                        SetCookie('showtask', '1', '1');
                        changeBtnTitle()">Opgaver</button>
                    <?php }
                    ?>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_customer', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Kunde</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'tc_date', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Kommentar</button>
            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
        </div>
    </div>
</div>
<br>
<!-- Table containing tasks assigned to this associate -->
<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed">
            <thead class="thead-style">
                <?php
                if ($_COOKIE['showtask'] === '1') {
                    ?>
                    <tr>
                        <th>Opgave</th>
                        <th style="max-width: 125px;">Kunde</th>
                        <th style="max-width: 125px;">Kommentar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $atasks = getTasksFromAs();
                    foreach ($atasks as $atask) {
                        ?>
                        <tr>
                            <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect('<?php echo $atask->t_id ?>', window.location.href)"><span style="color: <?php echo $atask->t_state ?>">●</span> <?php echo $atask->t_title ?> <span style="color: grey" class="<?php echo $atask->e_ikonplace ?>"></span></td>
                            <td><button class="btn btn-link btn-xs table-button" onclick="cusRedirect('<?php echo $atask->t_customer ?>', window.location.href)"><?php echo $atask->t_customer ?></button></td>
                            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                            <td><?php echo $atask->tc_datee ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th>Projekt</th>
                        <th style="max-width: 125px;">Kunde</th>
                        <!--<th style="max-width: 125px;">Kommentar</th>-->
                    </tr>
                    </thead>
                <tbody>
                    <?php
                    $atasks = getTasksFromAs();
                    foreach ($atasks as $atask) {
                        ?>
                        <tr>
                            <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect('<?php echo $atask->m_id ?>', window.location.href)"><span style="color: <?php echo $atask->m_state ?>">●</span> <?php echo $atask->m_title." "; if(strcmp(hasTasks($atask->m_id), "0") !== 0){ ?><span class="glyphicon glyphicon-paperclip" style="color: grey"></span><?php }?></td>
                            <td><button class="btn btn-link btn-xs table-button" onclick="cusRedirect('<?php echo $atask->m_customer ?>', window.location.href)"><?php echo $atask->m_customer ?></button></td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Popup for deleting associate -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
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
<!-- Errormessages -->
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Medarbejder blev ikke slettet. Forbindelsen til databasen fejlede. Genindlæs og prøv igen.</span>
    </div>
    <?php
}
?>
<!-- Javascript functions -->
<script>
    function changeBtnTitle() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                var respArray = resp.split("¤");
                document.getElementById("no-more-tables").innerHTML = respArray[0];
                document.getElementById("btn-group-dest").innerHTML = respArray[1];
            }
        };
        xmlhttp.open("GET", "database/actions/changeBtnTitleAs.php", true);
        xmlhttp.send();
    }
//    Function to determine whether the logged in user has the needed privileges to view the whole page
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1) {
            $("div#edit").removeClass("hidden");
        }
    });

</script>
