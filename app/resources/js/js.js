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
    const minimumScrollOffset = 100; //minimalny scroll w px, po ktorym zostanie zmnnniejszony header
    const hysteresis = 10; //dodanie histerezy, aby rozmiar nie przeskakiwał
    if ((document.body.scrollTop > (minimumScrollOffset + hysteresis)) ||
        document.documentElement.scrollTop > (minimumScrollOffset + hysteresis)) {
        if (!window.scrolled) {
            window.scrolled = true;
            document.getElementById("header").classList.add("scroll");
        }
    } else {
        if ((document.body.scrollTop < (minimumScrollOffset - hysteresis)) ||
            document.documentElement.scrollTop < (minimumScrollOffset - hysteresis)) {
            if (window.scrolled) {
                window.scrolled = false;
                document.getElementById("header").classList.remove("scroll");
            }
        }
    }
}