<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
//include 'database/taskHandler.php';
?>
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Projekt(<a href="singleCustomer.php"><?php print_r(htmlEntities2($_COOKIE["Kunde"])) ?></a>)</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Projekt(<a href="singleCustomer.php"><?php print_r(htmlEntities2($_COOKIE["Kunde"])) ?></a>)</span></h2>
        </div>
        <br>
        <!-- Button for the option to create task -->
        <div class="col span_1_of_2" align="right">
            <button type="button" class="btn btn-black" onclick="SetCookie('previous', window.location.href, '1');
                    location.href = 'taskForm.php'">Ny opgave</button>
        </div>
    </div>
    <!-- Buttons for sorting the table values -->
    <div class="row" align="center">
        <div class="btn-group">
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
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_customer', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Kunde</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_assigned', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Medarbejder</button>
            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
        </div>
    </div>
</div>
</div>

<br>
<div class="vertically-align" align="center">
    <form id="form" role="form" action="database/actions/createProject.php" method="post">
        <div class="form-group">
            <input name="title" type="text" class="form-control input-style" style="font-weight: bold" id="title" placeholder="Titel">
        </div>
        <div class="form-group">
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
    </form>
    <!-- Button for submitting form -->
    <button type="submit" form="form" class="btn btn-black span_1_of_3" id="btnCreate">Gem</button>
    <!--<button type="submit" form="form" class="btn btn-black span_1_of_3 hidden" id="btnAlter" formaction="database/actions/alterTaskNoPriv.php">Gem</button>-->
    <div class="group hidden" id="btnAlter">
        <div class="col span_1_of_2">
            <button type="submit" form="form" class="btn btn-black span_2_of_3" formaction="database/actions/alterProject.php">Gem</button>
        </div>
        <div class="col span_1_of_2">
            <button class="btn btn-black span_2_of_3" data-toggle="modal" data-target="#deleteModal">Slet</button>
        </div>
    </div>
</div>
<!-- Table containing all tasks in this project -->
<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed">
            <thead class="thead-style">
                <tr>
                    <th>Opgave</th>
                    <th style="max-width: 125px;">Kunde</th>
                    <th style="max-width: 125px;">Medarb.</th>
                </tr>
            </thead>
            <tbody>
                <?php
//                    foreach ($tasks as $task) {
                ?>
                <tr>
<!--                    <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect('<?php echo $task->t_id ?>', window.location.href)"><span style="color: <?php echo $task->t_state ?>">●</span> <?php echo $task->t_title ?> <span style="color: grey" class="<?php echo $task->e_ikonplace ?>"></span></td>
                    <td><button class="btn btn-link btn-xs table-button" onclick="cusRedirect('<?php echo $task->t_customer ?>', window.location.href)"><?php echo $task->t_customer ?></button></td>
                    <td><button class="btn btn-link btn-xs table-button" onclick="redirect('<?php echo $task->t_assigned ?>', window.location.href)"><?php echo $task->t_assigned ?></button></td>-->
                    <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                </tr>
                <?php
//                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Popup for deleting this project -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Du er ved at slette dette projekt. Er du sikker på du vil det?</p>
            </div>
            <form class="modal-footer" role="form" action="database/actions/deleteProject.php" method="post">
                <button type="submit" class="btn btn-black">Ja</button>
                <button type="button" class="btn btn-black" data-dismiss="modal">Nej</button>
            </form>
        </div>
    </div>
</div>
<!-- Hidden values to fill out form -->
<input type="hidden" id="cus" name="cus" value="<?php echo $_SESSION["Project"]->m_customer ?>"/>
<input type="hidden" id="htitle" name="htitle" value="<?php echo $_SESSION["Project"]->m_title ?>"/>
<input type="hidden" id="htitle" name="hassi" value="<?php echo $_SESSION["Project"]->m_associate ?>"/>
<!-- Javascript functions -->
<script language="javascript" type="text/javascript">
    //    Function for filling out form when altering project
    $(window).load(function () {
        var editing = window.location.search;
        if (editing === "?edit") {
//            if (<?php // print_r($_SESSION["user"]->a_privileges)  ?> === 3) {
//                $('#title').attr('disabled', true);
//                $('#assi').attr('disabled', true);
//                $('button#btnAlter').removeClass("hidden");
//            } else {
//                $("div#btnAlter").removeClass("hidden");
//            }
            var cus = $('#cus').val();
            var title = $('#htitle').val();
            var assi = $('#hassi').val();
            SetCookie('Kunde', cus, '1');
            document.getElementById("editH4").innerHTML = "<span class='header-img'>Rediger Opgave(<a href='singleCustomer.php'>" + cus + "</a>)</span>";
            document.getElementById("editH2").innerHTML = "<span class='header-img'>Rediger Opgave(<a href='singleCustomer.php'>" + cus + "</a>)</span>";
            $("#btnCreate").addClass("hidden");
            document.getElementById("title").value = title;
            document.getElementById("assi").value = assi;
        }
    });
</script>