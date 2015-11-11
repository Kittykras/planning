<?php
include_once '../DBConnection.php';
try {
    $branch = $_GET['q'];
    $db = new DBConnection();
    $q = "call createBranch(:branch)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':branch' => $branch));
    $count = $stmt->rowCount();
    if ($count === 1) {
        $q = 'call getallbranch()';
        $stmt = $db->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $branches = $stmt->fetchAll();
        echo '<select class="form-control input-style" name="bran" id="bran" onchange="openModal(this.value)">';
        foreach ($branches as $branch) {
            echo '<option value="'. $branch->b_title. '">'.$branch->b_title.'</option>';
        }
        echo '<option value="newBranch">Ny Branche</option>
            </select>';
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}