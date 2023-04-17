let modal = document.getElementById('modal');
let images = document.getElementById('screenshots').children;
            for (const image of images) {
                image.addEventListener("dblclick", () => {
                    modal.children[0].src = image.src;
                    modal.classList.remove("hidden");
                });
            }
modal.addEventListener("click", () => {
    modal.classList.add("hidden");
});

let addtolist = document.getElementById('addtolist');
let listMenu = document.getElementById('lists-menu');

let closeLists = document.getElementById('close-lists');

closeLists.addEventListener('click',()=>{
    listMenu.classList.add("hidden");
    console.log("FaSZ");
});


addtolist.addEventListener('click',()=>{
    console.log(listMenu);
    listMenu.classList.remove("hidden");
    console.log("fos");
});

