<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
include 'database/taskHandler.php';
?>
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2 ">
            <h4 class="chead"><span class="header-img">Online</span></h4>
            <h2 class="chead"><span class="header-img">Online</span></h2>
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
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'color', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Opgaver</button>
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
<br>
<!-- Table containing all press tasks -->
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
                $otasks = getTaskFromOnline();
                foreach ($otasks as $task) {
                    ?>
                    <tr>
                        <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect('<?php echo $task->t_id ?>', window.location.href)"><span style="color: <?php echo $task->t_state ?>">●</span> <?php echo $task->t_title ?> <span style="color: grey" class="<?php echo $task->e_ikonplace ?>"></span></td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="cusRedirect('<?php echo $task->t_customer ?>', window.location.href)"><?php echo $task->t_customer ?></button></td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="redirect('<?php echo $task->t_assigned ?>', window.location.href)"><?php echo $task->t_assigned ?></button></td>
                        <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<html>
