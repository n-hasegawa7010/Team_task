<meta charset="UTF-8">
            <?php
            
            # データベースに接続
            $dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
            # ★ $dsn は↑スペースが入るとエラーが出てしまうので注意！★
            # できるだけこのとおりにコードする。

            $user = 'testuser';
            $pass = 'testpass';

            try{
                $dbh = new PDO($dsn, $user, $pass);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if ($dbh == null){
                    # DB 接続に失敗したときここは実行されず、catch 内が実行される
                }else{
                    echo " 接続成功！ ";
                }
            }catch (PDOException $e){
                echo " 接続失敗...<br>";
                echo " エラー内容：" . $e->getMessage();
                die();
            }

            $dbh = null;