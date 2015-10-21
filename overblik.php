<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
include './database/taskHandler.php';
?>

        <!--        <div class="section group">
                    <div class="col span_1_of_2"><h2>Overblik</h2></div>
                    <div class="col span_2_of_2"><br><button type="button" class="btn btn-black"align="right">Default</button></div>
                </div>-->
        <div class="container dcenter hpic img-responsive">
            <div class="section group">
                <div class="col span_1_of_2 ">
                    <h2><span class="header-img">Overblik</span></h2>
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
                            <li><a href="#">Rød</a></li>
                            <li><a href="#">Gul</a></li>
                            <li><a href="#">Almindelig</a></li>
                            <li><a href="#">Grøn</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-black">Uge</button>
                    <button type="button" class="btn btn-black">Kunde</button>
                    <button type="button" class="btn btn-black">Medarbejder</button>
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
                        <th>Medarbejder</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tasks as $task) {
//                        echo $task->t_state;
                    ?>
                    <tr>
                        <td><?php echo $task->t_fromweek ?>/<?php echo $task->t_toweek ?></td>
                        <td><span style="color: <?php echo $task->t_state ?>">●</span><?php echo $task->t_title ?></td>
                        <td><button class="btn btn-link btn-xs link-style" onclick="cusRedirect('<?php echo $task->t_customer ?>')"><?php echo $task->t_customer ?></button></td>
                        <td><button class="btn btn-link btn-xs link-style" onclick="redirect('<?php echo $task->t_assigned ?>')"><?php echo $task->t_assigned ?></button></td>
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
    }function cusRedirect(cust) {
        document.cookie = "Kunde=" + cust;
        window.location = 'enkeltKunde.php';
    }
</script>
    </body>
    <html>
