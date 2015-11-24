<?php
include 'include/sessionCheck.php';
include 'include/top.inc.php';
include 'include/menubar.inc.php';
include 'database/branchHandler.php';
$links = getLinksFromCustomerEdit();
?>
<link rel="stylesheet" href="./styles/input-styles.css">
<!-- Header -->
<div class="container dcenter hpic img-responsive">
    <div class="section group">
        <div class="col span_1_of_2">
            <h4 class="chead" id="editH4"><span class="header-img">Opret Kunde</span></h4>
            <h2 class="chead" id="editH2"><span class="header-img">Opret Kunde</span></h2>
        </div>
        <br>
    </div>
</div>
<!-- Form for creating/altering selected customer -->
<div class="vertically-align" align="center">
    <form id="form" role="form" action="database/actions/createCustomer.php" method="post">
        <div class="form-group">
            <input name="name" type="text" class="form-control input-style" id="name" placeholder="Navn">
        </div>
        <div id="acroerror">
            <div class="form-group">
                <input name="acro" type="text" class="form-control input-style" id="acro" placeholder="Forkortelse (max 5 bogstaver)" onblur="checkAcro()">
            </div>
        </div>
        <div class="form-group">
            <input name="cont" type="text" class="form-control input-style" id="cont" placeholder="Kontaktperson">
        </div>
        <div class="form-group">
            <input name="tlf" type="text" class="form-control input-style" id="tlf" placeholder="Telefon">
        </div>
        <div class="form-group">
            <input name="mail" type="email" class="form-control input-style" id="mail" placeholder="Email">
        </div>
        <div class="form-group group">
            <div id="branchHolder" class="col span_1_of_2">
                <select class="form-control input-style" name="bran" id="bran" onchange="openModal(this.value)">
                    <?php
                    foreach ($branches as $branch) {
                        ?>
                        <option value="<?php echo $branch->b_title; ?>"><?php echo $branch->b_title; ?></option>
                        <?php
                    }
                    ?>
                    <option value="newBranch">Ny Branche</option>
                </select>
            </div>
            <div class="col span_1_of_2">
                <select class="form-control input-style" name="assi" id="assi">
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
        <div id="dest">
            <div class="form-group group">
                <div class="col span_1_of_3">
                    <input type="text" name="url" class="form-control input-style" id="url" placeholder="Link">
                </div>
                <div class="col span_1_of_3">
                    <input type="text" name="user" class="form-control input-style" id="user" placeholder="Brugernavn">
                </div>
                <div class="col span_1_of_3">
                    <input type="text" name="pwd" class="form-control input-style" id="pwd" placeholder="Adgangskode">
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-black span_1_of_3" onclick="addLink()">Tilføj link</button>
            </div>
            <?php if (!empty($links)) { ?>
                <?php foreach ($links as $link) {
                    ?>
                    <div class="form-group">
                        <input onclick="openLinkModal(this.value)" class="form-control input-style" value="<?php echo $link->d_url . ' // ' . $link->d_username . ' // ' . $link->d_password ?>">
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
            <?php if (!empty($links)) { ?>
                <select class="hidden" multiple name="urls[ ]" id="urls">
                    <?php foreach ($links as $link) {
                        ?>
                        <option value="<?php echo $link->d_id . '¤' . $link->d_url . '¤' . $link->d_username . '¤' . $link->d_password ?>"> <?php echo $link->d_url ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            ?>
        </div>
    </form>
    <!-- Button for submitting form -->
    <button type="submit" form="form" class="btn btn-black span_1_of_3" id="btnCreate" onclick="selectAll()">Gem</button>
    <button type="submit" form="form" class="btn btn-black span_1_of_3 hidden" formaction="database/actions/alterCustomer.php" onclick="selectAll()" id="btnAlter">Gem</button>
</div>
<!-- Popup for creating new branch -->
<div id="branchModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Opret Branche</h3>
            </div>
            <div class="modal-body vertically-align">
                <input class="form-control input-style" type="text" id="branch" placeholder="Branche">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" onclick="updateBranch()">Opret</button>
            </div>
        </div>
    </div>
</div>
<!-- Popup for altering/deleting selected link -->
<div id="linkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Rediger Link</h3>
            </div>
            <div class="modal-body vertically-align">
                <input type="hidden" id="oldId" name="oldId"/>
                <input type="hidden" id="oldLink" name="oldLink"/>
                <input class="form-control input-style" type="text" id="urlEdit" placeholder="Link">
                <input class="form-control input-style" type="text" id="userEdit" placeholder="Brugernavn">
                <input class="form-control input-style" type="text" id="pwdEdit" placeholder="Adgangskode">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" onclick="editLink()">Rediger</button>
                <button type="button" class="btn btn-black" onclick="deleteLink()">Slet</button>
            </div>
        </div>
    </div>
</div>
<!-- Hidden values to fill out form -->
<input type="hidden" id="cName" name="cName" value="<?php echo $_SESSION["Kunde"]->c_name ?>"/>
<input type="hidden" id="cAcro" name="cAcro" value="<?php echo $_SESSION["Kunde"]->c_acronym ?>"/>
<input type="hidden" id="cCont" name="cCont" value="<?php echo $_SESSION["Kunde"]->c_conperson ?>"/>
<input type="hidden" id="cTlf" name="cTlf" value="<?php echo $_SESSION["Kunde"]->c_connumber ?>"/>
<input type="hidden" id="cMail" name="cMail" value="<?php echo $_SESSION["Kunde"]->c_conmail ?>"/>
<input type="hidden" id="cBran" name="cBran" value="<?php echo $_SESSION["Kunde"]->c_branch ?>"/>
<input type="hidden" id="cAssi" name="cAssi" value="<?php echo $_SESSION["Kunde"]->c_assigned ?>"/>
<!-- Errormessages -->
<?php
if (isset($_GET["error"])) {
    if (isset($_GET["edit"])) {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i redigeringen af kunde. Tjek at alle felter er udfyldt, eller, hvis du er ved at ændre forkortelse, om det nye forkortelse er på max 5 bogstaver, eller evt. allerede eksisterer.</span>
        </div>
        <?php
    } else {
        ?>
        <div class="vertically-align" align="center">
            <span class="text-danger">Der er sket en fejl i oprettelsen af kunde. Tjek at alle felter er udfyldt, og om forkortelsen er på max 5 bogstaver, eller evt. allerede eksisterer.</span>
        </div>
        <?php
    }
}
?>
<!-- Javascript functions -->
<script language="javascript" type="text/javascript">
//    Function to check if acronym already exists
    function checkAcro() {
        var acro = document.getElementById("acro").value;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("acroerror").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/checkCusAcro.php?q=" + acro, true);
        xmlhttp.send();
    }
//    Function to prevent enter key from submitting
    $('#form').on('keyup keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code === 13) {
            e.preventDefault();
            return false;
        }
    });
    var urls = [];
    //    Function to add links from database to array
    addArrayToUrls(<?php echo json_encode($links) ?>);
    function addArrayToUrls(array) {
        for (i = 0; i < array.length; i++) {
            var dest = {d_id: array[i].d_id, d_url: array[i].d_url, d_username: array[i].d_username, d_password: array[i].d_password};
            urls.push(dest);
        }
    }
    //    Function to select all links from selectbox
    function selectAll() {
        selectBox = document.getElementById("urls");

        for (var i = 0; i < selectBox.options.length; i++)
        {
            selectBox.options[i].selected = true;
        }
    }
    //    Function to delete link and refill selectbox
    function deleteLink() {
        var oldId = document.getElementById('oldId').value;
        var oldlink = document.getElementById('oldLink').value;
        var index = urls.map(function (e) {
            return e.d_url;
        }).indexOf(oldlink);
        urls.splice(index, 1);
        var json = JSON.stringify(urls);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("dest").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/deleteLink.php?q=" + json + "&linkid=" + oldId, true);
        xmlhttp.send();
        $('#linkModal').modal('hide');
    }
    //    Function to alter link and refill selectbox
    function editLink() {
        var oldlink = document.getElementById('oldLink').value;
        var url = document.getElementById('urlEdit').value;
        var user = document.getElementById('userEdit').value;
        var pwd = document.getElementById('pwdEdit').value;
        var index = urls.map(function (e) {
            return e.d_url;
        }).indexOf(oldlink);
        urls[index].d_url = url;
        urls[index].d_username = user;
        urls[index].d_password = pwd;
        var json = JSON.stringify(urls);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("dest").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/addLink.php?q=" + json, true);
        xmlhttp.send();
        $('#linkModal').modal('hide');
    }
    //    Function to open popup with the selected link
    function openLinkModal(value) {
        value = value.replace(/\s+/g, '');
        var link = value.split("//");
        var index = urls.map(function (e) {
            return e.d_url;
        }).indexOf(link[0]);
        var id = urls[index].d_id;
        document.getElementById("oldId").value = id;
        document.getElementById("oldLink").value = link[0];
        console.log(id);
        document.getElementById("urlEdit").value = link[0];
        document.getElementById("userEdit").value = link[1];
        document.getElementById("pwdEdit").value = link[2];
        $('#linkModal').modal('show');
    }
    //    Function to add link to selectbox
    function addLink() {
        var url = document.getElementById('url').value;
        var user = document.getElementById('user').value;
        var pwd = document.getElementById('pwd').value;
        var dest = {d_id: 0, d_url: url, d_username: user, d_password: pwd};
        urls.push(dest);
        var json = JSON.stringify(urls);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("dest").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/addLink.php?q=" + json, true);
        xmlhttp.send();
    }
    //    Function to add new branch to selectbox
    function updateBranch() {
        var val = document.getElementById('branch').value;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("branchHolder").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "database/actions/createBranch.php?q=" + val, true);
        xmlhttp.send();
        $('#branchModal').modal('hide');
    }
    //    Function to open popup to add branch
    function openModal(value) {
        if (value === 'newBranch') {
            $('#branchModal').modal('show');
        }
    }
    //    Function for filling out form when altering customer
    $(window).load(function () {
        var editing = window.location.search;
        if (editing === "?edit") {
            var name = $('#cName').val();
            var acro = $('#cAcro').val();
            var cont = $('#cCont').val();
            var tlf = $('#cTlf').val();
            var mail = $('#cMail').val();
            var bran = $('#cBran').val();
            var assi = $('#cAssi').val();
            document.getElementById("editH4").innerHTML = "<span class='header-img'>Rediger Kunde</span>";
            document.getElementById("editH2").innerHTML = "<span class='header-img'>Rediger Kunde</span>";
            $("button#btnAlter").removeClass("hidden");
            $("button#btnCreate").addClass("hidden");
            document.getElementById("name").value = name;
            document.getElementById("acro").value = acro;
            document.getElementById("cont").value = cont;
            document.getElementById("tlf").value = tlf;
            document.getElementById("mail").value = mail;
            document.getElementById("bran").value = bran;
            document.getElementById("assi").value = assi;
        }
    });
</script>
</body>
</html>