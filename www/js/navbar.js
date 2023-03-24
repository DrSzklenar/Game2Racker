let nameBtn = document.getElementById("name");
let menu = document.getElementById("menu");

let login = document.getElementById("login");
let closeMenu = document.getElementById("closeMenu");


nameBtn.addEventListener('click', () => {
    menu.classList.toggle("menuShown");
    closeMenu.classList.add("wideMan");
    console.log("répa");
});


closeMenu.addEventListener('click', () => {
    menu.classList.remove("menuShown");
    closeMenu.classList.remove("wideMan");
});

let signOut = document.getElementById("signOut");
signOut.addEventListener('click', () => {
    document.cookie = "session=''; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
    window.location.reload();
});

