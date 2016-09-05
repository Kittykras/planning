<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
$links = getLinksFromCustomer();
?>
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead"><span class="header-img"><?php
                    getCustomerFromCookie();
                    print_r($_SESSION["Kunde"]->c_name);
                    ?></span></h4>
            <h2 class="chead"><span class="header-img"><?php
                    getCustomerFromCookie();
                    print_r($_SESSION["Kunde"]->c_name);
                    ?></span></h2>
        </div>
        <br>
        <!-- Button for the option to create project -->
        <div class="col span_1_of_2" id="new-task-dest" align="right">
            <?php
            if ($_COOKIE['showtask'] === '1') {
                ?>
            <button type="button" class="btn btn-black" onclick="SetCookie('previous', window.location.href, '1');
                    location.href = 'taskForm.php'">Ny Opgave</button>
            <?php } else {
                        ?>
            <button type="button" class="btn btn-black" onclick="SetCookie('previous', window.location.href, '1');
                    location.href = 'projectForm.php'">Nyt Projekt</button>
            <?php }
                    ?>
            
        </div>
        <!-- Buttons for the option to alter/delete this customer -->
        <div class="col span_1_of_2 hidden" align="right" id="edit">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Rediger <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a onclick="SetCookie('previous', window.location.href, '1');
                            location.href = 'customerForm.php?edit'">Rediger</a></li>
                    <li><a data-toggle="modal" data-target="#deleteModal">Slet</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Buttons for sorting the table values -->
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
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_assigned', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Medarbejder</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'tc_date', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Kommentar</button>
                        <?php } else {
                        ?>
                <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'color', '1');
                        SetCookie('state', '0', '1');
                        SetCookie('showtask', '1', '1');
                        changeBtnTitle()">Opgaver</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'm_associate', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Medarbejder</button>
                    <?php }
                    ?>
            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
        </div>
    </div>
</div>
<br>
<!-- Table containing tasks on this customer -->
<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed ">
            <thead class="thead-style">
                <?php
                if ($_COOKIE['showtask'] === '1') {
                    ?>
                    <tr>
                        <th>Opgave</th>
                        <th style="max-width: 125px;">Medarb.</th>
                        <th style="max-width: 125px;">Kommentar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ctasks = getTasksFromCustomer();
                    foreach ($ctasks as $ctask) {
                        ?>
                        <tr>
                            <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect('<?php echo $ctask->t_id ?>', window.location.href)"><span style="color: <?php echo $ctask->t_state ?>">●</span> <?php echo $ctask->t_title ?> <span style="color: grey" class="<?php echo $ctask->e_ikonplace ?>"></span></td>
                            <td><button class="btn btn-link btn-xs table-button" onclick="redirect('<?php echo $ctask->t_assigned ?>', window.location.href)"><?php echo $ctask->t_assigned ?></button></td>
                            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                            <td><?php echo $ctask->tc_datee ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th>Projekt</th>
                        <th style="max-width: 125px;">Medarb.</th>
                    </tr>
                    </thead>
                <tbody>
                    <?php
                    $ctasks = getTasksFromCustomer();
                    foreach ($ctasks as $ctask) {
                        ?>
                        <tr>
                            <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect('<?php echo $ctask->m_id ?>', window.location.href)"><span style="color: <?php echo $ctask->m_state ?>">●</span> <?php echo $ctask->m_title." "; if(!empty($ctask->havetask)){ ?><span class="glyphicon glyphicon-paperclip" style="color: grey"></span><?php }?> </td>
                            <td><button class="btn btn-link btn-xs table-button" onclick="redirect('<?php echo $ctask->m_associate ?>', window.location.href)"><?php echo $ctask->m_associate ?></button></td>
                        </tr>
                        <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<!-- Information on this customer -->
<div class="dcenter">
    <div id="cssmenu" align="center" style="color: white; text-transform: uppercase">
        <br>
        <li><?php echo $_SESSION["Kunde"]->c_conperson ?> // <?php echo $_SESSION["Kunde"]->c_connumber ?> // <?php echo $_SESSION["Kunde"]->c_conmail ?> // Tildelt: <?php echo getAssignedAssociateName($_SESSION["Kunde"]->c_assigned); ?></li>
        <?php
        if (!empty($links)) {
            foreach ($links as $link) {
                ?><li><?php echo $link->d_url ?> // <?php echo $link->d_username ?> // <?php echo $link->d_password ?></li><?php
                }
            }
            ?>
        <br>
    </div>
</div>
<!-- Popup for the deleting this customer -->
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
<!-- Popup to view username and password on the selected link -->
<div id="linkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body vertically-align">
                <input type="hidden" id="oldLink" name="oldLink">
                <input disabled="" class="form-control input-style" type="text" id="urlEdit" placeholder="Link">
                <input disabled="" class="form-control input-style" type="text" id="userEdit" placeholder="Brugernavn">
                <input disabled="" class="form-control input-style" type="text" id="pwdEdit" placeholder="Adgangskode">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Errormessages -->
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Kunde blev ikke slettet. Forbindelsen til databasen fejlede. Genindlæs og prøv igen.</span>
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
                document.getElementById("new-task-dest").innerHTML = respArray[2];
            }
        };
        xmlhttp.open("GET", "database/actions/changeBtnTitleCus.php", true);
        xmlhttp.send();
    }
//                    Function to open popup with the selected link
    function openLinkModal(value) {
        var link = value.split("¤");
        document.getElementById("oldLink").value = link[1];
        document.getElementById("urlEdit").value = link[1];
        document.getElementById("userEdit").value = link[2];
        document.getElementById("pwdEdit").value = link[3];
        $('#linkModal').modal('show');
    }
//                    Function to determine whether the logged in user has the needed privileges to view the whole page
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1) {
            $("div#edit").removeClass("hidden");
        }
    });
</script>

