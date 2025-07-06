<?php
include("db.php");

$sql = "SELECT a.id, a.applicant_name, a.email, a.resume, a.applied_on, 
               j.title, j.company 
        FROM applications a 
        JOIN jobs j ON a.job_id = j.id
        ORDER BY a.applied_on DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Applications - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <span><strong>Job Portal - Admin</strong></span>
        <div>
            <a href="index.php">Home</a>
            <a href="post-job.php">Post Job</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <h2>All Job Applications</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="job-card">
                <h3><?= htmlspecialchars($row['applicant_name']) ?></h3>
                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                <p><strong>Applied for:</strong> <?= htmlspecialchars($row['title']) ?> at <?= htmlspecialchars($row['company']) ?></p>
                <p><strong>Resume:</strong><br><?= nl2br(htmlspecialchars($row['resume'])) ?></p>
                <p><strong>Applied On:</strong> <?= $row['applied_on'] ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">No applications found.</p>
    <?php endif; ?>
</body>
</html>
