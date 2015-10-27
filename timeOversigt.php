<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
include './database/taskHandler.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2 ">
            <h2><span class="header-img">Time Oversigt</span></h2>
        </div>
        <!--                <div class="col span_1_of_2" align="right">
                            <br>
                            <button type="button" class="btn btn-black">Ny Kunde</button>
                        </div>-->
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
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_assigned', '1'); SetCookie('state', '0', '1'); location.reload()">Medarbejder</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 't_customer', '1'); SetCookie('state', '0', '1'); location.reload()">Kunde</button>
        </div>
    </div>
</div>
<br>
<div class="panel panel-default dcenter">
    <table class="table table-condensed table-responsive">
        <thead class="thead-style">
            <tr>
                <th>Kunde</th>
                <th>Opgave</th>
                <th>Medarb.</th>
                <th>Timer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tasks as $task) {
                ?>
                <tr>
                    <td><button class="btn btn-link btn-xs link-style" onclick="cusRedirect('<?php echo $task->t_customer ?>')"><?php echo $task->t_customer ?></button></td>
                    <td><button class="btn btn-link btn-xs link-style" onclick="taskRedirect('<?php echo $task->t_id ?>')"><span style="color: <?php echo $task->t_state ?>">●</span> <?php echo $task->t_title ?></td>
                    <td><button class="btn btn-link btn-xs link-style" onclick="redirect('<?php echo $task->t_assigned ?>')"><?php echo $task->t_assigned ?></button></td>
                    <td><?php echo $task->t_timespent ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function redirect(user) {
        document.cookie = "UserName=" + user;
        window.location = 'enkeltMedarbejder.php';
    }
    function cusRedirect(cust) {
        document.cookie = "Kunde=" + cust;
        window.location = 'enkeltKunde.php';
    }
    function taskRedirect(task){
        document.cookie = "Task=" + task;
        window.location = "opretOpgave.php?editing=edit";
    }
</script>
</body>
<html>