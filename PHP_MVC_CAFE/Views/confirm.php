<!-- 確認画面をここに作成する -->
<?php
session_start();   //SESSIONを使うときは最初にスタートさせる
if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  $kana = $_SESSION['kana'];
  $tell = $_SESSION['tell'];
  $email = $_SESSION['email'];
  $content = $_SESSION['content'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問合せ機能確認画面</title>
</head>
<body>
    <h2>確認画面</h2>
    <p>
      <label for="name">氏名：</label>
      <?php echo $name ;?>
    </p>
    <p>
      <label for="kana">フリガナ：</label>
      <?php echo $kana ;?>
    </p>
    <p>
      <label for="tell">電話番号：</label>
      <?php echo $tell ;?>
    </p>
    <p>
      <label for="email">メールアドレス：</label>
      <?php echo $email ;?>
    </p>
    <p>
      <label for="content">お問合せ内容：</label>
      <?php echo nl2br($content);?>
    </p>
    <p>上記の内容でよろしいですか？</p>
    <form method="post" action="send.php" >
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <!-- キャンセルボタン押下時には入力画面に戻り 値が保持されていること -->
        <a href="form.php?action=edit">キャンセル</a>
        <!-- 送信ボタン押下→完了画面に遷移する　※ダイレクトアクセス禁止 -->
        <input type="submit" value="送信" >
    </form>
</body>
</html>