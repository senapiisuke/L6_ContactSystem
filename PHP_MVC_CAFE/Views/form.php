<!-- 入力画面をここに作成する -->
<?php
//SESSIONを使うときは最初にスタートさせる
session_start();

//送信ボタンが押されたかどうかを確認
if(isset($_POST['btn_confirm'])){
  //POSTされたデータをエスケープ処理して変数に格納する
  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
  $kana = htmlspecialchars($_POST['kana'], ENT_QUOTES, 'UTF-8');
  $tell = htmlspecialchars($_POST['tell'], ENT_QUOTES, 'UTF-8');
  $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
  $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');

  //バリデーション
  $errors = []; //エラー格納用の配列
  //氏名（空白が無いか、10文字以内か）
  if (empty($_POST['name'])) {
    $errors[] = '氏名は必須項目です。';
  } elseif (mb_strlen($_POST['name']) > 10) {
    $errors[] = '氏名は10文字以内でお願いします。';
}
  //フリガナ（空白が無いか、10文字以内か）
  if (empty($_POST['kana'])) {
    $errors[] = 'フリガナは必須項目です。';
  } elseif (mb_strlen($_POST['kana']) > 10) {
    $errors[] = 'フリガナは10文字以内でお願いします。';
}
  //電話番号(数字かどうか)
  if(!preg_match("/^[0-9]+$/" ,$tell)){
    $errors[] = '電話番号は数字で入力してください。';
  }
  //メールアドレス（空白が無いか、メールアドレスかどうか）
  if (empty($_POST['email'])) {
    $errors[] = 'メールアドレスは必須項目です。';
  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = '正しくメールアドレスを指定してください。';
}
  //お問い合わせ内容（空白が無いか）
  if (empty($_POST['content'])) {
    $errors[] = 'お問合せ内容は必須項目です。';
  }

  //エラー配列がなければ次の画面へ遷移
  if(count($errors) === 0){
    //ひとまず確認のためメッセージ表示
    //echo "入力値に異常はありませんでした";
    //入力値を保持したまま
    $_SESSION['name']= $name;
    $_SESSION['kana'] = $kana;
    $_SESSION['tell']= $tell;
    $_SESSION['email']= $email;
    $_SESSION['content'] = $content;
    //確認画面に遷移するようにする
    header("Location:confirm.php");
  }elseif(count($errors) > 0){
  // エラー配列があればエラーを表示する
    foreach($errors as $e){
      echo $e."<br>";
    }
  }
}
// confirm.phpから戻ってきたときに値を保持
if (isset($_GET) && isset($_GET['action']) && $_GET['action'] === 'edit') {
  $name = $_SESSION['name'];
  $kana  = $_SESSION['kana'];
  $tell = $_SESSION['tell'];
  $email = $_SESSION['email'];
  $content  = $_SESSION['content'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問合せ機能入力画面</title>
</head>
<body>
    <h2>入力画面</h2>
    <form action="" method="POST">
        <p>
          <label for="name">氏名：</label>
          <input type="text" name="name" value="<?php if(isset($name)){echo $name;} ?>">
        </p>
        <p>
          <label for="kana">フリガナ：</label>
          <input type="text" name="kana" value="<?php if(isset($kana)){echo $kana;} ?>">
        </p>
        <p>
          <label for="tell">電話番号：</label>
          <input type="text" name="tell" value="<?php if(isset($tell)){echo $tell;} ?>">
        </p>
        <p>
          <label for="email">メールアドレス：</label>
          <input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>">
        </p>
        <p>
          <label for="content">お問合せ内容：</label>
          <input type="text" name="content" value="<?php if(isset($content)){echo $content;} ?>">
        </p>
        <input type="submit" name="btn_confirm" value="送信">
    </form>
</body>
</html>