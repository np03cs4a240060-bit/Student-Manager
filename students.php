<?php
include 'header.php';

$filePath = __DIR__ . '/students.txt';

if (!file_exists($filePath) || filesize($filePath) === 0) {
    echo "<p>No students found.</p>";
    include 'footer.php';
    exit;
}

$students = file($filePath, FILE_IGNORE_NEW_LINES);
?>

<h2>Student List</h2>

<?php foreach ($students as $student): ?>
<?php
list($name, $email, $skills) = explode('|', $student);
$skillsArray = explode(',', $skills);
?>

<p>
<strong>Name:</strong> <?php echo $name; ?><br>
<strong>Email:</strong> <?php echo $email; ?>
</p>

<ul>
<?php foreach ($skillsArray as $skill): ?>
    <li><?php echo trim($skill); ?></li>
<?php endforeach; ?>
</ul>
<hr>

<?php endforeach; ?>

<?php include 'footer.php'; ?>
