<?php
session_start();
include("functions.php");
check_session_id();

// // ユーザ名取得
// $user_id = $_SESSION['id'];

// // DB接続
// $pdo = connect_to_db();


// // データ取得SQL作成
// // $sql = "SELECT * FROM todo_table";
// $sql = "SELECT * FROM todo_table
// LEFT OUTER JOIN(SELECT todo_id,COUNT(id) AS cnt 
// FROM like_table GROUP BY todo_id)AS likes
// ON todo_table.id = likes.todo_id";

// // SQL準備&実行
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute();

// // データ登録処理後
// if ($status == false) {
//   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
//   $error = $stmt->errorInfo();
//   echo json_encode(["error_msg" => "{$error[2]}"]);
//   exit();
// } else {
//   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
//   // fetchAll()関数でSQLで取得したレコードを配列で取得できる
//   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
//   $output = "";
//   // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
//   // `.=`は後ろに文字列を追加する，の意味
//   foreach ($result as $record) {
//     // $output .= "<tr>";
//     // $output .= "<td>{$record["deadline"]}</td>";
//     $output .= "<p class='solid_line'>";
//     $output .= "{$record["todo"]}<br><br>";
//     $output .= "{$record["deadline"]}　";
//     $output .= "<a href='todo_edit.php?id={$record["id"]}'>編集　";
//     $output .= "<a href='todo_delete.php?id={$record["id"]}'>削除　";
//     $output .= "<a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>🐥{$record["cnt"]}</a>";
//     $output .= "</p>";
//     // $output .= "<td>{$record["todo"]}</td>";
//     // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
//     // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
//     // ライクを詰め込む（use_id)と(user_id)
//     // $output .= "<td><a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>🐥{$record["cnt"]}</a></td>";
//     // $output .= "</tr>";
//   }
//   // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
//   // 今回は以降foreachしないので影響なし
//   unset($value);
// }
// 
?>
<!-- ---------------------HTML-------------------------------- -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>
  <!-- ピヨピヨ画像 -->
  <img src="img/hiyoko.png" alt="">
  <img src="img/hiyoko.png" alt="">

  <!-- フォームポスト -->
  <!-- <form action="todo_create.php" method="POST"> -->
  <!-- テキストエリア -->
  <textarea id="tmeet" name="" rows="5" cols="33">
今どうしてる？
</textarea>
  <!-- ツイート押下ボタン -->
  <button id="postTmeet">ツミートする</button>
  <!-- </form> -->
  <div id="output"></div>

  <!-- DBのtodo 日付を表示する -->

  <script>

  </script>

  <a href="todo_logout.php">ログアウト</a>
</body>
<script>
  $(function() {
    //ボタン押下して
    $('#postTmeet').on('click', function() {

      $.ajax({
          url: './dbconnect.php', //送信先
          type: 'POST', //送信方法
          datatype: 'json', //受け取りデータの種類
          data: {
            tmeet: $('#tmeet').val()
          }
        })
        // Ajax通信が成功した時
        .done(function(data) {
          $('#result').html('data[0].name');
          console.log('通信成功');
          console.log(data);
        })
        // Ajax通信が失敗した時
        .fail(function(data) {
          $('#result').html(data);
          console.log('通信失敗');
          console.log(data);
        })
    }); //#ajax click end

  }); //END
</script>

</html>