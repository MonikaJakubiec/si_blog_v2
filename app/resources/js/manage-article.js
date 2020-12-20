function confirmArticleDelete(homePage="") {
    if (confirm("Czy na pewno chcesz usunąć artykuł? Zmiany są nieodwracalne!")) {
        window.location.href = homePage+"delete-article";
    }
}

function showHideAddingPicture() {
    var pInput = document.getElementById('add-picture-from-file');
    var pictureFromFileChecked = document.getElementById('picture-from-file').checked;

    if(pictureFromFileChecked) {
        pInput.style.display = 'block';
    }
    else {
        pInput.style.display = 'none';
    }
}