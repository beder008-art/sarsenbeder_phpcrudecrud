<!doctype html>
<html>
`<head>
<meta charset="utf-8">
<title>Find Employee</title>
</head>

<body>
    <h2>Find an Employee Record</h2>
    <hr>

    <?php
    include 'credentials.php';  // Make sure this points to your credentials.php

    // Create MySQL connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("MySQL Connection Failed: " . $conn->connect_error);
    }
    echo "MySQL Connection Succeeded<br><br>";

    // Get lastname from form submission
    $lastname = $_GET['lastname'] ?? '';

    if ($lastname != '') {
        echo "Searching for: " . htmlspecialchars($lastname) . "<br><br>";

        // Use prepared statement for security
        $stmt = $conn->prepare("SELECT first_name, last_name FROM employees WHERE last_name = ?");
        $stmt->bind_param("s", $lastname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo "Employee: " . htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) . "<br>";
            }
        } else {
            echo "No Records Found";
        }

        $stmt->close();
    } else {
        echo "Please enter a last name to search.<br>";
    }

    $conn->close();
    ?>

    <hr>
    <!-- Search form -->
    <form method="get" action="findemployee.php">
        Last Name: <input type="text" name="lastname" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>


