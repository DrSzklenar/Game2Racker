let buttons = document.querySelectorAll('.buttonsize');

let listMenu = document.getElementById('list-menu');

let closeLists = document.getElementById('close-lists');

closeLists.addEventListener('click',()=>{
    listMenu.classList.add("hidden");
});


for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click',() => {
        listMenu.classList.remove("hidden");
    });
}


function manybtn(button,) {
    
}