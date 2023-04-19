let playing = document.getElementById('stillplaying');
let completed = document.getElementById('completed');

playing.addEventListener("click",() => {
   
   playing.classList.add("stillplayingcolor");
   completed.classList.remove("completedcolor");
});

completed.addEventListener("click",() => {
    
   completed.classList.add("completedcolor");
   playing.classList.remove("stillplayingcolor");
});

// let addlistc = document.getElementById('addtolist');

// addlistc.addEventListener("click",() => {
    
//    addlistc.classList.toggle("addtolistcolor");
   
// });

let wishlist = document.getElementById('wishlist');

wishlist.addEventListener("click",() => {
    
   wishlist.classList.toggle("wishlistcolor");
   
});

let favorite = document.getElementById('favorite');

favorite.addEventListener("click",() => {
    
   favorite.classList.toggle("favoritecolor");
   
});