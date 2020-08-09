<?php


$memberList = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $memberList[] = array(

        'name' => $row['name']

    );
}
unset($value);
// }


//jsonとして出力
header('Content-type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
