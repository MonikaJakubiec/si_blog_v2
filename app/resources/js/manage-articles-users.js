function confirmArticleDelete(homePage = "", articleId) {
    if (confirm("Czy na pewno chcesz usunąć artykuł? Zmiany są nieodwracalne!")) {
        
        window.location.href = homePage + "articles-list?delete-article=" + articleId;
    }
}

function showHideAddingPicture() {
    var pInput = document.getElementById('add-picture-from-file');
    var pictureFromFileChecked = document.getElementById('picture-from-file').checked;

    if (pictureFromFileChecked) {
        pInput.style.display = 'block';
    }
    else {
        pInput.style.display = 'none';
    }
}
window.formSubmitted = true;//global variable
function preventExit() {
    window.formSubmitted = false;

    window.addEventListener("beforeunload", function(e){
        if(!formSubmitted) {
            e.preventDefault();
            (e || window.event).returnValue = "unload";
            return "unload";
        }
    });
    
}
function formSubmit() {
    window.formSubmitted = true;
}

function confirmUserDelete(homePage = "", userId) {
    if (confirm("Czy na pewno chcesz usunąć użytkownika? Zmiany są nieodwracalne!")) {
        window.location.href = homePage + "users-list?delete-user=" + userId;
    }
}
