<?php

include_once '../DBConnection.php';
try {
    $exp = $_REQUEST['q'];
    $db = new DBConnection();
    $q = "call deleteExpenses(:oldId)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':oldId' => $exp));
    if ($stmt != FALSE) {
        $q = 'call getexpenses(:id)';
        $stmt = $db->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute(array(':id' => $_COOKIE['Task']));
        $expenses = $stmt->fetchAll();
        echo '<input type="text" id="expenseTask" name="expenseTask" class="form-control input-style" placeholder="Opgave">
                <div class="group">
                    <div class="col span_1_of_2">
                        <input type="text" id="expense" name="expense" class="form-control input-style" placeholder="Omkostninger">
                    </div>
                    <div class="col span_1_of_2">
                        <input type="text" id="offer" name="offer" class="form-control input-style" placeholder="Tilbud">
                    </div>
                </div>
                <div align="middle">
                    <button type="button" class="btn btn-black span_1_of_3" onclick="createExp()">Tilføj</button>
                </div>
                <div class="panel panel-default">
                    <div id="no-more-tables" class="table-responsive">
                        <table class="table table-condensed">
                            <thead class="thead-style">
                                <tr>
                                    <th>Opgave</th>
                                    <th>Omkost.</th>
                                    <th>Tilbud</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($expenses as $exp) {
            echo '<tr>
                                    <td><button class="btn btn-link btn-xs table-button" onclick="changeExpAction('.$exp->e_id.','.$exp->e_text.','.$exp->e_expenses.','.$exp->e_offer.')">'.$exp->e_text.'</button></td>
                                    <td>'.$exp->e_expenses.'</td>
                                    <td>'.$exp->e_offer.'</td>
                                </tr>';
        }
        echo '</tbody>
                        </table>
                    </div>
                </div>
            </div>';
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}