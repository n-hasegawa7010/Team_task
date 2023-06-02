<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>フォーム</title>

<style>
	h2{
		color: brown;
	}
</style>

</head>

<body>
	<form action="tmpl/search.php" method="post">
		<h2>検索条件を入力してください</h2>
		<table border="1">
			<tr>
				<td>id</td>
				<td><input type="text" name="id"></td>
			</tr>
			<tr>
				<td>名前</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>電話番号</td>
				<td><input type="text" name="tel"></td>
			</tr>
			<tr>
				<td>メールアドレス</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td>コース</td>
				<td>
					<select name="course" id="course">
						<option value="">none</option>
						<option value="Normal">Normal</option>
						<option value="Beginner">Beginner</option>
						<option value="Professional">Professional</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="検索">
				</td>
			</tr>
		</table>
		<input type="hidden" name="mode" value="post">
	</form>
</body>

</html>


<?php



?>