<?php
session_start();
include("db.php");

// Fetch jobs from database
$jobs = [];
$sql = "SELECT * FROM jobs ORDER BY posted_on DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Portal - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <span><strong>Job Portal</strong></span>
        <div>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <?php if (isset($_SESSION["user_id"])): ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </div>
    </div>

    <h2>Latest Job Listings</h2>

    <?php if (count($jobs) > 0): ?>
        <?php foreach ($jobs as $job): ?>
            <div class="job-card">
                <img src="images/job-icon.png" alt="Job Icon" style="width:60px;height:60px;float:right;margin-left:10px;">
<img src="images/job<?= $job['id'] % 4 + 1 ?>.png" alt="Job Image" class="job-img">
<h3><?= htmlspecialchars($job['title']) ?></h3>


                <p><strong>Company:</strong> <?= htmlspecialchars($job['company']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                <p><strong>Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>
                <p><strong>Salary:</strong> ₹<?= htmlspecialchars($job['salary']) ?></p>
                <a class="btn" href="apply.php?job_id=<?= $job['id'] ?>">Apply Now</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">No jobs available yet.</p>
    <?php endif; ?>

    <footer>
        <p>© 2025 Job Portal. All rights reserved.</p>
    </footer>
</body>
</html>
