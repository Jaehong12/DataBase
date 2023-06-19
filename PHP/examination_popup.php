<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검사 선택</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            margin-top: 0;
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
        
        .select-button {
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
        <h1>검사 선택</h1>

        <?php
        $con = mysqli_connect("localhost", "root", "", "hospital");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $patientID = $_POST['patient_id']; 

            $sql = "SELECT * FROM examination WHERE Patient_ID = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "s", $patientID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Examination ID</th>";
                echo "<th>Examination Detail</th>";
                echo "<th>검사 일자</th>";
                echo "<th>Patient ID</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><a href=\"javascript:setPatientID('".$row['Examination_ID']."')\">" . $row['Examination_ID'] . "</a></td>";
                    echo "<td>" . $row['Examination_Detail'] . "</td>";
                    echo "<td>" . $row['Examination_Date'] . "</td>";
                    echo "<td>" . $row['Patient_ID'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>일치하는 검사가 없습니다.</p>";
            }
        }
        ?>

        <form name="patientForm" method="POST">
            <label for="patient_id">환자 ID</label>
            <input type="text" name="patient_id" placeholder="환자 ID를 입력하세요" required>
            <input type="submit" value="검색">
        </form>

        <a href="#" class="select-button" onclick="window.close();">닫기</a>
    </div>

    <script>
        function setPatientID(patientID) {
            window.opener.document.getElementById('query3').value = patientID;
            window.close();
        }
    </script>
</body>
</html>
