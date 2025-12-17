<?php include 'header.php'; ?>

<?php 
$serverMethod = $_SERVER['REQUEST_METHOD'] === "POST";
$isUploadClicked = isset($_POST['uploadbtn']);

if ($serverMethod && $isUploadClicked && isset($_FILES['portfoliofile'])) {

    try {
        $file = $_FILES['portfoliofile'];

        $filename = $file['tmp_name'];
        $filetype = $file['type'];
        $filesize = $file['size'];

        if (!in_array($filetype, ["application/pdf", "image/png", "image/jpeg"])) {
            throw new Exception("File type not matched");
        }

        if ($filesize > 2 * 1024 * 1024) {
            throw new Exception("File size exceeded (Max 2MB)");
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = "portfolio_" . time() . "." . $extension;

        $destination = __DIR__ . '/uploads/' . $newName;

        if (!move_uploaded_file($filename, $destination)) {
            throw new Exception("Unable to save file");
        }

        echo "<br><h3 style='color:green'>File upload successful!</h3>";

    } catch (Exception $e) {
        echo "<p style='color:red'>" . $e->getMessage() . "</p>";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="portfoliofile" accept=".png,.jpg,.jpeg,.pdf" required>
    <button type="submit" name="uploadbtn">Upload File</button>
</form>

<?php include 'footer.php'; ?>
