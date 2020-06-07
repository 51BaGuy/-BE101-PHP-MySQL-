<?php
require_once('./conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job board 職缺報報</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Job board 職缺報報</h1>
        <a href="./admin.php">讓我去後台</a>
        <div class="jobs">
            <?php
            $sql = "SELECT * FROM jobs ORDER BY created_at DESC";
            $result = $conn->query($sql);
            // 如果有取到結果的意思
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='job'>";
                    echo "<h2 class='job_title'>" . $row['title'] . "</h2>";
                    echo "<p class='job_desc'>" . $row['description'] . "</p>";
                    echo "<p class='job_salary'>" . $row['salary'] . "</p>";
                    echo "<a class='job_link' href='#'>" . $row['link'] . "</a>";
                    echo "</div>";
                }
            }
            ?>
        </div>

</body>

</html>