<?php
include 'include/sessionCheck.php';
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
            <button type="button" class="btn btn-black" onclick="location.href = 'customerForm.php'">Ny Kunde</button>
        </div>
    </div>
    <div class="row" align="center">
        <div class="btn-group">
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'c_name', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Navn</button>
            <button type="button" class="btn btn-black" onclick="SetCookie('orderby', 'c_branch', '1');
                    SetCookie('state', '0', '1');
                    location.reload()">Branche</button>
            <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
        </div>
    </div>
</div>
<br>
<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed">
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
                    <tr><td><button class="btn btn-link btn-xs table-button link-style" onclick="cusRedirect('<?php echo $customer->c_acronym ?>')"><?php echo $customer->c_name; ?></button></td>
                        <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                        <td><button class="btn btn-link btn-xs table-button link-style" onclick="openBranchModal('<?php echo $customer->c_branch ?>')"><?php echo $customer->c_branch ?></button></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div id="branchModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Rediger Branche</h3>
            </div>
            <form role="form" action="database/actions/alterBranch.php" method="post">
                <div class="modal-body vertically-align"/>
                    <input type="hidden" id="oldBranch" name="oldBranch">
                    <input class="form-control input-style" type="text" name="branch" id="branch" placeholder="Branche">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-black">Gem</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_GET["error"])) {
    ?>
    <div class="vertically-align" align="center">
        <span class="text-danger">Branche blev ikke redigeret. Prøv venligst igen.</span>
    </div>
    <?php
}
?>
<script type="text/javascript">
    function openBranchModal(value) {
        document.getElementById('oldBranch').value = value;
        document.getElementById('branch').value = value;
        $('#branchModal').modal('show');
    }
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 1 || <?php print_r($_SESSION["user"]->a_privileges) ?> === 2) {
            $("div#new").removeClass("hidden");
        }
    });
</script>
</body>
</html>