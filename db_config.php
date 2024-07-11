<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_manager";

// サーバー接続情報
// $servername = 'mysql648.db.sakura.ne.jp';
// $username = 'emkyk';
// $password = 'spurin0815';
// $dbname = 'emkyk_kadai_db_tasks';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

