<?php

include_once '../DBConnection.php';
try {
    $comment = $_GET['q'];
    $db = new DBConnection();
    $q = "call deletecomment(:comment)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':comment' => $comment));
    $count = $stmt->rowCount();
    if ($stmt != FALSE) {
        $q = 'call getallcomments()';
        $stmt = $db->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        if (count($comments) === 1) {
            echo '<select multiple name="comments[ ]" id="comments" class="form-control input-style" onclick="openModal(this.value)">';
        } else {
            echo '<select multiple name="comments[ ]" id="comments" class="form-control input-style" onchange="openModal(this.value)">';
        }
        foreach ($comments as $comment) {
            echo '<option  value="' . $comment->tc_id . "¤" . $comment->tc_comment . '">' . $comment->tc_associate . ',' . $comment->tc_date . '- &#10' . $comment->tc_comment . '</option>';
        }
        echo '</select>';
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}