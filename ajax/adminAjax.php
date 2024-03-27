<?php
// Include database configuration file
require_once "../server/configure.php";

// Query to fetch user count
$sqlUser = "SELECT COUNT(username) as totalUser FROM USER";
$statementUser = $pdo->prepare($sqlUser);
$statementUser->execute();
$rowUser = $statementUser->fetch(PDO::FETCH_ASSOC);
$totalUser = $rowUser["totalUser"];

// Query to fetch post count
$sqlPost = "SELECT COUNT(title) as totalPost FROM POSTS";
$statementPost = $pdo->prepare($sqlPost);
$statementPost->execute();
$rowPost = $statementPost->fetch(PDO::FETCH_ASSOC);
$totalPost = $rowPost["totalPost"];

// Prepare data to be sent as JSON
$data = array(
    'totalUser' => $totalUser,
    'totalPost' => $totalPost
);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
exit;
?>
