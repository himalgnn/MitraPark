<?php

    include_once("../../../parts/entryCheck.php");
    include_once("../../db_connection.php");
    if(session_status()!=PHP_SESSION_ACTIVE)
    {
        session_start();
    }

    $uid = $_SESSION['user']['uid'];

    $getMitras = "SELECT 
    f.sender_id, 
    f.acceptor_id, 
    u.uid, 
    CONCAT(u.fname, ' ', u.lname) AS uname, 
    u.profile_picture 
FROM 
    `friends` f 
INNER JOIN 
    `users` u 
ON 
    u.uid = f.acceptor_id OR u.uid = f.sender_id 
WHERE 
    (f.acceptor_id = '$uid' OR f.sender_id = '$uid')
";

$getMitras = "
SELECT ch.ch_id, CONCAT(u.fname, ' ', u.lname) AS uname, ch.chat_history_of as sender_id, ch.chat_with as acceptor_id, ch.last_updated, u.uid, u.profile_picture FROM `chat_history` ch LEFT JOIN `users` u on u.uid = ch.chat_history_of OR u.uid = ch.chat_with WHERE ch.chat_history_of = '$uid' OR ch.chat_with = '$uid' AND u.uid <> '$uid' ORDER BY ch.last_updated DESC
";

    $result = mysqli_query($connection, $getMitras);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($result);
  
?>
