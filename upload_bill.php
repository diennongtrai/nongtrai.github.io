<?php
$uploadDir = "uploads/";
if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES["file"]["tmp_name"];
    $filename = basename($_FILES["file"]["name"]);
    $target = $uploadDir . $filename;
    if (move_uploaded_file($tmpName, $target)) {
        echo json_encode(["status" => "ok", "path" => $target]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Move failed"]);
    }
} else {
    echo json_encode(["status" => "error", "code" => $_FILES["file"]["error"] ?? "no_file_sent"]);
}
?>