<?php
    include_once("connect.php");
    if ($_POST != null){
        $ridResult = query("SELECT Reservation_ID FROM reservation ORDER BY Reservation_ID DESC LIMIT 1");
        $ridRow = $ridResult->fetch_array();
        $rid = $ridRow["Reservation_ID"];
        $prefix = substr($rid, 0, 1); // "P"를 추출
        $number = (int) substr($rid, 1); // 숫자 부분 추출 후 정수로 변환
        $newNumber = $number + 1; // 숫자에 1을 더함
        $newrid = $prefix . str_pad($newNumber, strlen($rid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
        
        $jumin = $_POST["jumin"];
        $pid = query("SELECT Patient_ID FROM patient WHERE Personal_ID='$jumin'");
        $pidd = $pid->fetch_assoc();
        $patientid = $pidd["Patient_ID"];

        $eid = $_POST["query"];
        
        $res_type = $_POST["res_type"];
        $res_date = $_POST["res_date"];

        $sql = "INSERT INTO reservation VALUES ('$newrid','$res_type','$res_date','$patientid','$eid')";
        query($sql);
        echo "<script language=javascript>alert('예약되었습니다.');location.replace('./병원관리시스템_예약관리.php'); </script>";
    }
?>