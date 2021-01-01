
function addAllertCloseButtonListener() {
    var closeButtons = document.getElementById("alerts").getElementsByClassName("close");
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].addEventListener("click", function () {
             this.parentElement.classList.add("closed");
        });
    }
}