<div id="list-menu" class="littleGap flexcol hidden">
        <input id="close-lists" type="button" value="X">
        <h1>Save to...</h1>
        <div id="list-menu-item-container" class="littleGap flexcol">
        <?php 


        
        
        $queryUsersLists = "SELECT * FROM `lists` WHERE `userID` = {$userData['userID']}";
        $allListsUser = mysqli_query($conn,$queryUsersLists);
        
        
        
        while($row = mysqli_fetch_assoc($allListsUser)) {
            if ($row['type'] == "custom") {
                $GameExistsSQL = "SELECT * FROM `listGames` WHERE gameID = '{$id}' and listID = '{$row['id']}';";
                if (mysqli_num_rows(mysqli_query($conn, $GameExistsSQL)) > 0) {
                    
                    echo "<div id=\"{$row['id']}\" class=\"list-menu-item list-menu-item-active\"><h2>{$row['nev']}</h2>
                    <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
                </div>";
                }
                else {
                    echo "<div id=\"{$row['id']}\" class=\"list-menu-item\"><h2>{$row['nev']}</h2>
                    <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
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
            let buttons = document.querySelectorAll('.search-addtolist');
            let listMenu = document.getElementById('list-menu');
            let listMenuContainer = document.getElementById('list-menu-item-container');
            let closeLists = document.getElementById('close-lists');
            closeLists.addEventListener('click',()=>{
                listMenu.classList.add("hidden");
                gameData = [];
            });
            gameData = [];
            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click',() => getGameData(buttons[i].parentElement.parentElement.id));
            }
            
            
            function getGameData(id) {
                console.log(listMenuContainer);
                listMenu.classList.remove("hidden");
                gameData = [];
                let name = document.getElementById(id).childNodes[2].firstElementChild.innerText;
                let picture = document.getElementById(id).childNodes[1].firstElementChild.src;
                gameData.push(id,name,picture);
                let dataForPHP = new FormData();
                dataForPHP.append("id", gameData[0]);
                fetch(`depend/getUsersLists.php`, {
                    method: "POST",
                    body: dataForPHP
                })
                .then(response => response.text())
                .then(data => {
                    listMenuContainer.innerHTML = data;
                    let listItems = document.querySelectorAll(".list-menu-item");
                    for (let i = 0; i < listItems.length; i++) {
                        listItems[i].addEventListener('click',() => {
                            listItems[i].classList.add("list-menu-item-active");

                            let listName = document.getElementById('list-options-name');
                            let listVisibility = document.getElementById('list-options-visibility');
                            let createListBtn = document.getElementById('create-list');
                            listItems[i].classList.add("list-menu-item-active");
                                let dataForPHP = new FormData();
                                dataForPHP.append("gameID", gameData[0]);
                                dataForPHP.append("listID", listItems[i].id);
                                dataForPHP.append("gameName", gameData[1]);
                                dataForPHP.append("gamePic", gameData[2]);
                                dataForPHP.append("type", "add");
                                fetch(`depend/pushLists.php`, {
                                    method: "POST",
                                    body: dataForPHP
                                })
                                .then(response => response.text())
                                .then(data => {
                                    console.log(data);
                                })
                                .catch(error => console.log(error));
                        })
                    }
                    refreshKukaList();
                })
                .catch(error => console.log(error));
                console.log(gameData);
            }



            let createOpener = document.getElementById('create-opener');
            let createOpenerParent = document.getElementById('create-opener-parent');
            createOpener.addEventListener('click',()=>{
                createOpenerParent.innerHTML += `<div class="list-options">
                <input type="text" name="name" id="list-options-name">
                <select id="list-options-visibility" name="visibility">
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                </select>
                <input id="create-list" type="button" value="Create">
                </div>`;

                let listName = document.getElementById('list-options-name');
                let listVisibility = document.getElementById('list-options-visibility');
                let createListBtn = document.getElementById('create-list');
                createListBtn.addEventListener('click', () => {
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
    
                });
            });

            let listItems = document.querySelectorAll(".list-menu-item");
            for (let i = 0; i < listItems.length; i++) {
                listItems[i].addEventListener('click',() => {
                    listItems[i].classList.add("list-menu-item-active");

                    let listName = document.getElementById('list-options-name');
                    let listVisibility = document.getElementById('list-options-visibility');
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
                })
                
            }

            function DeleteList(element) {
                console.log("kukaˇˇˇˇ");
            console.log(element);
            console.log("elemˇˇˇˇ");
            console.log(element.parentElement.id);
            let dataForPHP = new FormData();
            dataForPHP.append("listID", element.parentElement.id);
            dataForPHP.append("type", "delete");
            fetch(`depend/pushLists.php`, {
                method: "POST",
                body: dataForPHP
            })
            .then(response => response.text())
            .then(data => {
                console.log(data)
                if (data == "DELETED") {
                    console.log(element.parentElement.id);
                    element.parentElement.remove();
                }
            })
            .catch(error => console.log(error));
        }
        
        function refreshKukaList() {
            for (let i = 0; i < listKukas.length; i++) {
                listKukas[i].removeEventListener('click',() => DeleteList(listKukas[i]));
            }  
            listKukas = document.querySelectorAll(".list-menu-kuka");
            for (let i = 0; i < listKukas.length; i++) {
                listKukas[i].addEventListener('click',() => DeleteList(listKukas[i]));
            }  
        }


        let listKukas = document.querySelectorAll(".list-menu-kuka");
        for (let i = 0; i < listKukas.length; i++) {
            listKukas[i].addEventListener('click',() => DeleteList(listKukas[i]));
        }  


        </script>
    </div>