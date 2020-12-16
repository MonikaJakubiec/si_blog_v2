function confirmArticleDelete(homePage="") {
    if (confirm("Czy na pewno chcesz usunąć artykuł? Zmiany są nieodwracalne!")) {
        window.location.href = homePage+"delete-article";
    }
}