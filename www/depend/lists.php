<div id="lists-menu" class="littleGap flexcol hidden">
        <input id="close-lists" type="button" value="X">
        <h1>Save to...</h1>
        <div id="list-item-container" class="list-item-container littleGap flexcol">
        
        </div>
        <div id="create-opener-parent">
            <input id="create-opener" type="button" value="Create new list">
            
        </div>

        <script defer>
            let buttons = document.querySelectorAll('.buttonsize');

            let listMenu = document.getElementById('lists-menu');
            let listMenuContainer = document.getElementById('list-item-container');

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
                    let listItems = document.querySelectorAll(".list-item");
                    for (let i = 0; i < listItems.length; i++) {
                        listItems[i].addEventListener('click',() => {
                            listItems[i].classList.add("list-item-active");
                            console.log("rasz");
                            let listName = document.getElementById('list-name');
                            let listVisibility = document.getElementById('list-visibility');
                            let createListBtn = document.getElementById('create-list');
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
                                    console.log("Bob");
                                })
                                .catch(error => console.log(error));
                                console.log("gag");
                        })
                        
                    }
                })
                .catch(error => console.log(error));

                console.log(gameData);
            }



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

           

        </script>
    </div>