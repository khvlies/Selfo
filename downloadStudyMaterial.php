<?php
if(isset($_GET['file_id'])) {
    $conn = new mysqli("localhost", "root", "", "selfodb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fileId = intval($_GET['file_id']);
    $sql = "SELECT file_name, file_path FROM study_material WHERE study_id = $fileId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file = $row['file_path'];

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    } else {
        echo "File not found.";
    }

    $conn->close();
}
?>
