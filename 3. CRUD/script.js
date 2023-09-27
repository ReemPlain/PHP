document.addEventListener("DOMContentLoaded", function () {
    // Загрузка списка комментариев при загрузке страницы
    loadComments();

    // Обработчик отправки формы
    document.getElementById("comment-form").addEventListener("submit", function (e) {
        e.preventDefault();
        const name = document.getElementById("name").value;
        const comment = document.getElementById("comment").value;

        // Отправка данных на сервер
        addComment(name, comment);

        // Очистка полей формы
        document.getElementById("name").value = "";
        document.getElementById("comment").value = "";
    });
});

function loadComments() {
    // Загрузка списка комментариев с сервера и отображение на странице
    fetch("get_comments.php")
        .then(response => response.json())
        .then(data => {
            const commentList = document.getElementById("comment-list");
            commentList.innerHTML = "";
            data.forEach(comment => {
                const li = document.createElement("li");
                li.textContent = `${comment.name}: ${comment.comment}`;
                commentList.appendChild(li);
            });
        });
}

function addComment(name, comment) {
    // Отправка нового комментария на сервер
    fetch("add_comment.php", {
        method: "POST",
        body: JSON.stringify({ name, comment }),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => {
        if (response.status === 200) {
            // После успешной отправки, обновите список комментариев
            loadComments();
        }
    });
}