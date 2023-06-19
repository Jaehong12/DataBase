<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>담당직원 선택</title>
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
        <h1>담당직원 선택</h1>

        <?php
        $con = mysqli_connect("localhost", "root", "", "hospital");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employeeName = $_POST["employee_name"];

            $sql = "SELECT * FROM employee WHERE EName = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "s", $employeeName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Employee ID</th>";
                echo "<th>이름</th>";
                echo "<th>주민번호</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><a href=\"javascript:setEmployeeID('".$row['Employee_ID']."')\">" . $row['Employee_ID'] . "</a></td>";
                    echo "<td>" . $row['EName'] . "</td>";
                    echo "<td>" . $row['Personal_ID'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>일치하는 직원이 없습니다.</p>";
            }
        }
        ?>

        <form name="employeeForm" method="POST">
            <label for="employee_name">담당직원 이름</label>
            <input type="text" name="employee_name" placeholder="담당직원 이름을 입력하세요" required>
            <input type="submit" value="검색">
        </form>

        <a href="#" class="select-button" onclick="window.close();">닫기</a>
    </div>

    <script>
        function setEmployeeID(employeeID) {
            window.opener.document.getElementById('query').value = employeeID;
            window.close();
        }
    </script>
</body>
</html>
