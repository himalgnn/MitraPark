<?php
    
    if(isset($_POST['commentId']))
    {
        include_once("../../db_connection.php");

        $commentId = htmlspecialchars($_POST['commentId']);
        $commentId = mysqli_escape_string($connection, $commentId);

        $newComment = htmlspecialchars($_POST['newComment']);
        $newComment = mysqli_escape_string($connection, $newComment);

        if(session_status()!=PHP_SESSION_ACTIVE)
        {
            session_start();
            
        }

        $selectComment = "SELECT * FROM `comments` WHERE `comment_id`='$commentId'";
        $result = mysqli_query($connection, $selectComment);

        $result = mysqli_fetch_assoc($result);

        if($result)
        {
            if($_SESSION['user']['uid']==$result['comment_by'])
            {
                $updateComment ="UPDATE `comments` SET `content`='$newComment' WHERE `comment_id`='$commentId'";
                $result = mysqli_query($connection, $updateComment);
            }
        }

    }
?>
