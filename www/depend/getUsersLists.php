<?php 
require("connection.php");
require("tokenHandler.php");

if (isset($_POST["id"])) 
{
    $id = $_POST["id"];
    $queryUsersLists = "SELECT * FROM `lists` WHERE `userID` = {$userData['userID']}";
    $allListsUser = mysqli_query($conn,$queryUsersLists);

    $html = "";
    while($row = mysqli_fetch_assoc($allListsUser)) {
        
        if ($row['type'] == "custom") {
            $GameExistsSQL = "SELECT * FROM `listGames` WHERE gameID = '{$id}' and listID = '{$row['id']}';";
            if (mysqli_num_rows(mysqli_query($conn, $GameExistsSQL)) > 0) {
                
                $html .= "<div id=\"{$row['id']}\" class=\"list-menu-item list-menu-item-active\"><h2>{$row['nev']}</h2>
                <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
            </div>";
            }
            else {
                $html .= "<div id=\"{$row['id']}\" class=\"list-menu-item\"><h2>{$row['nev']}</h2>
                <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
            </div>";
            }
        }
    }
    echo $html;
}
else {
    echo $id;
}
?>