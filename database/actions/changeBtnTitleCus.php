<?php

function htmlEntities2($str) {
    $text = str_replace("oe", "Ø", $str);
    $text = str_replace("aaa", "Å", $text);
    $text = str_replace("ae", "Æ", $text);
    return $text;
}

require_once '../DBConnection.php';
$db = new DBConnection();
$orderby = $_COOKIE["orderby"];
$state = $_COOKIE["state"];
$acronym = $_COOKIE["Kunde"];
$acronym = htmlEntities2($acronym);
$showTask = $_COOKIE['showtask'];
$q = "call getallTaskfromcus(:acronym, :state, :orderby, :showtask)";
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(array(':acronym' => $acronym, ':state' => $state, ':orderby' => $orderby, ':showtask' => $showTask));
echo '<div class="panel panel-default dcenter">
    <div id="no-more-tables" class="table-responsive">
        <table class="table table-condensed ">
            <thead class="thead-style">
                <tr>
                    <th>Opgave</th>
                    <th style="max-width: 125px;">Medarb.</th>
                    <th style="max-width: 125px;">Kommentar</th>
                </tr>
            </thead>
            <tbody>
                ';

$ctasks = $stmt->fetchAll();
foreach ($ctasks as $ctask) {
    echo '
                    <tr>
                        <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect(\'' . $ctask->t_id . '\', window.location.href)"><span style="color: ' . $ctask->t_state . '">●</span> ' . $ctask->t_title . '<span style="color: grey" class="' . $ctask->e_ikonplace . '"></span></td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="redirect(\'' . $ctask->t_assigned . '\', window.location.href)">' . $ctask->t_assigned . '</button></td>
                        <!--See Redirect and SetCookie functions in redirectAndCookies.js-->
                        <td>' . $ctask->tc_datee . '</td>
                    </tr>
                    ';
}
echo '
            </tbody>
        </table>¤';

echo "<div class=\"btn-group dropdown\">
                <button type=\"button\" class=\"btn btn-black dropdown-toggle\" data-toggle=\"dropdown\">
                    Status <span class=\"caret\"></span></button>
                <ul class=\"dropdown-menu dropdown-black\" role=\"menu\">
                    <li><a onclick=\"SetCookie('orderby', 'red', '1');
                            SetCookie('state', '1', '1');
                            location.reload()\">Rød</a></li>
                    <li><a onclick=\"SetCookie('orderby', 'blue', '1');
                            SetCookie('state', '1', '1');
                            location.reload()\">Blå</a></li>
                    <li><a onclick=\"SetCookie('orderby', '#FFCC00', '1');
                            SetCookie('state', '1', '1');
                            location.reload()\">Gul</a></li>
                    <li><a onclick=\"SetCookie('orderby', 'white', '1');
                            SetCookie('state', '1', '1');
                            location.reload()\">Almindelig</a></li>
                    <li><a onclick=\"SetCookie('orderby', 'green', '1');
                            SetCookie('state', '1', '1');
                            location.reload()\">Grøn</a></li>
                </ul>
            </div>";
if ($_COOKIE['showtask'] === '1') {
    echo "<button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 'color', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('showtask', '0', '1');changeBtnTitle()\">Projekter</button>";
} else {
    echo "<button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 'color', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('showtask', '1', '1');changeBtnTitle()\">Opgaver</button>";
} echo
"<button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 't_assigned', '1');
                    SetCookie('state', '0', '1');
                    location.reload()\">Medarbejder</button>
            <button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 'tc_date', '1');
                    SetCookie('state', '0', '1');
                    location.reload()\">Kommentar</button>";

