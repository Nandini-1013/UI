<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "articles";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, author, date FROM articles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p><strong>By:</strong> " . htmlspecialchars($row['author']) . "</p>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
        echo "<a href='#' class='read-more'>Read More</a>";
        echo "</div>";
    }
} else {
    echo "<p>No articles found.</p>";
}

$conn->close();
?>
