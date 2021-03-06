<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。

$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw    = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];
$id = $_POST["id"];

require_once('funcs.php');
$pdo=db_conn();

$stmt = $pdo->prepare(
         "UPDATE 
             gs_user_table 
            SET 
                name= :name,
                lid= :lid,
                lpw= :lpw,
                kanri_flg= :NULL,
                life_flg = :NULL
            WHERE
                id = :id
            ;"
                );

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

if ($status == false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
} else {

    redirect('select.php');

}

