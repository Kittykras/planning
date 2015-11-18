<?php

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

include_once '../DBConnection.php';
try {
    $comment = $_GET['q'];
    $task = $_COOKIE['Task'];
    $db = new DBConnection();
    $q = "call deletecomment(:comment)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':comment' => $comment));
    $count = $stmt->rowCount();
    if ($stmt != FALSE) {
        $q = 'call getAllComments(:task)';
        $stmt = $db->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute(array(':task' => $task));
        $comments = $stmt->fetchAll();
        if (!isMobile()) {
            if (count($comments) === 1) {
                echo '<select name="comments[ ]" id="comments" class="form-control input-style" onclick="openModal(this.value)">';
            }
        } else {
            echo '<select name="comments[ ]" id="comments" class="form-control input-style" data-native-menu="false" onchange="openModal(this.value)">';
        }
        foreach ($comments as $comment) {
            echo '<option  value="' . $comment->tc_id . "¤" . $comment->tc_comment . '">' . $comment->tc_associate . ',' . $comment->tc_date . '- &#10' . $comment->tc_comment . '</option>';
        }
        echo '</select>';
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}