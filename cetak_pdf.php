<?php
include '../config/koneksi.php';
require('../fpdf/fpdf.php');

$nis = $_GET['nis'];

$data = mysqli_query($koneksi, "
    SELECT 
        a.tanggal,
        k.ket_kategori,
        a.lokasi,
        a.ket,
        a.status,
        a.feedback
    FROM tb_aspirasi a
    JOIN tb_kategori k ON a.id_kategori = k.id_kategori
    WHERE a.nis = '$nis'
    ORDER BY a.tanggal DESC
");

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'LAPORAN ASPIRASI SISWA',0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,8,'NIS : '.$nis,0,1);

$pdf->Ln(3);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,8,'No',1);
$pdf->Cell(25,8,'Tanggal',1);
$pdf->Cell(40,8,'Kategori',1);
$pdf->Cell(35,8,'Lokasi',1);
$pdf->Cell(80,8,'Keterangan',1);
$pdf->Cell(30,8,'Status',1);
$pdf->Cell(60,8,'Feedback',1);
$pdf->Ln();

$pdf->SetFont('Arial','',9);
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
    $pdf->Cell(10,8,$no++,1);
    $pdf->Cell(25,8,$row['tanggal'],1);
    $pdf->Cell(40,8,$row['ket_kategori'],1);
    $pdf->Cell(35,8,$row['lokasi'],1);
    $pdf->Cell(80,8,$row['ket'],1);
    $pdf->Cell(30,8,$row['status'],1);
    $pdf->Cell(60,8,$row['feedback'],1);
    $pdf->Ln();
}

$pdf->Output();


