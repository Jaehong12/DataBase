<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>환자 등록</title>
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
</head>
<body>
    <div class="container">
        <h1>환자 등록 및 조회</h1>
        <form method="POST" action="./patient_enroll.php">
            <h2>환자 등록하기</h2>
            <hr>
            <label for="name">성명</label>
            <input type="text" name="name" placeholder="영어로 입력해 주세요" required>
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
            <h2>환자 조회하기</h2>
            <hr>
            <label for="query">성명</label>
            <input type="text" name="query" placeholder="영어로 입력해 주세요" required>
            
            <input type="submit" value="조회">
        </form>      
        <hr>
        <!-- 데이터베이스에서 가져온 환자 정보 출력 -->
        <?php
        $con = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM Patient";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Patient ID</th>";
            echo "<th>Patient Name</th>";
            echo "<th>Personal ID</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Address</th>";
            echo "<th>삭제</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $input = $_POST["query"];
            $ret = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($ret)) {
                if ($input === $row['PName']) {
                    echo "<tr>";
                    echo "<td>", $row['Patient_ID'], "</td>";
                    echo "<td>", $row['PName'], "</td>";
                    echo "<td>", $row['Personal_ID'], "</td>";
                    echo "<td>", $row['PNumber'], "</td>";
                    echo "<td>", $row['Address'], "</td>";
                    echo "<td><a href='patient_delete.php?userID=". $row['Patient_ID']. "'>삭제</a></td>";
                    echo "</tr>";
                }
            }                 
        }
        echo "</tbody>";
        echo "</table>";
        ?>

        <a href="병원관리시스템_Home.html" class="home-button">홈으로</a>
    </div>
</body>
</html>
