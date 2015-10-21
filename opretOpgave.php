<?php
include './include/top.inc.php';
include './include/menubar.inc.php';
include './database/taskHandler.php';
getTaskFromCookie();
?>
<link rel="stylesheet" href="input-styles.css">
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Opgave</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Opgave</span></h2>
        </div>
    </div>
</div>
<div class="vertically-align" align="center">
    <form role="form" action="database/actions/createTask.php" method="post">
        <div class="form-group">
            <input name="title" type="text" class="form-control input-style" id="title" placeholder="Titel">
        </div>
        <div class="form-group">
            <input name="descr" type="text" class="form-control input-style" id="descr" placeholder="Beskrivelse">
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
        <div class='form-group group'>
            <div class="col span_1_of_2"><input name="hour" type="number" step="1" class="form-control input-style" id="hour" placeholder="Timer"></div>
            <div class="col span_1_of_2"><input name="min" type="number" step="15" max="60" class="form-control input-style" id="min" placeholder="Minutter"></div>
        </div>
        <!--<br>-->
        <div class='form-group'>
            <select class="form-control input-style" name="from" id="from">
                <?php
                for ($index = 1; $index < 53; $index++) {
                    ?>    
                    <option value="<?php echo $index; ?>"><?php echo $index; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class='form-group'>
            <select class="form-control input-style" name='to' id="to">
                <?php
                for ($index = 1; $index < 53; $index++) {
                    ?>    
                    <option value="<?php echo $index; ?>"><?php echo $index; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control input-style" rows="5" id="comment" placeholder="Kommentarer"></textarea>
        </div>
        <button type="submit" class="btn btn-black" id="btnCreate">Opret Opgave</button>
        <button type="submit" class="btn btn-black hidden" formaction="database/actions/alterTask.php" id="btnAlter">Rediger Opgave</button>
    </form>
</div>
<input type="hidden" id="title" name="title" value="<?php echo $_SESSION["Task"]->t_title ?>"/>
<input type="hidden" id="descr" name="descr" value="<?php echo $_SESSION["Task"]->t_description ?>"/>
<input type="hidden" id="stat" name="stat" value="<?php echo $_SESSION["Task"]->t_state ?>"/>
<input type="hidden" id="assi" name="assi" value="<?php echo $_SESSION["Task"]->t_assigned ?>"/>
<input type="hidden" id="hour" name="hour" value="<?php echo $_SESSION["Task"]->t_hour ?>"/>
<input type="hidden" id="min" name="min" value="<?php echo $_SESSION["Task"]->t_min ?>"/>
<input type="hidden" id="from" name="from" value="<?php echo $_SESSION["Task"]->t_fromweek ?>"/>
<input type="hidden" id="to" name="to" value="<?php echo $_SESSION["Task"]->t_toweek ?>"/>
<input type="hidden" id="comment" name="comment" value="<?php echo $_SESSION["Task"]->t_comment ?>"/>
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
    var $_GET = {};

    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }

        $_GET[decode(arguments[1])] = decode(arguments[2]);
    });
    $(document).ready(function () {
        if ($_GET["editing"] === "edit") {
            var title = $('#title').val();
            var descr = $('#descr').val();
            var stat = $('#stat').val();
            var assi = $('#assi').val();
            var hour = $('#hour').val();
            var min = $('#min').val();
            var from = $('#from').val();
            var to = $('#to').val();
            var comment = $('#comment').val();
            document.getElementById("editH4").innerHTML = "Rediger Opgave";
            document.getElementById("editH2").innerHTML = "Rediger Opgave";
            $("button#btnAlter").removeClass("hidden");
            $("button#btnCreate").addClass("hidden");
            document.getElementById("title").value = title;
            document.getElementById("descr").value = descr;
            document.getElementById("stat").value = stat;
            document.getElementById("assi").value = assi;
            document.getElementById("hour").value = hour;
            document.getElementById("min").value = min;
            document.getElementById("from").value = from;
            document.getElementById("to").value = to;
            document.getElementById("comment").value = comment;
        }
    });
</script>
</body>
</html>