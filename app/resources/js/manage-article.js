function confirmArticleDelete() {
    if (confirm("Czy na pewno chcesz usunąć artykuł? Zmiany są nieodwracalne!")) {
        window.location.href = "index.php?page=delete-article";
    }
}