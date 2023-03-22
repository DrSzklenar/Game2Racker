let playing = document.getElementById('stillplaying');

playing.addEventListener("click",() => {
    
   playing.classList.toggle("stillplayingcolor");
   
});


let completed = document.getElementById('completed');

completed.addEventListener("click",() => {
    
   completed.classList.toggle("completedcolor");
   
});

let addlistc = document.getElementById('addtolist');

addlistc.addEventListener("click",() => {
    
   addlistc.classList.toggle("addtolistcolor");
   
});

let wishlist = document.getElementById('wishlist');

wishlist.addEventListener("click",() => {
    
   wishlist.classList.toggle("wishlistcolor");
   
});

let favorite = document.getElementById('favorite');

favorite.addEventListener("click",() => {
    
   favorite.classList.toggle("favoritecolor");
   
});