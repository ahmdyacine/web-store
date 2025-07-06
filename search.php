<?php
include 'mydb.php'; // This should define $conn
session_start();
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $search = htmlspecialchars($_GET['query']);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "mystoredb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM products WHERE productName LIKE ?");
    $like = "%" . $search . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display results
    if ($result->num_rows > 0) {
        echo "<h2>Search Results:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . htmlspecialchars($row['productName']) . "</p>";
        }
    } else {
        echo "<p>No results found for: <strong>" . $search . "</strong></p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Please enter a search term.";
}
?>
