function confirmArticleDelete(homePage="", articleId) {
    if (confirm("Czy na pewno chcesz usunąć artykuł? Zmiany są nieodwracalne!")) {
        window.location.href = homePage + "admin-panel?delete-article=" + articleId;
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

function addArtStatusAlert() {
    var url = new URL(window.location.href);
    var addArtStatus = url.searchParams.get("add-art-status");
    if(addArtStatus != null) {
        switch(addArtStatus) {
            case 'draft':
                alert("Artykuł został zapisany jako wersja robocza");
                break;
            case 'published':
                alert("Artykuł został opublikowany na blogu");
                break;
        }   
    }
}