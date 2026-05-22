<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$email = trim($data['email'] ?? '');

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $file = 'emails.csv';
    $line = [date('Y-m-d H:i:s'), $email, 'realprize', $_SERVER['REMOTE_ADDR']];
    
    $fp = fopen($file, 'a');
    fputcsv($fp, $line);
    fclose($fp);
    
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>