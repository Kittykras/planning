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
$false = $_COOKIE["state"];
$showtask = $_COOKIE['showtask'];
$q = 'call getalltask(:false, :orderby, :showtask)';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(array(':false' => $false, ':orderby' => $orderby, ':showtask' => $showtask));
$tasks = $stmt->fetchAll();
echo '<table class="table table-condensed">
            <thead class="thead-style">';
if ($_COOKIE['showtask'] === '1') {
    echo '<tr>
                    <th>Opgave</th>
                    <th style="max-width: 125px;">Kunde</th>
                    <th style="max-width: 125px;">Medarb.</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($tasks as $task) {

        echo '<tr>
                        <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect(\'' . $task->t_id . '\', window.location.href)"><span style="color: ' . $task->t_state . '">●</span> ' . $task->t_title . ' <span style="color: grey" class="' . $task->e_ikonplace . '"></span></td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="cusRedirect(\'' . $task->t_customer . '\', window.location.href)">' . $task->t_customer . '</button></td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="redirect(\'' . $task->t_assigned . '\', window.location.href)">' . $task->t_assigned . '</button></td>
                    </tr>';
    }
} else {
    echo '<tr>
                    <th>Projekt</th>
                    <th style="max-width: 125px;">Kunde</th>
                    <th style="max-width: 125px;">Medarb.</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($tasks as $task) {

        echo '<tr>
                        <td><button class="btn btn-link btn-xs table-button" onclick="taskRedirect(\'' . $task->m_id . '\', window.location.href)"><span style="color: ' . $task->m_state . '">●</span> ' . $task->m_title . '</td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="cusRedirect(\'' . $task->m_customer . '\', window.location.href)">' . $task->m_customer . '</button></td>
                        <td><button class="btn btn-link btn-xs table-button" onclick="redirect(\'' . $task->m_associate . '\', window.location.href)">' . $task->m_associate . '</button></td>
                    </tr>';
    }
}
echo '</tbody>
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
                    SetCookie('showtask', '0', '1');
                    changeBtnTitle()\">Projekter</button>";
} else {
    echo "<button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 'color', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('showtask', '1', '1');
                    changeBtnTitle()\">Opgaver</button>";
}
echo "<button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 't_customer', '1');
                    SetCookie('state', '0', '1');
                    location.reload()\">Kunde</button>
            <button type=\"button\" class=\"btn btn-black\" onclick=\"SetCookie('orderby', 't_assigned', '1');
                    SetCookie('state', '0', '1');
                    location.reload()\">Medarbejder</button>";
