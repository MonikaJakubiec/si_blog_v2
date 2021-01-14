function addAllertCloseButtonListener() {
    var closeButtons = document
        .getElementById("alerts")
        .getElementsByClassName("close");
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].addEventListener("click", function() {
            this.parentElement.classList.add("closed");
        });
    }
}
var scrolled = false;
window.onscroll = function() {
    resizeHeader();
};

function resizeHeader() {
    const minimumScrollOffset = 80; //minimalny scroll w px, po ktorym zostanie zmnnniejszony header (od liczby odjeta zostanie połowa histerezy)
    const hysteresis = 80; //dodanie histerezy, aby rozmiar nie przeskakiwał, z zakresu <0;2*minimumScrollOffset)
    if ((document.body.scrollTop > (minimumScrollOffset + hysteresis/2)) ||
        document.documentElement.scrollTop > (minimumScrollOffset + hysteresis/2)) {
        if (!window.scrolled) {
            window.scrolled = true;
            console.log("zmn");
            document.getElementById("header").classList.add("scroll");
        }
    } else {
        if ((document.body.scrollTop < (minimumScrollOffset - hysteresis/2)) &&
            document.documentElement.scrollTop < (minimumScrollOffset - hysteresis/2)) {
            if (window.scrolled) {
                window.scrolled = false;
                console.log("ZWI");
                document.getElementById("header").classList.remove("scroll");
            }
        }
    }
}