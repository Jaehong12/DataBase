<?php
    include_once("connect.php");
    if ($_POST != null){
        $pidResult = query("SELECT Patient_ID FROM patient ORDER BY Patient_ID DESC LIMIT 1");
        $pidRow = $pidResult->fetch_array();
        $pid = $pidRow["Patient_ID"];
        $prefix = substr($pid, 0, 1); // "P"를 추출
        $number = (int) substr($pid, 1); // 숫자 부분 추출 후 정수로 변환
        $newNumber = $number + 1; // 숫자에 1을 더함
        $newpid = $prefix . str_pad($newNumber, strlen($pid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
        
        $name = $_POST["name"];
        $jumin = $_POST["jumin"];      
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        $sql = "INSERT INTO patient VALUES ('$newpid','$name','$jumin','$phone','$address')";
        query($sql);
        echo "<script language=javascript>alert('등록되었습니다.');location.replace('./병원관리시스템_환자관리.php'); </script>";
    }
?>