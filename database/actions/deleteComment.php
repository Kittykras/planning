<?php
include_once '../DBConnection.php';
try {
    $comment = $_COOKIE['commentId'];
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
        echo '<div class="form-group">
                <textarea class="form-control input-style" rows="1" id="newComment" name="newComment" placeholder="Ny Kommentar"></textarea>
            </div>';
        foreach ($comments as $comment) {
            echo '<div class="form-group"><textarea  onclick="SetCookie('."'".'commentId'."'".', '.$comment->tc_id.', '."'".'1'."'".');
                            openModal(this.value)" class="form-control input-style" rows="1">' . $comment->tc_associate . ',' . $comment->tc_date . ' - ' . $comment->tc_comment . '</textarea></div>';
        }
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}