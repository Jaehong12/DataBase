<?php
    include_once("connect.php");
    $userID = $_GET['userID'];
    $sql = "DELETE FROM patient WHERE Patient_ID='$userID'";
    query($sql);
    echo "<script language=javascript>alert('삭제되었습니다.');location.replace('./병원관리시스템_환자관리.php'); </script>";
?>