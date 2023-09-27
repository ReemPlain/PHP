<?php
// Обработка и сохранение нового комментария
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Защита от инъекций
    $name = htmlspecialchars($data["name"]);
    $comment = htmlspecialchars($data["comment"]);

    $newComment = ["name" => $name, "comment" => $comment];

    $comments = json_decode(file_get_contents("comments.json"), true);
    $comments[] = $newComment;

    file_put_contents("comments.json", json_encode($comments));

    http_response_code(200);
} else {
    http_response_code(400);
}
?>
