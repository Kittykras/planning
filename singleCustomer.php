<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
$links = getLinksFromCustomer();
?>
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
        <div class="col span_1_of_2" align="right">
            <button type="button" class="btn btn-black" onclick="location.href = 'taskForm.php'">Ny Opgave</button>
        </div>
        <div class="col span_1_of_2 hidden" align="right" id="edit">
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                    Rediger <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a href="customerForm.php?editing=edit">Rediger</a></li>
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
                    <li><a onclick="SetCookie('orderby', 'red', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Rød</a></li>
                    <li><a onclick="SetCookie('orderby', '#FFCC00', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Gul</a></li>
                    <li><a onclick="SetCookie('orderby', 'black', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Almindelig</a></li>
                    <li><a onclick="SetCookie('orderby', 'green', '1');
                            SetCookie('state', '1', '1');
                            location.reload()">Grøn</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_fromweek', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Uge</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_assigned', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Medarbejder</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'tc_date', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Kommentar</button>
            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
        </div>
    </div>
</div>
<br>
<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed ">
            <thead class="thead-style">
                <tr>
                    <th style="max-width: 125px;">Uge</th>
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
                        <td><?php echo $ctask->t_fromweek ?>/<?php echo $ctask->t_toweek ?></td>
                        <td><button class="btn btn-link btn-xs table-button link-style" onclick="taskRedirect('<?php echo $ctask->t_id ?>')"><span style="color: <?php echo $ctask->t_state ?>">●</span> <?php echo $ctask->t_title ?></td>
                        <td><button class="btn btn-link btn-xs table-button link-style" onclick="redirect('<?php echo $ctask->t_assigned ?>')"><?php echo $ctask->t_assigned ?></button></td>
                        <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                        <td><?php echo $ctask->tc_datee ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="dcenter">
    <div id="cssmenu" align="center" style="color: white; text-transform: uppercase">
        <br>
        <li>Kontaktperson: <?php echo $_SESSION["Kunde"]->c_conperson ?> // Telefon: <?php echo $_SESSION["Kunde"]->c_connumber ?> // Tildelt: <?php echo getAssignedAssociateName($_SESSION["Kunde"]->c_assigned); ?></li>
        <?php if (!empty($links)) {
            if (count($links) === 1) {
                ?><li class="form-inline">Presse Links: <select class="form-control input-sm input-style" onclick="openLinkModal(this.value)"><?php } else {
                ?><li class="form-inline">Presse Links: <select class="form-control input-sm input-style" onchange="openLinkModal(this.value)"><?php } foreach ($links as $link) { ?> <option value=" <?php echo $link->d_id . '¤' . $link->d_url . '¤' . $link->d_username . '¤' . $link->d_password ?>"><?php echo $link->d_url ?></option>
    <?php } ?></select></li><?php } ?>
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
                <div id="linkModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body vertically-align">
                                <input type="hidden" id="oldLink" name="oldLink">
                                <input disabled="" class="form-control input-style" type="text" id="urlEdit" placeholder="Link">
                                <input class="form-control input-style" type="text" id="userEdit" placeholder="Brugernavn">
                                <input class="form-control input-style" type="text" id="pwdEdit" placeholder="Adgangskode">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-black" data-dismiss="modal">OK</button>
                            </div>
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
                    function openLinkModal(value) {
                        var link = value.split("¤");
                        document.getElementById("oldLink").value = link[1];
                        document.getElementById("urlEdit").value = link[1];
                        document.getElementById("userEdit").value = link[2];
                        document.getElementById("pwdEdit").value = link[3];
                        $('#linkModal').modal('show');
                    }
                    $(document).ready(function () {
                        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1) {
                            $("div#edit").removeClass("hidden");
                        }
                    });
                </script>

