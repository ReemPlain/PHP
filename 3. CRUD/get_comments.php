<?php
// Загрузка списка комментариев
$comments = file_get_contents("comments.json");
echo $comments;
?>