<?php
    include_once("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>예약관리</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            margin-top: 0;
        }
        
        form {
            margin-bottom: 20px;
        }
        .restype {
            display: inline;
        }

        form label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
        }
        
        form input[type="text"]{
            width: 97%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form input[type="submit"],
        form input[type="reset"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        form input[type="submit"],
        form input[type="reset"] {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        
        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        
        table th {
            background-color: #4CAF50;
            color: white;
        }
        
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        .text-center {
            text-align: center;
        }
        
        .home-button {
            display: block;
            margin: 20px auto;
            width: 120px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
    <script>
        function openPopup_patient() {
            window.open("patient_popup.php", "팝업", "width=600,height=400");
        }
        function setPatientName(patientID) {
            document.getElementById("query").value = patientID;
        }
        function openPopup_employee() {
            window.open("employee_popup.php", "팝업", "width=600,height=400");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>예약일정 관리</h1>
        <form method="POST" action="./reservation_enroll.php">
                <h2>예약 등록하기</h2>
                <hr>
                <label for="name">환자 성명</label>
                <input type="text" name="name" placeholder="영어로 입력해 주세요" required>
                <br><br>

                <label for="jumin">환자 주민등록번호</label>
                <input type="text" name="jumin" placeholder="'-' 없이 입력해 주세요" required>
                <br><br>

                <label for="res_type">예약 타입</label>
                <label class="restype" for="treatment">진료</label>
                <input class="restype" type="radio" name="res_type" value="treatment" id="treatment">
                <label class="restype" for="operation">수술</label> 
                <input class="restype" type="radio" name="res_type" value="operation" id="operation"> 
                <label class="restype" for="examination">검사</label>
                <input class="restype" type="radio" name="res_type" value="examination" id="examination"> 
                <br><br>

                <label for="query">담당직원 ID (필수 입력)</label>
                <input type="text" name="query" id="query" placeholder="담당직원 ID를 입력해 주세요" readonly>
                <button type="button" onclick="openPopup_employee()">담당직원 선택</button>
                <br><br>

                <label for="res_date">예약일</label>
                <input type="datetime-local" name="res_date" required>
                <br><br>

                <input type="submit" value="등록">
                <input type="reset" value="초기화">
        </form>
        <form name="searchForm" method="POST">            
            <h2>예약일정 조회하기</h2>
            <hr>
            <label for="query1">환자 ID (입력하지 않으면 전체 조회)</label>
            <input type="text" name="query1" id="query1" placeholder="환자 ID를 입력해 주세요" readonly>
            <button type="button" onclick="openPopup_patient()">환자 선택</button>
            <br><br>

            <label for="table">예약 유형 선택</label>
            <select name="table" required>
                <option value="Treatment">Treatment</option>
                <option value="Examination">Examination</option>
                <option value="Operation">Operation</option>
            </select>
            <br><br>
            
            <label for="start_date">시작일</label>
            <input type="datetime-local" name="start_date" required>
            
            <label for="end_date">종료일</label>
            <input type="datetime-local" name="end_date" required>
            
            <input type="submit" value="조회">
        </form>
        
        <hr>
        
        <?php
        $con = mysqli_connect("localhost", "root", "", "hospital");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $query = isset($_POST['query']) ? $_POST['query'] : '';
            $table = $_POST["table"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];

            $sql = "SELECT * FROM Reservation WHERE Reservation_Type = '$table'";
            if (!empty($query)) {
                $sql .= " AND Patient_ID = ?";
                $sql .= " AND Reservation_Date >= ? AND Reservation_Date <= ?";
            } else {
                $sql .= " AND Reservation_Date >= ? AND Reservation_Date <= ?";
            }            
            
            $stmt = mysqli_prepare($con, $sql);
            if (!empty($query)) {
                mysqli_stmt_bind_param($stmt, "sss", $query, $start_date, $end_date);
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $start_date, $end_date);
            }

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Reservation ID</th>";
                echo "<th>Reservation Type</th>";
                echo "<th>Reservation Date</th>";
                echo "<th>Patient ID</th>";
                echo "<th>Employee ID</th>";
                echo "<th>삭제</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $column) {
                        echo "<td>" . $column . "</td>";
                    }
                    echo "<td><a href='reservation_delete.php?userID=". $row['Reservation_ID']. "'>삭제</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<h3>해당 기간에 완료일정이 존재하지 않습니다.</h3>";
            }
        }
        ?>
        
        <a href="병원관리시스템_Home.html" class="home-button">홈으로</a>
    </div>
</body>
</html>
