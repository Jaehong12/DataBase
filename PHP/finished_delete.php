<?php
    include_once("connect.php");

    $userID = $_GET['userID'];
    $type=$_GET['type'];

    if ($type === 'Treatment'){
        $sql = "DELETE FROM treatment WHERE Treatment_ID='$userID'";
    } else if ($type === 'Operation'){
        $sql = "DELETE FROM operation WHERE Operation_ID='$userID'";
    } else if ($type === 'Examination'){
        $sql = "DELETE FROM examination WHERE Examination_ID='$userID'";
    } else {
        $sql = "DELETE FROM hospitalization WHERE Hospitalization_ID='$userID'";
    }    
    
    query($sql);
    echo "<script language=javascript>alert('삭제되었습니다.');location.replace('./병원관리시스템_예약관리.php'); </script>";
?>