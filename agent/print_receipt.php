<?php

require_once '../fpdf/fpdf.php';

class PDF extends FPDF {

// Page header
    function Header() {
        // Logo
        $this->Image('../fpdf/logo.png', 10, 3, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Skylink Rent Payment Receipt', 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// Instanciation of inherited class

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);


$fname = $_POST['fname'];
$natid = $_POST['natid'];
$plot_id = $_POST['plot_id'];
$house_id = $_POST['house_id'];
$amount = $_POST['amount'];
$rent_due = $_POST['rent_due'];
$month = $_POST['month_paid_for']; //
$time = $_POST['time_paid']; //
$agent = $_POST['agent']; //

$pdf->Cell(1, 8, 'Tenant\'s Full name:              ' . $fname, 0, 1);
$pdf->Cell(1, 8, 'Tenant\'s ID:                            ' . $natid, 0, 1);
$pdf->Cell(1, 8, 'Plot Number:                              ' . $plot_id, 0, 1);
$pdf->Cell(0, 8, 'House number:                            ' . $house_id, 0, 1);
$pdf->Cell(0, 8, 'Amount Paid:                           ' . $amount . ' /=', 0, 1);
$pdf->Cell(0, 8, 'Rent due:                                    ' . $rent_due . ' /=', 0, 1);
$pdf->Cell(0, 8, 'Month paid for:                       ' . $month, 0, 1);
$pdf->Cell(0, 8, 'Date and time of payment:     ' . $time, 0, 1);
$pdf->Cell(0, 8, 'Served by:                               ' . $agent, 0, 1);


$pdf->Output();
