<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録画面</title>
</head>

<body>
    <main>
        <form action="signup2.php" method="post">
            <table>
                <tr>
                    <td>お名前</td>
                    <td><input type="text" name="new_name" id=""></td>
                </tr>
                <tr>
                    <td>ご登録メールアドレス</td>
                    <td><input type="email" name="new_email" id=""></td>
                </tr>
                <tr>
                    <td>新規パスワード</td>
                    <td><input type="password" name="new_password" id=""></td>
                </tr>
            </table>
            <input type="submit" value="送信">
        </form>
    </main>
</body>
</html>