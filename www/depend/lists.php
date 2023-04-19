<div id="lists-menu" class="littleGap flexcol hidden">
        <input id="close-lists" type="button" value="X">
        <h1>Save to...</h1>
        <div class="list-item-container littleGap flexcol">
        <?php 
        
        $queryUsersLists = "SELECT * FROM `lists` WHERE `userID` = {$userData['userID']}";
        $allListsUser = mysqli_query($conn,$queryUsersLists);
        
        
        
        while($row = mysqli_fetch_assoc($allListsUser)) {
            if ($row['type'] == "custom") {
                $GameExistsSQL = "SELECT * FROM `listGames` WHERE gameID = '{$id}' and listID = '{$row['id']}';";
                if (mysqli_num_rows(mysqli_query($conn, $GameExistsSQL)) > 0) {
                    
                    echo "<div id=\"{$row['id']}\" class=\"list-item list-item-active\"><h2>{$row['nev']}</h2>
                        <div class=\"kuka\"><i class=\"fa fa-trash\"></i></div>
                    </div>";
                }
                else {
                    echo "<div id=\"{$row['id']}\" class=\"list-item\"><h2>{$row['nev']}</h2>
                        <div class=\"kuka\"><i class=\"fa fa-trash\"></i></div>
                    </div>";
                }
            }
        }
        
        ?>
        </div>
        <div id="create-opener-parent">
            <input id="create-opener" type="button" value="Create new list">
            
        </div>

        <script defer>
            
            let createOpener = document.getElementById('create-opener');
            let createOpenerParent = document.getElementById('create-opener-parent');
            createOpener.addEventListener('click',()=>{
                createOpenerParent.innerHTML += `<div class="list-options">
                <input type="text" name="name" id="list-name">
                <select id="list-visibility" name="visibility" id="list-visibility">
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                </select>
                <input id="create-list" type="button" value="Create">
                </div>`;

                let listName = document.getElementById('list-name');
                let listVisibility = document.getElementById('list-visibility');
                let createListBtn = document.getElementById('create-list');
                createListBtn.addEventListener('click', () => {
                    console.log("gag");
                    let dataForPHP = new FormData();
                    dataForPHP.append("name", listName.value);
                    dataForPHP.append("vis", listVisibility.value);
                    dataForPHP.append("type", "create");
                    fetch(`depend/pushLists.php`, {
                        method: "POST",
                        body: dataForPHP
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        console.log("Bob");
                    })
                    .catch(error => console.log(error));
                    console.log("gag");
    
                });
            });

            let listItems = document.querySelectorAll(".list-item");
            for (let i = 0; i < listItems.length; i++) {
                listItems[i].addEventListener('click',() => {
                    listItems[i].classList.add("list-item-active");

                    let listName = document.getElementById('list-name');
                    let listVisibility = document.getElementById('list-visibility');
                    let createListBtn = document.getElementById('create-list');
                        let dataForPHP = new FormData();
                        dataForPHP.append("gameID", <?php echo $id; ?>);
                        dataForPHP.append("listID", listItems[i].id);
                        dataForPHP.append("gameName", "<?php echo $gameName?>");
                        dataForPHP.append("gamePic", "<?php echo $gamePic?>");
                        dataForPHP.append("type", "add");
                        fetch(`depend/pushLists.php`, {
                            method: "POST",
                            body: dataForPHP
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                            console.log("Bob");
                        })
                        .catch(error => console.log(error));
                        console.log("gag");
                })
                
            }

        </script>
    </div>