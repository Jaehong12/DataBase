<?php
    include_once("connect.php");
    if ($_POST != null){
        $eidResult = query("SELECT Employee_ID FROM employee ORDER BY Employee_ID DESC LIMIT 1");
        $eidRow = $eidResult->fetch_array();
        $eid = $eidRow["Employee_ID"];
        $prefix = substr($eid, 0, 1); // "P"를 추출
        $number = (int) substr($eid, 1); // 숫자 부분 추출 후 정수로 변환
        $newNumber = $number + 1; // 숫자에 1을 더함
        $neweid = $prefix . str_pad($newNumber, strlen($eid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
        
        $department = $_POST['department'];   
        $dptid = query("SELECT Department_ID FROM department WHERE Department_Name='$department'");
        $did = $dptid->fetch_assoc();
        $dept = $did['Department_ID']; 
        
        
        $position = $_POST["job"];
        $pp = query("SELECT Position_ID FROM position WHERE Position_Name='$position'");
        $ppp = $pp->fetch_assoc();
        $position_id = $ppp['Position_ID'];

        $name = $_POST["name"];
        $jumin = $_POST["jumin"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        $sql = "INSERT INTO employee VALUES ('$neweid','$name','$jumin','$phone','$address','$dept','$position_id')";
        query($sql);
        echo "<script language=javascript>alert('등록되었습니다.');location.replace('./병원관리시스템_인사관리.php'); </script>";
    }
?>