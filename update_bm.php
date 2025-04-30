<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the JSON input
  $data = json_decode(file_get_contents('php://input'), true);

  $bmid = $data['bmid'];
  $lastName = $data['last_name'];
  $givenName = $data['given_name'];
  $middleName = $data['middle_name'];
  $sex = $data['sex'];
  $address = $data['address'];
  $destination = $data['destination'];
  $remarks = $data['remarks'];

  try {
    // Prepare the update SQL query
    $sql = "UPDATE BM SET last_name = ?, given_name = ?, middle_name = ?, sex = ?, address = ?, destination = ?, remarks = ? WHERE bmid = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lastName, $givenName, $middleName, $sex, $address, $destination, $remarks, $bmid]);

    echo json_encode(['status' => 'success']);
  } catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  }
}
?>
