<?php
include 'header.php';

$nameErr = $emailErr = $skillErr = "";
$name = $email = $skills = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // NAME
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = trim($_POST["name"]);
    }

    // EMAIL
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = trim($_POST["email"]);
    }

    // SKILLS
    if (empty($_POST["skills"])) {
        $skillErr = "Skills are required";
    } else {
        $skills = trim($_POST["skills"]);
        $skillsArray = explode(",", $skills);
    }

    // SAVE DATA
    if (empty($nameErr) && empty($emailErr) && empty($skillErr)) {
        $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . "\n";
        file_put_contents("students.txt", $data, FILE_APPEND);
        echo "<p style='color:green'>Student added successfully</p>";
    }
}
?>

<form method="post">
    <input type="text" name="name" placeholder="Enter name">
    <span style="color:red"><?php echo $nameErr; ?></span><br><br>

    <input type="email" name="email" placeholder="Enter email">
    <span style="color:red"><?php echo $emailErr; ?></span><br><br>

    <input type="text" name="skills" placeholder="Comma separated skills">
    <span style="color:red"><?php echo $skillErr; ?></span><br><br>

    <button type="submit">Add Student</button>
</form>

<?php include 'footer.php'; ?>
 