<?php
    include_once("connect.php");
    if ($_POST != null){
        $type = $_POST["res_type"];
        if ($type === "treatment"){
            $tidResult = query("SELECT Treatment_ID FROM treatment ORDER BY Treatment_ID DESC LIMIT 1");
            $tidRow = $tidResult->fetch_array();
            $tid = $tidRow["Treatment_ID"];
            $prefix = substr($tid, 0, 1); // "P"를 추출
            $number = (int) substr($tid, 1); // 숫자 부분 추출 후 정수로 변환
            $newNumber = $number + 1; // 숫자에 1을 더함
            $newtid = $prefix . str_pad($newNumber, strlen($tid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
            
            $detail = $_POST["detail"];
            $date = $_POST["date"];
            $emp_id = $_POST["query"];
            $pat_id = $_POST["query1"];
            $room_id = $_POST["room"];
    
            $sql = "INSERT INTO treatment VALUES ('$newtid','$detail','$date','$emp_id','$pat_id','$room_id')";
            query($sql);
            echo "<script language=javascript>alert('진료가 등록되었습니다.');location.replace('./병원관리시스템_완료일정관리.php'); </script>";
        } elseif ($type === "operation"){
            $tidResult = query("SELECT Operation_ID FROM operation ORDER BY Operation_ID DESC LIMIT 1");
            $tidRow = $tidResult->fetch_array();
            $tid = $tidRow["Operation_ID"];
            $prefix = substr($tid, 0, 1); // "P"를 추출
            $number = (int) substr($tid, 1); // 숫자 부분 추출 후 정수로 변환
            $newNumber = $number + 1; // 숫자에 1을 더함
            $newtid = $prefix . str_pad($newNumber, strlen($tid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
            
            $detail = $_POST["detail"];
            $date = $_POST["date"];
            $emp_id = $_POST["query"];
            $pat_id = $_POST["query1"];
            $room_id = $_POST["room"];
            $treat_id = $_POST["query2"];
            $exam_id = $_POST["query3"];
    
            $sql = "INSERT INTO operation VALUES ('$newtid','$detail','$date','$emp_id','$pat_id','$room_id','$treat_id','$exam_id')";
            query($sql);
            echo "<script language=javascript>alert('수술이 등록되었습니다.');location.replace('./병원관리시스템_완료일정관리.php'); </script>";
        } elseif ($type === "examination"){
            $tidResult = query("SELECT Examination_ID FROM examination ORDER BY Examination_ID DESC LIMIT 1");
            $tidRow = $tidResult->fetch_array();
            $tid = $tidRow["Examination_ID"];
            $prefix = substr($tid, 0, 1); // "P"를 추출
            $number = (int) substr($tid, 1); // 숫자 부분 추출 후 정수로 변환
            $newNumber = $number + 1; // 숫자에 1을 더함
            $newtid = $prefix . str_pad($newNumber, strlen($tid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
            
            $detail = $_POST["detail"];
            $date = $_POST["date"];
            $emp_id = $_POST["query"];
            $pat_id = $_POST["query1"];
            $room_id = $_POST["room"];
            $treat_id = $_POST["query2"];
    
            $sql = "INSERT INTO examination VALUES ('$newtid','$detail','$date','$emp_id','$pat_id','$room_id','$treat_id')";
            query($sql);
            echo "<script language=javascript>alert('검사가 등록되었습니다.');location.replace('./병원관리시스템_완료일정관리.php'); </script>";
        } elseif ($type === "hos_in"){
            $tidResult = query("SELECT Hospitalization_ID FROM hospitalization ORDER BY Hospitalization_ID DESC LIMIT 1");
            $tidRow = $tidResult->fetch_array();
            $tid = $tidRow["Hospitalization_ID"];
            $prefix = substr($tid, 0, 1); // "P"를 추출
            $number = (int) substr($tid, 1); // 숫자 부분 추출 후 정수로 변환
            $newNumber = $number + 1; // 숫자에 1을 더함
            $newtid = $prefix . str_pad($newNumber, strlen($tid) - 1, "0", STR_PAD_LEFT); // 0으로 패딩하여 문자열 생성
            
            $sdate = $_POST["date"];
            $emp_id = $_POST["query"];
            $pat_id = $_POST["query1"];
            $room_id = $_POST["room"];
            $treat_id = $_POST["query2"];
    
            $sql = "INSERT INTO hospitalization (Hospitalization_ID, Start_Date, Employee_ID, Patient_ID, Room_ID, Treatment_ID) VALUES ('$newtid','$sdate','$emp_id','$pat_id','$room_id','$treat_id')";
            query($sql);
            echo "<script language=javascript>alert('입원이 등록되었습니다.');location.replace('./병원관리시스템_완료일정관리.php'); </script>";
        } else {         
            $edate = $_POST["date"];
            $emp_id = $_POST["query"];
            $room_id = $_POST["room"];
    
            $sql = "UPDATE hospitalization SET End_Date = '$edate' WHERE Employee_ID = '$emp_id' AND Room_ID = '$room_id'";
            query($sql);
            echo "<script language=javascript>alert('퇴원이 등록되었습니다.');location.replace('./병원관리시스템_완료일정관리.php'); </script>";
        }     
    }
?>