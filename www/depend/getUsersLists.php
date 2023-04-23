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
                
                $html .= "<div data-id=\"{$row['id']}\" class=\"list-menu-item\">
                <div id=\"{$row['id']}\" class=\"list-menu-item-clicker list-menu-item-active\"><h2>{$row['nev']}</h2></div>
                <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
            </div>";
            }
            else {
                $html .= "<div data-id=\"{$row['id']}\" class=\"list-menu-item\">
                <div id=\"{$row['id']}\" class=\"list-menu-item-clicker\"><h2>{$row['nev']}</h2></div>
                <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
            </div>";
            }
        }
    }
    echo $html;
}

?>