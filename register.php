<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) { // フォームが送信され、確認が完了した場合
    $username = $_POST['username']; // フォームからユーザー名を取得
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // パスワードをハッシュ化

    // 新しいユーザーをデータベースに追加
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id; // セッションにユーザーIDを保存
        $success = true; // 成功メッセージを設定
    } else {
        $error = 'Registration failed'; // エラーメッセージを設定
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // 3秒後にログインページにリダイレクトするスクリプト
        function redirectToLogin() {
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000);
        }

        // フォーム送信前に確認ダイアログを表示するスクリプト
        function confirmRegistration(event) {
            event.preventDefault(); // フォーム送信を中断
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // モーダルに入力内容を表示
            document.getElementById('confirmUsername').textContent = username;
            document.getElementById('confirmPassword').textContent = password;

            // モーダルを表示
            document.getElementById('confirmModal').style.display = 'block';
        }

        // モーダルを閉じる
        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }

        // モーダルでの確認後、フォームを送信
        function submitForm() {
            document.getElementById('registerForm').submit();
        }
    </script>
    <style>
        /* モーダルのスタイル */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <?php if (isset($success)): ?>
            <p style="color: green;">Registration successful! Redirecting to login page...</p> <!-- 成功メッセージを表示 -->
            <script>redirectToLogin();</script> <!-- リダイレクトのスクリプトを実行 -->
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p> <!-- エラーメッセージを表示 -->
        <?php endif; ?>
        <form id="registerForm" method="post" action="register.php" onsubmit="confirmRegistration(event)">
            <input type="hidden" name="confirm" value="true">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>

    <!-- 確認用モーダル -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Confirm Registration</h2>
            <p>Username: <span id="confirmUsername"></span></p>
            <p>Password: <span id="confirmPassword"></span></p>
            <button onclick="submitForm()">Confirm</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>
</body>
</html>
