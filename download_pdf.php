<?php
// include TCPDF library
session_start();

// establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodpicky_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// retrieve the orders for the logged-in user
$query = "SELECT * FROM users_orders WHERE u_id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);

require_once('TCPDF/tcpdf.php');

while ($row = mysqli_fetch_assoc($result)) {
  // get all orders for the current user
  $u_id = $row['u_id'];
  $query = "SELECT * FROM users_orders WHERE u_id = $u_id";
  $orders = mysqli_query($conn, $query);

  // create a new PDF object
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // set document properties
  $pdf->SetCreator('Your Company');
  $pdf->SetAuthor('Your Name');
  $pdf->SetTitle('Order History');
  $pdf->SetSubject('Order History');

  // add a page
  $pdf->AddPage();

  // set font and write the heading
  $pdf->SetFont('helvetica', 'B', 16);
  $pdf->Cell(0, 10, 'Order History for User ID '.$u_id, 0, 1);

  // set font and table headers
  $pdf->SetFont('helvetica', 'B', 12);
  $pdf->Cell(20, 10, 'Order ID', 1, 0);
  $pdf->Cell(60, 10, 'Title', 1, 0);
  $pdf->Cell(20, 10, 'Quantity', 1, 0);
  $pdf->Cell(30, 10, 'Price', 1, 0);
  $pdf->Cell(40, 10, 'Status', 1, 0);
  $pdf->Cell(40, 10, 'Date', 1, 1);

  // set font for the table content
  $pdf->SetFont('helvetica', '', 12);

  // loop through each order and add it to the table
  while ($order = mysqli_fetch_assoc($orders)) {
    $pdf->Cell(20, 10, $order['o_id'], 1, 0);
    $pdf->Cell(60, 10, $order['title'], 1, 0);
    $pdf->Cell(20, 10, $order['quantity'], 1, 0);
    $pdf->Cell(30, 10, $order['price'], 1, 0);
    $pdf->Cell(40, 10, $order['status'], 1, 0);
    $pdf->Cell(40, 10, $order['date'], 1, 1);
  }

  // output the PDF as a download
  $pdf->Output('Order History for User ID '.$u_id.'.pdf', 'D');
}

?>