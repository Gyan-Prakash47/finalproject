<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title     = $_POST["title"];
    $company   = $_POST["company"];
    $location  = $_POST["location"];
    $job_type  = $_POST["job_type"];
    $salary    = $_POST["salary"];
    $description = $_POST["description"];

    $sql = "INSERT INTO jobs (title, company, location, job_type, salary, description) 
            VALUES ('$title', '$company', '$location', '$job_type', '$salary', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Job posted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Job - Job Portal</title>
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

    <form method="POST">
        <h2>Post a New Job</h2>
        <input type="text" name="title" placeholder="Job Title" required>
        <input type="text" name="company" placeholder="Company Name" required>
        <input type="text" name="location" placeholder="Job Location" required>
        <input type="text" name="job_type" placeholder="Job Type (e.g., Full-Time)" required>
        <input type="text" name="salary" placeholder="Salary (e.g., 25000/month)" required>
        <textarea name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button>
    </form>
</body>
</html>
