<!DOCTYPE html>
<html>
<head>
    <title>Northland Analytics PHP/MySQL Test Page</title>
</head>
<body>
    <h1>Northland Analytics PHP/MySQL Test Page</h1>
    <p>Database Records Found</p>

    <?php
    // this is the php object oriented style of creating a mysql connection
    $conn = new mysqli('localhost', 'berth159', 'Banque2308!', 'employees');

    // check for connection success
    if ($conn->connect_error) {
        die("MySQL Connection Failed: " . $conn->connect_error);
    }

    // create the SQL select statement
    $sql = "SELECT first_name, last_name, hire_date FROM employees";
    $result = $conn->query($sql);

    // print results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Employee: " . $row["first_name"] . " " . $row["last_name"] .
                 " | Hire Date: " . $row["hire_date"] . "<br>";
        }
    } else {
        echo "No Records Found";
    }

    // close the connection
    $conn->close();
    ?>

    <p>
        For more information on connecting PHP to MySQL,
        <a href="https://www.php.net/manual/en/book.mysqli.php" target="_blank">
        click here</a>.
    </p>
</body>
</html>

