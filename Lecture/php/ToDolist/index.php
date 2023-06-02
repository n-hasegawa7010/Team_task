<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>

<body>
    <header>
        <h2>ログイン画面</h2>
    </header>
    <main>
        <!-- 仮でmianに移動。本来は入力チェックをしてから画面遷移 -->
        <form action="login_check.php" method="post">
            <table>
                <tr>
                    <td>メールアドレス</td>
                    <td><input type="email" name="email" id=""></td>
                </tr>
                <tr>
                    <td>パスワード</td>
                    <td><input type="password" name="password" id=""></td>
                </tr>
            </table>
            <p>
                <input type="submit" value="送信">
            </p>
        </form>
        <p>
            <a href="./signup.php">新規ご登録はこちら</a>
        </p>
    </main>
</body>
</html>