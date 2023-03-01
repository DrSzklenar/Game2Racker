let nevek = ['atrasuluj','Tron','BleachII','rainpour','lolBeardlol','NitroHead','Facer','footboalgundog2010','Zapp_Ackerman','ClownDown','sO_cRaZY','malter_ego','Flo_rida','CircleOFgambit','sinple','creamybridget2000','mrmrmrmrmrmDream','boga_discorda','[WORT]Tron','(Fin)[Ich]LINE','Rand00m','LUSERNAME','massEker','Killua_Ackerman','astabonkus','helL-TAKER','unhinged','tomatonator','DeathMauler','TripL4SH','quanter2','DJErrickCion','Fluper_Kukker','2000fortitudes','Ping[WIN]HARCOS','Ultimater','BrapperFarter','RayZin','giveUP','Raptor_csapat','ComicLoop','screwshit','frog_lover','MCbendO','a[TOMI]c','Zerohero','pvpROCKYROCKY','emerardo sprasho','plaxbales','killfuck','BGPsortofin','Suhajda_Bokkit','coatshangerAsh','kukudlack','femboy_hater','Yuto_on_Pluto','[N/A]EmptyNull','WhiteStoneSun','Tnya_4_7rechauf','noisy_hair','KOROSHI_black','pedro_sharingan','SupersonicWereRU','Zennie_tspringer','BUSTARRR','PixelMania','owoDash','sayitAprit','dave','Radoooo','Mieruko_Garage','Finngasch','Von_Zugg_suja','Babiden_Bettebon','KilluaLovesJews','Chorogon','Rokuro_x_Benio','Mr_Byn','ratty_memes_wtf','PROpeller','Schulletlen','Lemon3McGuk','hurkerDiusker'];
let nev;
let nevinput = document.getElementById("guestname");
let refreshgomb = document.getElementById("refreshgomb");
refreshgomb.addEventListener("click", ()=> {
     nev = nevek[Math.floor(Math.random() * nevek.length)];
     localStorage.setItem("nev", nev);
     console.log("mostantól " + nev + " a neved");
     nevinput.value = nev;
})
    if (localStorage.getItem("nev") === null) {
        nev = nevek[Math.floor(Math.random() * nevek.length)];
        localStorage.setItem("nev", nev);
        console.log("mostantól " + nev + " a neved");
        nevinput.value = nev;
    }
    else{
        nev = localStorage.getItem("nev");
        nevinput.value = nev;
    }
    nevinput.addEventListener("blur", nameSave);
    //ha ki kattint a név inputjából akkor el menti
    
    
    function nameSave() {
        console.log("kragabenoritoggen");
        if (nevinput.value == "") {
            nev = nevek[Math.floor(Math.random() * nevek.length)];
            nevinput.value = nev;
            localStorage.setItem("nev",nev);
        }
        else
        {
            
            nev = nevinput.value;
            localStorage.setItem("nev",nev);
            console.log("mostantól " + nev + " a neved");
        }
    }