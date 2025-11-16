document.addEventListener("DOMContentLoaded", rotate, false);

let banner = new Array("img/descarga(0).jpg", "img/descarga(1).jpg", "img/descarga(2).gif");
let actual = 0;
let nimagenes = banner.length;

function rotate(){
    if (document.images){
        actual++;
        if (actual == nimagenes) actual = 0;
        document.getElementById("imgBanner").src=banner[actual];
    }
    setTimeout("rotate()", 1000);
}