<?php
include("db.php");

$job_id = isset($_GET["job_id"]) ? intval($_GET["job_id"]) : 0;
$job = null;

if ($job_id > 0) {
    $result = $conn->query("SELECT * FROM jobs WHERE id = $job_id");
    if ($result && $result->num_rows > 0) {
        $job = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_name = $_POST["applicant_name"];
    $email = $_POST["email"];
    $resume = $_POST["resume"];

    $sql = "INSERT INTO applications (job_id, applicant_name, email, resume)
            VALUES ($job_id, '$applicant_name', '$email', '$resume')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Application submitted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Job</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <span><strong>Job Portal</strong></span>
        <div>
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <?php if ($job): ?>
    <form method="POST">
        <h2>Apply for <?= htmlspecialchars($job['title']) ?> at <?= htmlspecialchars($job['company']) ?></h2>
        <input type="text" name="applicant_name" placeholder="Your Full Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="resume" placeholder="Paste Resume or Cover Letter" required></textarea>
        <button type="submit">Submit Application</button>
    </form>
    <?php else: ?>
        <p style="text-align:center; color:red;">Invalid Job ID or job no longer exists.</p>
    <?php endif; ?>
</body>
</html>
