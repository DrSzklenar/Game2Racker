<div id="list-menu" class="littleGap flexcol hidden">
        <input id="close-lists" type="button" value="X">
        <h1>Save to...</h1>
        <div id="list-menu-item-container" class="littleGap flexcol">
        <?php 


        if (isset($id)) {
            # code...
        }
        
        // $queryUsersLists = "SELECT * FROM `lists` WHERE `userID` = {$userData['userID']}";
        // $allListsUser = mysqli_query($conn,$queryUsersLists);
        
        
        // // $row['type'] == "custom")
        // while($row = mysqli_fetch_assoc($allListsUser)) {
        //     if (true) {
        //         $GameExistsSQL = "SELECT * FROM `listGames` WHERE gameID = '{$id}' and listID = '{$row['id']}';";
        //         if (mysqli_num_rows(mysqli_query($conn, $GameExistsSQL)) > 0) {
                    
        //             echo "<div data-id=\"{$row['id']}\" class=\"list-menu-item list-menu-item-active\">
        //             <div id=\"{$row['id']}\" class=\"list-menu-item-clicker\"><h2>{$row['nev']}</h2></div>
        //             <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
        //         </div>";
        //         }
        //         else {
        //             echo "<div data-id=\"{$row['id']}\" class=\"list-menu-item\">
        //             <div id=\"{$row['id']}\" class=\"list-menu-item-clicker\"><h2>{$row['nev']}</h2></div>
        //             <div class=\"list-menu-kuka kuka\"><i class=\"fa fa-trash\"></i></div>
        //         </div>";
        //         }
        //     }
        // }
        
        ?>
        </div>
        <div id="create-opener-parent">
            <input id="create-opener" type="button" value="Create new list">
            
        </div>

        <script defer>
            let buttons = document.querySelectorAll('.search-addtolist');
            let listMenu = document.getElementById('list-menu');

            let listMenuContainer = document.getElementById('list-menu-item-container');
            let listItems = document.querySelectorAll(".list-menu-item-clicker");
            let closeLists = document.getElementById('close-lists');

            let createListContent = `<div class="list-options">
                <input type="text" name="name" id="list-options-name">
                <select id="list-options-visibility" name="visibility">
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                </select>
                <input id="create-list" type="button" value="Create">
                </div>`;

            gameData = [];
            closeLists.addEventListener('click',()=>{
                listMenu.classList.add("hidden");
                gameData = [];
            });
            
            



            function getGameData(id) {
                console.log("this is the id i got ˘˘");
                console.log(id);
                console.log(listMenuContainer);
                listMenu.classList.remove("hidden");
                gameData = [];
                let name = "";
                let picture = "";
                <?php  if (isset($id)) { ?>
                
                    name = <?php echo "\"$gameName\"" ?>;
                    picture = <?php echo "\"$gamePic\"" ?>;
                    console.log("IVE BEEN HAD!");
                <?php }else {  ?>

                    name = document.getElementById(id).childNodes[2].firstElementChild.innerText;
                    picture = document.getElementById(id).childNodes[1].firstElementChild.src;
                    console.log("EVERYTHING IS LOST!");
    
                 <?php }?>

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
                    listItems = document.querySelectorAll(".list-menu-item-clicker");
                    for (let i = 0; i < listItems.length; i++) {
                        console.log("this is a listitem˘˘˘˘˘˘");
                        console.log(listItems[i].id);
                        listItems[i].addEventListener('click',() => addToList(listItems[i],gameData[0],listItems[i].id,gameData[1],gameData[2]));
                    }
                    refreshKukaList();
                })
                .catch(error => console.log(error));
                console.log(gameData);
            }





            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click',() => getGameData(buttons[i].parentElement.parentElement.id));
            }


            
            let createOpener = document.getElementById('create-opener');
            let createOpenerParent = document.getElementById('create-opener-parent');
            createOpener.addEventListener('click',()=>{
                createOpenerParent.innerHTML += createListContent;

                let listName = document.getElementById('list-options-name');
                let listVisibility = document.getElementById('list-options-visibility');
                let createListBtn = document.getElementById('create-list');
                createListBtn.addEventListener('click', () => {
                    let dataForPHP = new FormData();
                    dataForPHP.append("name", listName.value);
                    dataForPHP.append("gameID", <?php if (isset($id)) { echo $id; } else { ?> gameData[0] <?php } ?> );
                    dataForPHP.append("gameName", <?php if (isset($gameName)) { echo "\"$gameName\""; } else { ?> gameData[1] <?php } ?>);
                    dataForPHP.append("gamePic", <?php if (isset($gamePic)) { echo "\"$gamePic\""; } else { ?> gameData[2] <?php } ?>)
                    dataForPHP.append("vis", listVisibility.value);
                    dataForPHP.append("type", "create");
                    fetch(`depend/pushLists.php`, {
                        method: "POST",
                        body: dataForPHP
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data == "CREATED") {
                            console.log("goggers");
                            getGameData(<?php if (isset($id)) { echo $id; } else { ?> gameData[0] <?php } ?>);
                            refreshKukaList();
                            
                        }
                        console.log(data);
                        console.log("Bob");
                    })
                    .catch(error => console.log(error));
    
                });
            });
            


            


            <?php  if (isset($id)) { ?>         
                let addtolist = document.getElementById('addtolist');
                addtolist.addEventListener('click',()=>{
                    console.log("you clicked the batton");
                    console.log(listMenu);
                    listMenu.classList.remove("hidden");
                    getGameData(<?php echo $id; ?>);

                });
            <?php } ?>




            function addToList(element,gameId,listId,gameName,gamePic) {
                console.log("mukszik gameid˘˘");
                console.log(gameId);
                console.log("listid˘˘");
                console.log(listId);
                element.classList.add("list-menu-item-active");

                let listName = document.getElementById('list-options-name');
                let listVisibility = document.getElementById('list-options-visibility');
                let createListBtn = document.getElementById('create-list');
                    let dataForPHP = new FormData();
                    dataForPHP.append("gameID", gameId);
                    dataForPHP.append("listID", listId);
                    dataForPHP.append("gameName", gameName);
                    dataForPHP.append("gamePic", gamePic);
                    dataForPHP.append("type", "add");
                    fetch(`depend/pushLists.php`, {
                        method: "POST",
                        body: dataForPHP
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "REMOVED") {
                            element.classList.remove("list-menu-item-active");
                        }
                    })
                    .catch(error => console.log(error));
            }




            function DeleteList(element) {
                Swal.fire({
                title: 'Are you sure you want to delete this list?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    console.log("kukaˇˇˇˇ");
                console.log(element);
                console.log("elemˇˇˇˇ");
                console.log(element.parentElement.id);
                let dataForPHP = new FormData();
                dataForPHP.append("listID", element.parentElement.dataset.id);
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

                        Swal.fire(
                        'Deleted!',
                        'Your list has been deleted.',
                        'success'
                        )
                    }
                })
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>