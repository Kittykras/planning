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
        $("#pressdate").datepicker({
            firstDay: 1,
            onSelect: function (dat, inst) {
                $('#pressdate').val($.datepicker.formatDate("yy-mm-dd", new Date(dat)));
            }
        });
    });
</script>

<!--<link rel="stylesheet" href="styles/input-styles.css">-->
<link href="styles/number.css" rel="stylesheet">
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Opgave(<a href="singleCustomer.php"><?php print_r(htmlEntities2($_COOKIE["Kunde"])) ?></a>)</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Opgave(<a href="singleCustomer.php"><?php print_r(htmlEntities2($_COOKIE["Kunde"])) ?></a>)</span></h2>
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
                    <option value="blue">Blå</option>
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
                <div class="input-group" align="left">
                    <label class="background-label">Timer</label>
                    <input name="hour" type="text" class="form-control input-style foreground-input" id="hour" value="0" onkeyup="add(this.value, this.id)">
                    <div class="input-group-btn">
                        <div class="time-buttons btn-group-vertical btn-group-xs">
                            <button type="button" class="btn" align="middle" onclick="addHours()"><span class="glyphicon glyphicon-chevron-up"></span></button>
                            <button type="button" class="btn" align="middle" onclick="subtractHours()"><span class="glyphicon glyphicon-chevron-down"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span_1_of_2" align="left">
                <div class="input-group">
                    <label class="background-label">Minutter</label>
                    <input name="min" type="text" class="form-control input-style foreground-input" id="min" value="0" onkeyup="add(this.value, this.id)">
                    <div class="input-group-btn">
                        <div class="time-buttons btn-group-vertical btn-group-xs">
                            <button type="button" class="btn" align="middle" onclick="addMinuts()"><span class="glyphicon glyphicon-chevron-up"></span></button>
                            <button type="button" class="btn" align="middle" onclick="subtractMinuts()"><span class="glyphicon glyphicon-chevron-down"></span></button>
                        </div>
                    </div>
                </div>
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
        <div class="form-group" align="left">
            <div class="checkbox">
                <label><input type="checkbox" name="online" id="online" value="true">Online</label>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-black span_1_of_3" onclick="openExpModal()">Udgifter</button>
        </div>
        <div class="form-group group">
            <div class="col span_1_of_2">
                <label for="mailto">Kommentaren bliver tilsendt: </label>
            </div>
            <div class="col span_1_of_2">
                <select class="form-control input-style" id="mailto" name="mailto">
                    <option value=""></option>
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
        <div id="commentDiv" class="form-group">
            <div class="form-group">
                <textarea class="form-control input-style" rows="1" id="newComment" name="newComment" placeholder="Ny Kommentar"></textarea>
            </div>
            <?php
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    ?>
                    <div class="form-group">
                        <textarea onclick="SetCookie('commentId', <?php echo $comment->tc_id ?>, '1');
                                        openModal(this.value)" class="form-control input-style" rows="1"><?php echo $comment->tc_associate . ',' . $comment->tc_date . ' - ' . $comment->tc_comment ?></textarea>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </form>
    <!-- Button for submitting form -->
    <button type="submit" form="form" class="btn btn-black span_1_of_3" id="btnCreate">Gem</button>
    <button type="submit" form="form" class="btn btn-black span_1_of_3 hidden" id="btnAlter" formaction="database/actions/alterTaskNoPriv.php">Gem</button>
    <div class="group hidden" id="btnAlter">
        <div class="col span_1_of_2">
            <button type="submit" form="form" class="btn btn-black span_2_of_3" formaction="database/actions/alterTask.php">Gem</button>
        </div>
        <div class="col span_1_of_2">
            <button class="btn btn-black span_2_of_3" data-toggle="modal" data-target="#deleteModal">Slet</button>
        </div>
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
<!-- Popup containing expenses -->
<div id="expModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Udgifter</h3>
            </div>
            <div id="expModalBody" class="modal-body vertically-align">
                <input type="hidden" id="expId">
                <input type="text" id="expenseTask" name="expenseTask" class="form-control input-style" placeholder="Leverance">
                <div class="group">
                    <div class="col span_1_of_2">
                        <input type="text" id="expense" name="expense" class="form-control input-style" placeholder="Omkostninger">
                    </div>
                    <div class="col span_1_of_2">
                        <input type="text" id="offer" name="offer" class="form-control input-style" placeholder="Tilbud">
                    </div>
                </div>
                <div id="expButton" align="middle">
                    <button type="button" class="btn btn-black span_1_of_3" onclick="createExp()">Tilføj</button>
                </div>
                <div class="panel panel-default">
                    <div id="no-more-tables" class="table-responsive">
                        <table class="table table-condensed">
                            <thead class="thead-style">
                                <tr>
                                    <th>Leverance</th>
                                    <th>Omkost.</th>
                                    <th>Tilbud</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $expenses = getExpFromTask();
                                foreach ($expenses as $exp) {
                                    ?>
                                    <tr>
                                        <td><button class="btn btn-link btn-xs table-button" onclick="changeExpAction('<?php echo $exp->e_id ?>', '<?php echo $exp->e_text ?>', '<?php echo $exp->e_expenses ?>', '<?php echo $exp->e_offer ?>')"><?php echo $exp->e_text ?></button></td>
                                        <td><?php echo $exp->e_expenses ?></td>
                                        <td><?php echo $exp->e_offer ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" onclick="closeExpModal()">OK</button>
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
<input type="hidden" id="honline" name="honline" value="<?php echo $_SESSION["Task"]->o_id ?>"/>
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
    //   Function to closing expense modal and clearing content
    function closeExpModal(){
        $("#expModal").modal("hide");
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("expModalBody").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/clearExp.php?q=" + expId, true);
        xmlhttp.send();
    }
    //    Function to deleting selected expense
    function deleteExp() {
        var expId = document.getElementById("expId").value;
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("expModalBody").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/deleteExp.php?q=" + expId, true);
        xmlhttp.send();
    }
    //    Function to altering selected expense
    function alterExp() {
        var expId = document.getElementById("expId").value;
        var expenseTask = document.getElementById("expenseTask").value;
        var expense = document.getElementById("expense").value;
        var offer = document.getElementById("offer").value;
        var expArray = [expId, expenseTask, expense, offer];
        var json = JSON.stringify(expArray);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("expModalBody").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/alterExp.php?q=" + json, true);
        xmlhttp.send();
    }
    //    Function to add functionality to alter expense
    function changeExpAction(id, text, exp, offer) {
        console.log("1");
        document.getElementById("expId").value = id;
        document.getElementById("expenseTask").value = text;
        document.getElementById("expense").value = exp;
        document.getElementById("offer").value = offer;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("expButton").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/changeExpAction.php", true);
        xmlhttp.send();
    }
    //    Function to creating expenses and adding to table
    function createExp() {
        var expenseTask = document.getElementById("expenseTask").value;
        var expense = document.getElementById("expense").value;
        var offer = document.getElementById("offer").value;
        var expArray = [expenseTask, expense, offer];
        var json = JSON.stringify(expArray);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("expModalBody").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/createExp.php?q=" + json, true);
        xmlhttp.send();
    }
    //    Function to open popup with expenses
    function openExpModal() {
        $("#expModal").modal("show");
    }
    //    Function to prevent enter key from submitting
    $('#form').on('keyup keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code === 13) {
            e.preventDefault();
            return false;
        }
    });
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
                $('#pressdate').attr('disabled', true);
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
            var press = $('#hpress').val();
            var prelease = $('#hprelease').val();
            var cus = $('#cus').val();
            var online = $('#honline').val();
            SetCookie('Kunde', cus, '1');
            document.getElementById("editH4").innerHTML = "<span class='header-img'>Rediger Opgave(<a href='singleCustomer.php'>" + cus + "</a>)</span>";
            document.getElementById("editH2").innerHTML = "<span class='header-img'>Rediger Opgave(<a href='singleCustomer.php'>" + cus + "</a>)</span>";
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
            if (online !== "") {
                document.getElementById("online").checked = true;
            } else {
                document.getElementById("online").checked = false;
            }
        }
    });
    //    Function for deleting comment
    function deleteComment() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("commentDiv").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/deleteComment.php?", true);
        xmlhttp.send();
        $('#commentModal').modal('hide');
    }
    //    Function to open popup with selected comment
    function openModal(value) {
        var comment = value.split("- ");
        document.getElementById("comment").value = comment[1];
        $('#commentModal').modal('show');
    }
    //    See number.js
//    $("input[type=number").number();
    //    Function for showing release date, when press is checked
    function showDate() {
        $("#pressdate").toggleClass("hidden");
    }
</script>
<script src="functions/number.js"></script>
</body>
</html>