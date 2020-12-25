var formSubmitted = false;

window.addEventListener("beforeunload", function(e){
    if(!formSubmitted) {
        e.preventDefault();
        (e || window.event).returnValue = "unload";
        return "unload";
    }
});

function formSubmit() {
    formSubmitted = true;
}