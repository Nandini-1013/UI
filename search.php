<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "articles";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';


$sql = "SELECT id, title, author, date FROM articles WHERE title LIKE '%$query%' OR content LIKE '%$query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul class="nav-links">
            <li><a href="#">Events</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">AppAssessor</a></li>
            <li><a href="#">Salesforce News</a></li>
            <li><a href="#">Articles</a></li>
        </ul>
    </nav>

    <form class="search-form" method="GET" action="search.php">
        <input type="text" name="query" placeholder="Search..." value="<?php echo htmlspecialchars($query); ?>">
        <button type="submit">Search</button>
    </form>

    <div class="search-results">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='article'>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<p>By: " . htmlspecialchars($row['author']) . "</p>";
                echo "<p>Date: " . $row['date'] . "</p>";
                echo "<a href='article.php?id=" . $row['id'] . "'>Read More</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found for your search query.</p>";
        }
        ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
