<?php
    include_once("connect.php");
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>인사관리</title>
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
                margin-bottom: 10px;
                font-weight: bold;
            }
            
            input[type="text"]{
                width: 97%;
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            input[type="submit"],
            input[type="reset"] {
                width: 100%;
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }
            
            input[type="submit"],
            input[type="reset"] {
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
            function showSelectType(job) {
                var selectContainer = document.getElementById("selectContainer");
                var selectType = document.getElementById("selectType");

                if (job === "Doctor") {
                selectContainer.style.display = "block";
                selectType.innerHTML = `
                    <option value="">Department</option>
                    <option value="Thoracic Surgery">Thoracic Surgery</option>
                    <option value="Cardiac Surgery">Cardiac Surgery</option>
                    <option value="Endocrine Surgery">Endocrine Surgery</option>
                    <option value="Plastic Surgery">Plastic Surgery</option>
                    <option value="Gastrointestinal Surgery">Gastrointestinal Surgery</option>
                    <option value="Laboratory Medicine">Laboratory Medicine</option>
                `;
                } else if (job === "Nurse") {
                selectContainer.style.display = "block";
                selectType.innerHTML = `
                    <option value="">Department</option>
                    <option value="Thoracic Surgery">Thoracic Surgery</option>
                    <option value="Cardiac Surgery">Cardiac Surgery</option>
                    <option value="Endocrine Surgery">Endocrine Surgery</option>
                    <option value="Plastic Surgery">Plastic Surgery</option>
                    <option value="Gastrointestinal Surgery">Gastrointestinal Surgery</option>
                    <option value="Laboratory Medicine">Laboratory Medicine</option>
                `;
                } else if (job === "Office Staff") {
                selectContainer.style.display = "block";
                selectType.innerHTML = `
                    <option value="">Department</option>
                    <option value="Administration Office">Administration Office</option>
                `;
                } else if (job === "Radiologic Technologist") {
                selectContainer.style.display = "block";
                selectType.innerHTML = `
                    <option value="">Department</option>
                    <option value="Radiology Department">Radiology Department</option>
                `;
                } else {
                selectContainer.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <h1>직원 등록 및 조회</h1>
            <form method="POST" action="./emp_enroll.php">
                <h2>직원 등록하기</h2>
                <hr>
                <label for="name">성명</label>
                <input type="text" name="name" placeholder="영어로 입력해 주세요" required>
                <br><br>

                <label for="job">직책</label>
                <label class="restype" for="Doctor">Doctor</label>
                <input class="restype" type="radio" name="job" value="Doctor" id="Doctor" onclick="showSelectType(this.value)">
                <label class="restype" for="Nurse">Nurse</label> 
                <input class="restype" type="radio" name="job" value="Nurse" id="Nurse" onclick="showSelectType(this.value)"> 
                <label class="restype" for="Office Staff">Office Staff</label>
                <input class="restype" type="radio" name="job" value="Office Staff" id="Office Staff" onclick="showSelectType(this.value)"> 
                <label class="restype" for="Radiologic Technologist">Radiologic Technologist</label>
                <input class="restype" type="radio" name="job" value="Radiologic Technologist" id="Radiologic Technologist" onclick="showSelectType(this.value)"> 
                <br><br>

                
                <div id="selectContainer">
                    <label>소속 과</label>
                    <label for="selectType"></label>
                    <select name="department" id="selectType" >
                    <!-- Default empty option -->
                    </select>
                </div>
                <br><br>
                
                <label for="jumin">주민등록번호</label>
                <input type="text" name="jumin" placeholder="'-' 없이 입력해 주세요" required>
                <br><br>
                <label for="phone">전화번호</label>
                <input type="text" name="phone" placeholder="'-' 없이 입력해 주세요" required>
                <br><br>
                <label for="address">주소</label>
                <input type="text" name="address" placeholder="영어로 입력해 주세요" required>
                
                <input type="submit" value="등록">
                <input type="reset" value="초기화">
            </form>
            
            <form name="searchForm" method="POST">
                <h2>직원 조회하기</h2>
                <hr>
                <label for="query">성명</label>
                <input type="text" name="query" placeholder="영어로 입력해 주세요" required>
                
                <input type="submit" value="조회">
            </form>           
            <hr>
            <!-- 데이터베이스에서 가져온 직원 정보 출력 -->
            <?php
            $con = mysqli_connect("localhost", "root", "", "hospital");
            $sql = "SELECT * FROM Employee";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = $_POST["query"];

                $ret = mysqli_query($con, $sql);
                $count=0;
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Employee ID</th>";
                echo "<th>Department ID</th>";
                echo "<th>Employee Name</th>";
                echo "<th>Position ID</th>";
                echo "<th>Personal ID</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Address</th>";
                echo "<th>삭제</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($ret)) {
                    if ($input === $row['EName']) {
                        echo "<tr>";
                        echo "<td>", $row['Employee_ID'], "</td>";
                        echo "<td>", $row['Department_ID'], "</td>";
                        echo "<td>", $row['EName'], "</td>";
                        echo "<td>", $row['Position_ID'], "</td>";
                        echo "<td>", $row['Personal_ID'], "</td>";
                        echo "<td>", $row['ENumber'], "</td>";
                        echo "<td>", $row['Address'], "</td>";
                        echo "<td><a href='emp_delete.php?userID=". $row['Employee_ID']. "'>삭제</a></td>";
                        echo "</tr>";
                        $count=1;
                    }
                }
                echo "</tbody>";
                echo "</table>";
            }
            ?>

            <a href="병원관리시스템_Home.html" class="home-button">홈으로</a>
        </div>
    </body>
</html>
