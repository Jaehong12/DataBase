<?php
    include_once("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>완료일정관리</title>
    <style>
        #selectContainer {
                display: none;
            }

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

        .restype {
            display: inline;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }
        
        form {
            margin-bottom: 20px;
        }
        
        form label {
            display: block;
            margin-bottom: 5px;
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
        function openPopup_patient1() {
            window.open("patient_popup1.php", "팝업", "width=600,height=400");
        }
        function openPopup_employee() {
            window.open("employee_popup.php", "팝업", "width=600,height=400");
        }
        function openPopup_treatment() {
            window.open("treatment_popup.php", "팝업", "width=600,height=400");
        }
        function openPopup_examination() {
            window.open("examination_popup.php", "팝업", "width=600,height=400");
        }
        function setPatientName(patientID) {
            document.getElementById("query").value = patientID;
        }
        function showSelectType(res_type) {
                var selectContainer = document.getElementById("selectContainer");
                var selectType = document.getElementById("selectType");
                selectContainer.style.display = "block";

                if (res_type === "treatment") {          
                selectType.innerHTML = `
                    <label for="detail">진료 내용</label>
                    <input type="text" name="detail" placeholder="영어로 입력해 주세요" required>
                    <br><br>
                `;
                } else if (res_type === "operation") {
                selectType.innerHTML = `
                    <label for="detail">수술 내용</label>
                    <input type="text" name="detail" placeholder="영어로 입력해 주세요" required>
                    <br><br>
                    <label for="query2">진료 ID (필수 입력)</label>
                    <input type="text" name="query2" id="query2" placeholder="진료 ID를 입력해 주세요" readonly>
                    <button type="button" onclick="openPopup_treatment()">진료 선택</button>
                    <br><br>
                    <label for="query3">검사 ID (필수 입력)</label>
                    <input type="text" name="query3" id="query3" placeholder="검사 ID를 입력해 주세요" readonly>
                    <button type="button" onclick="openPopup_examination()">검사 선택</button>
                    <br><br>
                `;
                } else if (res_type === "examination") {
                selectType.innerHTML = `
                    <label for="detail">검사 내용</label>
                    <input type="text" name="detail" placeholder="영어로 입력해 주세요" required>
                    <br><br>
                    <label for="query2">진료 ID (필수 입력)</label>
                    <input type="text" name="query2" id="query2" placeholder="진료 ID를 입력해 주세요" readonly>
                    <button type="button" onclick="openPopup_treatment()">진료 선택</button>
                    <br><br>
                `;
                } else if (res_type === "hos_in") {
                selectType.innerHTML = `
                    <label for="query2">진료 ID (필수 입력)</label>
                    <input type="text" name="query2" id="query2" placeholder="진료 ID를 입력해 주세요" readonly>
                    <button type="button" onclick="openPopup_treatment()">진료 선택</button>
                    <br><br>
                `;
                } else if (res_type === "hos_out") {
                selectType.innerHTML = `
                    <label for="query2">진료 ID (필수 입력)</label>
                    <input type="text" name="query2" id="query2" placeholder="진료 ID를 입력해 주세요" readonly>
                    <button type="button" onclick="openPopup_treatment()">진료 선택</button>
                    <br><br>
                `;
                } else {
                selectContainer.style.display = "none";
                }
            }
    </script>
</head>
<body>
    <div class="container">
        <h1>완료일정 관리</h1>
        <form method="POST" action="./finished_enroll.php">
                <h2>완료일정 등록하기</h2>
                <hr>
                <label for="query1">환자 ID</label>
                <input type="text" name="query1" id="query1" placeholder="환자 ID를 입력해 주세요" readonly>
                <button type="button" onclick="openPopup_patient()">환자 선택</button>
                <br><br>
                <label for="res_type">완료일정 타입</label>
                <label class="restype" for="treatment">진료</label>
                <input class="restype" type="radio" name="res_type" value="treatment" id="treatment" onclick="showSelectType(this.value)">
                <label class="restype" for="operation">수술</label> 
                <input class="restype" type="radio" name="res_type" value="operation" id="operation" onclick="showSelectType(this.value)"> 
                <label class="restype" for="examination">검사</label>
                <input class="restype" type="radio" name="res_type" value="examination" id="examination" onclick="showSelectType(this.value)"> 
                <label class="restype" for="hos_in">입원</label> 
                <input class="restype" type="radio" name="res_type" value="hos_in" id="hos_in" onclick="showSelectType(this.value)"> 
                <label class="restype" for="hos_out">퇴원</label>
                <input class="restype" type="radio" name="res_type" value="hos_out" id="hos_out" onclick="showSelectType(this.value)"> 
                <br><br>

                <div id="selectContainer">
                    <div id="selectType">
                        <!-- Default empty option -->
                    </div>
                    <label for="query">담당직원 ID (필수 입력)</label>
                    <input type="text" name="query" id="query" placeholder="담당직원 ID를 입력해 주세요" readonly>
                    <button type="button" onclick="openPopup_employee()">담당직원 선택</button>
                    <br><br>
                    <label for="room">방 ID</label>
                    <input type="text" name="room" placeholder="ex) R101" required>
                    <br><br>
                    <label for="date">완료일자</label>
                    <input type="datetime-local" name="date" required>
                    <br><br>
                </div>
                <br><br>

                

                <input type="submit" value="등록">
                <input type="reset" value="초기화">
        </form>

        <form name="searchForm" method="POST">
            
            <h2>완료일정 조회하기</h2>
            <hr>
            <label for="query11">환자 ID (입력하지 않으면 전체 조회)</label>
            <input type="text" name="query11" id="query11" placeholder="환자 ID를 입력해 주세요" readonly>
            <button type="button" onclick="openPopup_patient1()">환자 선택</button>
            <br><br>
            <label for="table">테이블 선택</label>
            <select name="table" required>
                <option value="Treatment">Treatment</option>
                <option value="Examination">Examination</option>
                <option value="Operation">Operation</option>
                <option value="Hospitalization">Hospitalization</option>
            </select>
            <br><br>
            <label for="start_date">시작일</label>
            <input type="datetime-local" name="start_date" required>
            <br><br>
            <label for="end_date">종료일</label>
            <input type="datetime-local" name="end_date" required>
            <br><br>
            <input type="submit" value="조회">
        </form>

        <hr>    
        <?php
            $con = mysqli_connect("localhost", "root", "", "hospital");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $query = isset($_POST['query11']) ? $_POST['query11'] : '';
                $table = $_POST["table"];
                $start_date = $_POST["start_date"];
                $end_date = $_POST["end_date"];

                $sql = "SELECT * FROM $table";
                if (!empty($query)) {
                    $sql .= " WHERE Patient_ID = ?";
                    if($table==='Hospitalization'){
                        $sql .= " AND Start_Date >= ? AND Start_Date <= ?";
                    }
                    else{
                        $sql .= " AND $table"."_Date >= ? AND $table"."_Date <= ?";
                    }
                } else {
                    if($table==='Hospitalization'){
                        $sql .= " WHERE Start_Date >= ? AND Start_Date <= ?";
                    }
                    else{
                        $sql .= " WHERE $table"."_Date >= ? AND $table"."_Date <= ?";
                    }
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
                    if ($table === "Treatment") {
                        echo "<th>Treatment ID</th>";
                        echo "<th>Treatment Detail</th>";
                        echo "<th>Treatment Date</th>";
                        echo "<th>Employee ID</th>";
                        echo "<th>Patient ID</th>";
                        echo "<th>Room ID</th>";
                        echo "<th>삭제</th>";
                    } elseif ($table === "Examination") {
                        echo "<th>Examination ID</th>";
                        echo "<th>Examination Detail</th>";
                        echo "<th>Examination Date</th>";
                        echo "<th>Employee ID</th>";
                        echo "<th>Patient ID</th>";
                        echo "<th>Room ID</th>";
                        echo "<th>Treatment ID</th>";
                        echo "<th>삭제</th>";
                    } elseif ($table === "Operation") {
                        echo "<th>Operation ID</th>";
                        echo "<th>Operation Detail</th>";
                        echo "<th>Operation Date</th>";
                        echo "<th>Employee ID</th>";
                        echo "<th>Patient ID</th>";
                        echo "<th>Room ID</th>";
                        echo "<th>Treatment ID</th>";
                        echo "<th>Examination ID</th>";
                        echo "<th>삭제</th>";
                    } else {
                        echo "<th>Hospitalization ID</th>";
                        echo "<th>Start Date</th>";
                        echo "<th>End Date</th>";
                        echo "<th>Employee ID</th>";
                        echo "<th>Patient ID</th>";
                        echo "<th>Room ID</th>";
                        echo "<th>Treatment ID</th>";
                        echo "<th>삭제</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        foreach ($row as $column) {
                            echo "<td>" . $column . "</td>";
                        }
                        if ($table === "Treatment"){
                            echo "<td><a href='finished_delete.php?userID=". $row['Treatment_ID']. "&type=". $table."'>삭제</a></td>";
                        } else if ($table === "Operation"){
                            echo "<td><a href='finished_delete.php?userID=". $row['Operation_ID']. "&type=". $table."'>삭제</a></td>";
                        } else if ($table === "Examination"){
                            echo "<td><a href='finished_delete.php?userID=". $row['Examination_ID']. "&type=". $table."'>삭제</a></td>";
                        } else{
                            echo "<td><a href='finished_delete.php?userID=". $row['Hospitalization_ID']. "&type=". $table."'>삭제</a></td>";
                        }  
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>해당 기간에 완료일정이 존재하지 않습니다.</p>";
                }
            }
        ?>
        
        <a href="병원관리시스템_Home.html" class="home-button">홈으로</a>
    </div>
</body>
</html>
