<?php
#Комментарии к заявке
session_start();
if (isset($_GET['id'])) {

    include_once('../config.php');

    $item_id = intval($_GET['id']);

    if ($_POST['comment2'] != null) {
        include_once('../library/UnionDB.php');

        $staff_id = intval($_SESSION['user_id']);

        $now_date = date('Y-m-d H:i:s');

        $comment = htmlspecialchars(trim($_POST['comment2']));
        $comment_type_id = '2';

        UnionDB::connectDb();

        mysql_query("INSERT INTO comments VALUES ('$item_id', '$now_date', '$staff_id', '$comment', '$comment_type_id')");

        header("Location: $local?page=detail&id=$item_id");
    } else header("Location: $local?page=detail&id=$item_id");
} else echo "<div class='alert'>Идентификатор не передан !</div>";