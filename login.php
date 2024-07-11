<?php
session_start(); // セッションを開始
include 'db_config.php'; // データベース接続ファイルをインクルード

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // フォームが送信された場合
    $username = $_POST['username']; // フォームからユーザー名を取得
    $password = $_POST['password']; // フォームからパスワードを取得

    // ユーザー名に基づいてユーザー情報を取得
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    // パスワードが正しい場合
    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id; // セッションにユーザーIDを保存
        header('Location: index.php'); // index.phpにリダイレクト
        exit();
    } else {
        $error = 'Invalid username or password'; // エラーメッセージを設定
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Task Management System</h1>
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p> <!-- エラーメッセージを表示 -->
        <?php endif; ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="index.php">Register</a> <!-- ユーザー登録ページへのリンク -->
    </div>
</body>
</html>
