let hitbox1 = document.getElementById("hitbox1");
let hitbox2 = document.getElementById("hitbox2");

let nice1 = document.getElementById("nice1");
let nice2 = document.getElementById("nice2");
let nice3 = document.getElementById("nice3");
let nice4 = document.getElementById("nice4");

hitbox1.addEventListener('mouseenter', () => {
    nice3.classList.add("hoveronright");
    nice4.classList.add("hoveronright");
    hitbox2.classList.add("hoveronright");
    
    console.log("GAGO");
});
hitbox1.addEventListener('mouseleave', () => {
    nice3.classList.remove("hoveronright");
    nice4.classList.remove("hoveronright");
    hitbox2.classList.remove("hoveronright");
});
hitbox2.addEventListener('mouseenter', () => {
    nice1.classList.add("hoveronleft");
    nice2.classList.add("hoveronleft");
    hitbox1.classList.add("hoveronleft");
});
hitbox2.addEventListener('mouseleave', () => {
    nice1.classList.remove("hoveronleft");
    nice2.classList.remove("hoveronleft");
    hitbox1.classList.remove("hoveronleft");
});