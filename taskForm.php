<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
include 'database/taskHandler.php';
if (isset($_GET["edit"])) {
    getTaskFromCookie();
    $comments = getComments();
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- JQuery to transforming date fields to calendar -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $("#from").datepicker({
            showWeek: true,
            firstDay: 1,
            onSelect: function (dat, inst) {
                var week = $.datepicker.iso8601Week(new Date(dat));
                $('#from').val($.datepicker.formatDate('yy-', new Date(dat)) + (week < 10 ? '0' : '') + week);
            }
        });
    });
    $(function () {
        $("#to").datepicker({
            showWeek: true,
            firstDay: 1,
            onSelect: function (dat, inst) {
                var week = $.datepicker.iso8601Week(new Date(dat));
                $('#to').val($.datepicker.formatDate('yy-', new Date(dat)) + (week < 10 ? '0' : '') + week);
            }
        });
    });
    $(function () {
        $("#pressdate").datepicker();
    });
</script>
<script src="functions/number.js"></script>
<link href="styles/number.css" rel="stylesheet">
<link rel="stylesheet" href="styles/input-styles.css">
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Opgave</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Opgave</span></h2>
        </div>
        <br>
    </div>
</div>
<!-- Form for creating/altering task -->
<div class="vertically-align" align="center">
    <form id="form" role="form" action="database/actions/createTask.php" method="post">
        <input type="hidden" id="cus" name="cus" value="<?php echo $_SESSION["Task"]->t_customer ?>"/>
        <div class="form-group">
            <input name="title" type="text" class="form-control input-style" style="font-weight: bold" id="title" placeholder="Titel">
        </div>
        <div class="form-group">
            <textarea class="form-control input-style" rows="1" id="descr" name="descr" placeholder="Beskrivelse"></textarea>
        </div>
        <div class="form-group group">
            <div class="col span_1_of_2">
                <select class="form-control input-style" name='stat' id="stat">
                    <option value="white">Alm.</option>
                    <option value="#FFCC00">Gul</option>
                    <option value="red">Rød</option>
                    <option value="green">Grøn</option>
                </select>
            </div>
            <div class="col span_1_of_2">
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
                <label class="background-label">Fra</label>
                <input type="text" id="from" name="from" class="form-control input-style foreground-input">
            </div>
            <div class="form-group col span_1_of_2" align="left">
                <label class="background-label">Til</label>
                <input type="text" id="to" name="to" class="form-control input-style foreground-input">
            </div>
        </div>
        <div id="commentDiv" class="form-group">
            <?php
            $i = 0;
            if (!empty($comments)) {
                if (count($comments) === 1) {
                    ?>
                    <select name="comments[ ]" id="comments" class="form-control input-style" onclick="openModal(this.value)">
                        <?php
                    } else {
                        ?>
                        <select name="comments[ ]" id="comments" class="form-control input-style" onchange="openModal(this.value)">
                        <?php } ?>
                        <?php foreach ($comments as $comment) { ?>
                            <option value="<?php echo $comment->tc_id . '¤' . $comment->tc_comment ?>"><?php echo $comment->tc_associate;
                            ?>, <?php echo $comment->tc_date; ?> - &#10;<?php echo $comment->tc_comment; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
        </div>
        <div class="form-group" align="left">
            <textarea class="form-control input-style" rows="1" id="newComment" name="newComment" placeholder="Ny Kommentar"></textarea>
        </div>
        <!--        <div class="form-group group">
                    <div class="form-group col span_1_of_2">
                        <input name="exp" type="text" class="form-control input-style" id="exp" placeholder="Udgifter">
                    </div>
                    <div class="form-group col span_1_of_2">
                        <input name="inv" type="text" class="form-control input-style" id="inv" placeholder="Tilbud">
                    </div>
                </div>-->
        <div class="form-group group">
            <div class="col span_1_of_2" align="left">
                <div class="checkbox">
                    <label><input type="checkbox" name="press" id="press" value="true" onchange="showDate()">Presse</label>
                </div>
            </div>
            <div class="col span_1_of_2">
                <input type="text" id="pressdate" name="pressdate" class="hidden form-control input-style" placeholder="Udgivelse Dato">
            </div>
        </div>
    </form>
    <!-- Button for submitting form -->
    <button type="submit" form="form" class="btn btn-black" id="btnCreate">Gem</button>
    <button type="submit" form="form" class="btn btn-black hidden" id="btnAlter" formaction="database/actions/alterTaskNoPriv.php">Rediger Opgave</button>
    <div class="btn-group dropdown hidden" id="btnAlter">
        <button class="btn btn-black dropdown-toggle" type="submit" data-toggle="dropdown">Rediger Opgave <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-black" role="menu">
            <li><a onclick="document.forms[0].action = 'database/actions/alterTask.php';
                    document.forms[0].submit()">Gem</a></li>
            <li><a data-toggle="modal" data-target="#deleteModal">Slet</a></li>
        </ul>
    </div>
</div>
<!-- Popup for deleting this task -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
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
<!-- Popup for deleting selected comment -->
<div id="commentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Slet Kommentar?</h3>
            </div>
            <div class="modal-body vertically-align">
                <input type="hidden" id="oldComment" name="oldComment"/>
                <textarea class="form-control input-style hidden" rows="1" id="comment" name="comment" placeholder="Kommentarer" disabled=""></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" onclick="deleteComment()">Slet</button>
            </div>
        </div>
    </div>
</div>
<!-- Hidden values to fill out form -->
<input type="hidden" id="htitle" name="htitle" value="<?php echo $_SESSION["Task"]->t_title ?>"/>
<input type="hidden" id="hdescr" name="hdescr" value="<?php echo $_SESSION["Task"]->t_description ?>"/>
<input type="hidden" id="hstat" name="hstat" value="<?php echo $_SESSION["Task"]->t_state ?>"/>
<input type="hidden" id="hassi" name="hassi" value="<?php echo $_SESSION["Task"]->t_assigned ?>"/>
<input type="hidden" id="hhour" name="hhour" value="<?php echo $_SESSION["Task"]->t_hour ?>"/>
<input type="hidden" id="hmin" name="hmin" value="<?php echo $_SESSION["Task"]->t_min ?>"/>
<input type="hidden" id="hfrom" name="hfrom" value="<?php echo $_SESSION["Task"]->t_fromweek ?>"/>
<input type="hidden" id="hto" name="hto" value="<?php echo $_SESSION["Task"]->t_toweek ?>"/>
<input type="hidden" id="hpress" name="hpress" value="<?php echo $_SESSION["Task"]->t_press ?>"/>
<input type="hidden" id="hprelease" name="hprelease" value="<?php echo $_SESSION["Task"]->p_release ?>"/>
<!-- ErrorMessages -->
<?php
if (isset($_GET["error"])) {
    if (isset($_GET["edit"])) {
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
<!-- Javascript functions -->
<script language="javascript" type="text/javascript">
    //    Function for filling out form when altering task
    $(window).load(function () {
        var editing = window.location.search;
        if (editing === "?edit") {
            if (<?php print_r($_SESSION["user"]->a_privileges) ?> === 3) {
                $('#title').attr('disabled', true);
                $('#descr').attr('disabled', true);
                $('#assi').attr('disabled', true);
                $('#from').attr('disabled', true);
                $('#to').attr('disabled', true);
                $('#inv').attr('disabled', true);
                $('#exp').attr('disabled', true);
                $('button#btnAlter').removeClass("hidden");
            } else {
                $("div#btnAlter").removeClass("hidden");
            }
            var title = $('#htitle').val();
            var descr = $('#hdescr').val();
            var stat = $('#hstat').val();
            var assi = $('#hassi').val();
            var hour = $('#hhour').val();
            var min = $('#hmin').val();
            var from = $('#hfrom').val();
            var to = $('#hto').val();
            var inv = $('#hinv').val();
            var exp = $('#hexp').val();
            var press = $('#hpress').val();
            var prelease = $('#hprelease').val();
            document.getElementById("editH4").innerHTML = "<span class='header-img'>Rediger Opgave</span>";
            document.getElementById("editH2").innerHTML = "<span class='header-img'>Rediger Opgave</span>";
            $("#comment").removeClass("hidden");
            $("#btnCreate").addClass("hidden");
            document.getElementById("title").value = title;
            document.getElementById("descr").value = descr;
            document.getElementById("stat").value = stat;
            document.getElementById("assi").value = assi;
            document.getElementById("hour").value = hour;
            document.getElementById("min").value = min;
            document.getElementById("from").value = from;
            document.getElementById("to").value = to;
            if (press === "1") {
                document.getElementById("press").checked = true;
                $("#pressdate").removeClass("hidden");
                document.getElementById("pressdate").value = prelease;
            }
        }
    });
    //    Function for deleting comment
    function deleteComment() {
        var id = document.getElementById('oldComment').value;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("commentDiv").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/deleteComment.php?q=" + id, true);
        xmlhttp.send();
        $('#commentModal').modal('hide');
    }
    //    Function to open popup with selected comment
    function openModal(value) {
        var comment = value.split("¤");
        document.getElementById("oldComment").value = comment[0];
        document.getElementById("comment").value = comment[1];
        $('#commentModal').modal('show');
    }
    //    See number.js
    $("input[type=number").number();
    //    Function for showing release date, when press is checked
    function showDate() {
        $("#pressdate").toggleClass("hidden");
    }
    ;

</script>
</body>
</html>