<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>

<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead">Medarbejdere</h4>
            <h2 class="chead">Medarbejdere</h2>
        </div>
        <br>
        <div class="col span_1_of_2" align="right">
            <button type="button" class="btn btn-black">Ny Medarbejder</button>
        </div>
    </div>
    <!--            <div class="row" align="center">
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
                </div>-->
</div>
<br>
<div class="panel panel-default dcenter">
    <table class="table table-condensed table-responsive">
        <thead class="thead-style">
            <tr>
                <th>Medarbejder</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                foreach ($users as $user) {
                    ?>
            <tr><td><button class="btn btn-link link-style" onclick="redirect()"><?php echo $user->a_name; ?></button></td></tr>
                <?php
            }
            ?>
            </tr>
        </tbody>
    </table>
</div>
<script>
    function redirect(){
        window.location = 'enkeltMedarbejder.php';
    }
</script>
</body>
<html>