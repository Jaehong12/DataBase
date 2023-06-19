<?php
    include_once("connect.php");
    $userID = $_GET['userID'];
    $sql = "DELETE FROM employee WHERE Employee_ID='$userID'";
    query($sql);
    echo "<script language=javascript>alert('삭제되었습니다.');location.replace('./병원관리시스템_인사관리.php'); </script>";
?>