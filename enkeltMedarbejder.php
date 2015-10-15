<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <!--<h2><script>document.write(Session.get("UserName"));</script></h2>-->
            <h2><?php echo $_COOKIE["UserName"];?></h2>
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
        </div>
    </div>
</div>
<br>

    </body>
    </html>

