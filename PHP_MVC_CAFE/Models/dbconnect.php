<?php
//DBにコネクトするためのファイル（接続確認済み）
require_once './database.php';

function connect(){
    $host = DB_HOST;
    $db   = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASSWD;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

    try{
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        echo '成功です';
    } catch(PDOException $e) {
        echo '接続失敗です'. $e->getMessage();
        exit();
    }
}

echo connect();