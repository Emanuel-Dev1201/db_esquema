<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../src/libs/fpdf.php';
require_once __DIR__ . '/../../src/models/Persona.php';

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Personas', 0, 1, 'C');
$pdf->Ln(5);

// Encabezados
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(40, 10, 'Apellido', 1);
$pdf->Cell(40, 10, 'Telefono', 1);
$pdf->Cell(60, 10, 'Email', 1);
$pdf->Ln();

// Datos
$pdf->SetFont('Arial', '', 12);
foreach ($personas as $p) {
    $pdf->Cell(10, 10, $p['id'], 1);
    $pdf->Cell(40, 10, utf8_decode($p['nombre']), 1);
    $pdf->Cell(40, 10, utf8_decode($p['apellido']), 1);
    $pdf->Cell(40, 10, $p['telefono'], 1);
    $pdf->Cell(60, 10, utf8_decode($p['email']), 1);
    $pdf->Ln();
}

$pdf->Output();
