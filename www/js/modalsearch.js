let buttons = document.querySelectorAll('.buttonsize');

let listMenu = document.getElementById('lists-menu');

let closeLists = document.getElementById('close-lists');

closeLists.addEventListener('click',()=>{
    listMenu.classList.add("hidden");
    console.log("FaSZ");
});


for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click',() => {
        console.log(listMenu);
        listMenu.classList.remove("hidden");
        console.log("fos");
    });
}


function manybtn(button,) {
    
}