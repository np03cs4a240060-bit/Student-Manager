<?php
function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(',', $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $skills = implode(' | ', $skillsArray);
    $line = "$name,$email,$skills" . PHP_EOL;
    file_put_contents(__DIR__ . '/students.txt', $line, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    if ($file['error'] !== 0) {
        throw new Exception("Upload error");
    }

    $allowed = ['pdf', 'jpg', 'png'];
    $maxSize = 2 * 1024 * 1024;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File too large");
    }

    if (!is_dir('uploads')) {
        throw new Exception("Uploads folder missing");
    }

    $newName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $file['name']);
    $destination = 'uploads/' . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("File upload failed");
    }

    return $newName;
}