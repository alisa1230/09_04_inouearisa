<?
// まずはこれ 
// var_dump($_GET); 
// exit();
// 関数ファイルの読み込み 
include('functions.php');
// GETデータ取得
$user_id = $_GET['user_id']; 
$todo_id = $_GET['todo_id'];
// DB接続
$pdo = connect_to_db();
// likeテーブルにuseridとtodoidに値が入ってる件数をSELECT
$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
// $sql = 'INSERT INTO like_table(id, user_id, todo_id, created_at)VALUES(NULL, :user_id, :todo_id, sysdate())'; // SQL作成
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
// エラー処理 
$error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
    $like_count = $stmt->fetch();
//   var_dump($like_count[0]);
//   exit();
// いいねしていれば削除，していなければ追加のSQLを作成 
if ($like_count[0] != 0) {
  $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
} else {
  $sql = 'INSERT INTO like_table(id, user_id, todo_id, created_at)
  VALUES(NULL, :user_id, :todo_id, sysdate())'; // 1行で記述!
} 
$stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);
$status = $stmt->execute();

header('Location:todo_read.php');
}