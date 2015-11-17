<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
?>
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead"><span class="header-img">Medarbejdere</span></h4>
            <h2 class="chead"><span class="header-img">Medarbejdere</span></h2>
        </div>
        <br>
        <!-- Button for the option to create new associate -->
        <div id="new" class="col span_1_of_2 hidden" align="right">
            <button type="button" class="btn btn-black" onclick="location.href = 'associateForm.php'">Ny Medarbejder</button>
        </div>
    </div>
</div>
<br>
<!-- Tabel containing associates -->
<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed">
            <thead class="thead-style">
                <tr>
                    <th>Navn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    ?>
                    <tr><td><button class="btn btn-link btn-xs table-button" onclick="redirect('<?php echo $user->a_username ?>')"><?php echo $user->a_name; ?></button></td></tr>
                    <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Javascript functions -->
<script type="text/javascript">
//    Function to determine whether the logged in user has the needed privileges to view the whole page
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1 || <?php print_r($_SESSION["user"]->a_privileges) ?> === 2) {
            $("div#new").removeClass("hidden");
        }
    });
</script>
</body>
</html>