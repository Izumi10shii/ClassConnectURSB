<?php
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

$Timestamp = date("Y-m-d H:i:s");
$User = "Username";
$Status = "Success";
$Description = "User logged in successfully.";


$Admin = "Admin";
$Email = "Admin@gmail.com";




// Title
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(189, 10, 'User Login Logs', 0, 1, 'C');

$pdf->Cell(189, 5, '', 0, 1, 'L');

$pdf->SetFillColor(230, 230, 230);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(189, 10, 'Audit Trail Information', 0, 1, 'L', true);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Report Generated By: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(129, 10, $Admin, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Generation Timestamp: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(129, 10, $Timestamp, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Administrator Email: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(129, 10, $Email, 0, 1, 'L');

$pdf->Cell(189, 10, '', 0, 1, 'L');




$pdf->SetFillColor(230, 230, 230);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(189, 10, 'Logs', 0, 1, 'L', true);

$pdf->Cell(189, 5, '', 0, 1, 'L');
// Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(45, 10, 'Timestamp', 1, 0, 'C', true);
$pdf->Cell(44, 10, 'User', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Status', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Description', 1, 1, 'C', true);

// Row data
$pdf->SetFont('Arial', '', 12);

// Save current X and Y
$x = $pdf->GetX();
$y = $pdf->GetY();
$lineHeight = 6;

// Print the first three columns (Timestamp, User, Status)
$pdf->SetXY($x, $y);
$pdf->Cell(45, $lineHeight, $Timestamp, 1, 0, 'C');
$pdf->Cell(44, $lineHeight, $User, 1, 0, 'C');
$pdf->Cell(40, $lineHeight, $Status, 1, 0, 'C');

// Now, print the Description (use MultiCell to allow wrapping)
$pdf->SetXY($x + 40 + 49 + 40, $y); // Move to the starting point of Description
$pdf->MultiCell(60, $lineHeight, $Description, 1, 'J');

// Calculate the height the Description has taken
$descHeight = $pdf->GetY() - $y; // How tall the Description cell became

// Reset Y position back to the start of the row for other cells
$pdf->SetXY($x, $y);
$pdf->Cell(45, $descHeight, $Timestamp, 1, 0, 'C');
$pdf->Cell(44, $descHeight, $User, 1, 0, 'C');
$pdf->Cell(40, $descHeight, $Status, 1, 0, 'C');

// Description is already printed with MultiCell

$pdf->Output();
