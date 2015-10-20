<?php
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead">Kunder</h4>
            <h2 class="chead">Kunder</h2>
        </div>
        <br>
        <div class="col span_1_of_2" align="right">
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
            <tr><td><button class="btn btn-link link-style" onclick="redirect('<?php echo $customer->c_acronym ?>')"><?php echo $customer->c_name; ?></button></td><td><?php echo $customer->c_branch; ?></td></tr>
                        <?php
                    }
                    ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function redirect(user) {
        document.cookie = "kunde=" + user;
        window.location = 'enkeltKunde.php';
    }
</script>
</body>
</html>