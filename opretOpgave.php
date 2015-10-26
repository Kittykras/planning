<?php
include './include/top.inc.php';
include './include/menubar.inc.php';
include './database/taskHandler.php';
if (isset($_GET["editing"])) {
    getTaskFromCookie();
    $comments = getComments();
}
?>
<link rel="stylesheet" href="input-styles.css">
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Opgave</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Opgave</span></h2>
        </div>
        <br>
        <div class="col span_1_of_2" align="right">
            <button type="submit" form="form" class="btn btn-black" id="btnCreate">Opret Opgave</button>
            <div class="btn-group dropdown hidden" id="btnAlter">
                <button class="btn btn-black dropdown-toggle" type="submit" data-toggle="dropdown">Rediger Opgave <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-black" role="menu">
                    <li><a onclick="document.forms[0].action = 'database/actions/alterTask.php'; document.forms[0].submit()">Rediger</a></li>
                    <li><a data-toggle="modal" data-target="#deleteModal">Slet</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="vertically-align" align="center">
    <form id="form" role="form" action="database/actions/createTask.php" method="post">
        <div class="form-group">
            <input name="title" type="text" class="form-control input-style" style="font-weight: bold" id="title" placeholder="Titel">
        </div>
        <div class="form-group">
            <textarea class="form-control input-style" rows="1" id="descr" name="descr" placeholder="Beskrivelse"></textarea>
        </div>
        <div class='form-group'>
            <select class="form-control input-style" name='stat' id="stat">
                <option value="black">Alm.</option>
                <option value="#FFCC00">Gul</option>
                <option value="red">Rød</option>
                <option value="green">Grøn</option>
            </select>
        </div>
        <div class='form-group'>
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
        <div class="form-group group">
            <div class="col span_1_of_2" align="left">
                <label class="background-label">Timer</label>
                <input style="padding-right: 30px;" name="hour" type="number" step="1" min="0" class="form-control input-style foreground-input" id="hour" value="0">
            </div>
            <div class="col span_1_of_2" align="left">
                <label class="background-label">Minutter</label>
                <input style="padding-right: 30px;" name="min" type="number" step="15" min="0" max="59" class="form-control input-style foreground-input" id="min" value="0">
            </div>
        </div>
        <div class="form-group group">
            <div class="form-group col span_1_of_2" align="left">
                <label class="background-label">Start Uge</label>
                <select class="form-control input-style foreground-input" name="from" id="from">
                    <?php
                    for ($index = 1; $index < 53; $index++) {
                        ?>    
                        <option title="Start Uge" value="<?php echo $index; ?>"><?php echo $index; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col span_1_of_2" align="left">
                <label class="background-label">Slut Uge</label>
                <select class="form-control input-style foreground-input" name='to' id="to">
                    <?php
                    for ($index = 1; $index < 53; $index++) {
                        ?>    
                        <option title="Slut Uge"value="<?php echo $index; ?>"><?php echo $index; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control input-style hidden" rows="1" id="comment" name="comment" placeholder="Kommentarer" disabled=""></textarea>
        </div>
        <div class="form-group" align="left">
            <!--<label class="background-label">Ny Kommentar</label>-->
            <textarea class="form-control input-style" rows="1" id="newComment" name="newComment" placeholder="Ny Kommentar"></textarea>
        </div>
    </form>
</div>
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Du er ved at slette en opgave. Er du sikker på du vil det?</p>
            </div>
            <form class="modal-footer" role="form" action="database/actions/deleteTask.php" method="post">
                <button type="submit" class="btn btn-black">Ja</button>
                <button type="button" class="btn btn-black" data-dismiss="modal">Nej</button>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="htitle" name="htitle" value="<?php echo $_SESSION["Task"]->t_title ?>"/>
<input type="hidden" id="hdescr" name="hdescr" value="<?php echo $_SESSION["Task"]->t_description ?>"/>
<input type="hidden" id="hstat" name="hstat" value="<?php echo $_SESSION["Task"]->t_state ?>"/>
<input type="hidden" id="hassi" name="hassi" value="<?php echo $_SESSION["Task"]->t_assigned ?>"/>
<input type="hidden" id="hhour" name="hhour" value="<?php echo $_SESSION["Task"]->t_hour ?>"/>
<input type="hidden" id="hmin" name="hmin" value="<?php echo $_SESSION["Task"]->t_min ?>"/>
<input type="hidden" id="hfrom" name="hfrom" value="<?php echo $_SESSION["Task"]->t_fromweek ?>"/>
<input type="hidden" id="hto" name="hto" value="<?php echo $_SESSION["Task"]->t_toweek ?>"/>
<input type="hidden" id="hcomment" name="hcomment" value="<?php
foreach ($comments as $comment) {
    echo $comment->tc_comment;
    ?> - <?php echo $comment->tc_associate; ?>, <?php echo $comment->tc_date; ?>
           <?php
       }
       ?>"/>

<?php
if (isset($_GET["error"])) {
    if (isset($_GET["editing"])) {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i redigeringen af opgave. Tjek at alle felter er udfyldt.</span>
        </div>
        <?php
    } else {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i oprettelsen af opgave. Tjek at alle felter er udfyldt.</span>
        </div>
        <?php
    }
}
?>
<script language="javascript" type="text/javascript">
    $("input[type=number").number();
    var $_GET = {};

    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }

        $_GET[decode(arguments[1])] = decode(arguments[2]);
    });
    $(document).ready(function () {
        if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 3) {
            $('#title').attr('disabled', true);
            $('#descr').attr('disabled', true);
            $('#assi').attr('disabled', true);
            $('#from').attr('disabled', true);
            $('#to').attr('disabled', true);
        }
        if ($_GET["editing"] === "edit") {
            var title = $('#htitle').val();
            var descr = $('#hdescr').val();
            var stat = $('#hstat').val();
            var assi = $('#hassi').val();
            var hour = $('#hhour').val();
            var min = $('#hmin').val();
            var from = $('#hfrom').val();
            var to = $('#hto').val();
            var comment = $('#hcomment').val();
            document.getElementById("editH4").innerHTML = "Rediger Opgave";
            document.getElementById("editH2").innerHTML = "Rediger Opgave";
            $("#comment").removeClass("hidden");
            $("#btnAlter").removeClass("hidden");
            $("#btnCreate").addClass("hidden");
            document.getElementById("title").value = title;
            document.getElementById("descr").value = descr;
            document.getElementById("stat").value = stat;
            document.getElementById("assi").value = assi;
            document.getElementById("hour").value = hour;
            document.getElementById("min").value = min;
            document.getElementById("from").value = from;
            document.getElementById("to").value = to;
            document.getElementById("comment").value = comment;
//            if (document.getElementById("comment").value === "undefined") {
//                document.getElementById("comment").value = "";
//            }
        }
    });
</script>
</body>
</html>