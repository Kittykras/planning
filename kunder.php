<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead"><span class="header-img">Kunder</span></h4>
            <h2 class="chead"><span class="header-img">Kunder</span></h2>
        </div>
        <br>
        <div class="col span_1_of_2 hidden" align="right" id="new">
            <button type="button" class="btn btn-black" onclick="location.href='opretKunde.php'">Ny Kunde</button>
        </div>
    </div>
                <div class="row" align="center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-black">Navn</button>
                        <button type="button" class="btn btn-black">Branche</button>
                        <!--<button type="button" class="btn btn-black">Medarbejder</button>-->
                    </div>
                </div>
</div>
<br>
<div class="panel panel-default dcenter">
    <table class="table table-condensed table-responsive">
        <thead class="thead-style">
            <tr>
                <th>Navn</th>
                <th>Branche</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($customers as $customer) {
                ?>
            <tr><td><button class="btn btn-link btn-xs link-style" onclick="redirect('<?php echo $customer->c_acronym ?>')"><?php echo $customer->c_name; ?></button></td><td><?php echo $customer->c_branch; ?></td></tr>
                        <?php
                    }
                    ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1 || <?php print_r($_SESSION["user"]->a_privileges) ?> === 2) {
            $("div#new").removeClass("hidden");
        }
    });
    function redirect(user) {
        document.cookie = "Kunde=" + user;
        window.location = 'enkeltKunde.php';
    }
</script>
</body>
</html>