<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// MySQL database credentials
$servername = $_ENV['MYSQL_HOST'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];
$database = $_ENV['MYSQL_DATABASE'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$sql = "USE MYSQLTEST";
if ($conn->query($sql) === FALSE) {
    die("Error selecting database: " . $conn->error);
}

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Add a record to the table
function addRecord($data) {
    global $conn;

    $name = $data['name'];
    $email = $data['email'];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Remove a record from the table
function removeRecord($id) {
    global $conn;

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Get all records from the table
function getAllRecords() {
    global $conn;

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $records = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }

    return $records;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the action parameter is set
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Perform the corresponding action
        if ($action === 'add') {
            // Call the addRecord function with the provided data
            $data = $_POST['data'];
            $result = addRecord($data);

            if ($result) {
                echo json_encode(array('message' => 'Record added successfully'));
            } else {
                echo json_encode(array('error' => 'Failed to add record'));
            }
        } elseif ($action === 'remove') {
            // Call the removeRecord function with the provided ID
            $id = $_POST['id'];
            $result = removeRecord($id);

            if ($result) {
                echo json_encode(array('message' => 'Record removed successfully'));
            } else {
                echo json_encode(array('error' => 'Failed to remove record'));
            }
        } else {
            echo json_encode(array('error' => 'Invalid action'));
        }
    } else {
        echo json_encode(array('error' => 'Action parameter is missing'));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET request to retrieve all records
    $records = getAllRecords();

    if (!empty($records)) {
        echo json_encode($records);
    } else {
        echo json_encode(array());
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}

// Close the database connection
$conn->close();
?>
