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

<div style="border:1px solid #ccc; padding:15px; margin-bottom:15px; background:#f9f9f9;">
    <p>
        <strong>Name:</strong> <?php echo $name; ?><br>
        <strong>Email:</strong> <?php echo $email; ?><br>
        <strong>Skills:</strong> <?php echo implode(', ', array_map('trim', $skillsArray)); ?>
    </p>
</div>

<?php endforeach; ?>

<?php include 'footer.php'; ?>
