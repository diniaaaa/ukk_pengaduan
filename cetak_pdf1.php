<?php
include '../config/koneksi.php';
require('../fpdf/fpdf.php');

function hitungTinggi($pdf, $w, $txt, $h){
    $nb = 0;
    $lines = explode("\n", $txt);
    foreach ($lines as $line) {
        $nb += ceil($pdf->GetStringWidth($line) / $w);
    }
    return max($h, $nb * $h);
}


// ================= FILTER =================
$where = [];

if (!empty($_GET['keyword'])) {
    $key = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $where[] = "(a.nis LIKE '%$key%' 
              OR s.nama LIKE '%$key%' 
              OR a.lokasi LIKE '%$key%' 
              OR a.ket LIKE '%$key%')";
}

if (!empty($_GET['tgl'])) {
    $tgl = $_GET['tgl'];
    $where[] = "a.tanggal = '$tgl'";
}

if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    $where[] = "a.status = '$status'";
}

if (!empty($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $where[] = "a.id_kategori = '$kategori'";
}

$whereSQL = count($where) ? "WHERE ".implode(" AND ", $where) : "";

// ================= QUERY =================
$data = mysqli_query($koneksi, "
    SELECT 
        a.tanggal,
        a.nis,
        s.nama,
        k.ket_kategori,
        a.lokasi,
        a.ket,
        a.status,
        a.feedback
    FROM tb_aspirasi a
    JOIN tb_siswa s ON a.nis = s.nis
    JOIN tb_kategori k ON a.id_kategori = k.id_kategori
    $whereSQL
    ORDER BY a.tanggal DESC
");

// ================= PDF =================
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(5,10,5);

// Judul
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'LAPORAN DATA ASPIRASI SISWA',0,1,'C');
$pdf->Ln(4);

// ================= UKURAN KOLOM =================
$wNo   = 8;
$wTgl  = 22;
$wNis  = 20;
$wNama = 35;
$wKat  = 30;
$wLok  = 30;
$wKet  = 65;
$wStat = 22;
$wFb   = 55;

$h = 7;

// ================= HEADER =================
$pdf->SetFont('Arial','B',9);
$pdf->Cell($wNo,$h,'No',1);
$pdf->Cell($wTgl,$h,'Tanggal',1);
$pdf->Cell($wNis,$h,'NIS',1);
$pdf->Cell($wNama,$h,'Nama',1);
$pdf->Cell($wKat,$h,'Kategori',1);
$pdf->Cell($wLok,$h,'Lokasi',1);
$pdf->Cell($wKet,$h,'Keterangan',1);
$pdf->Cell($wStat,$h,'Status',1);
$pdf->Cell($wFb,$h,'Feedback',1);
$pdf->Ln();

// ================= ISI =================
$pdf->SetFont('Arial','',9);
$no = 1;

while ($row = mysqli_fetch_assoc($data)) {

    $fb = empty($row['feedback']) || $row['feedback']=='-' 
        ? 'Belum ada feedback' 
        : $row['feedback'];

    // HITUNG TINGGI BARIS TANPA CETAK
    $hKet = hitungTinggi($pdf,$wKet,$row['ket'],$h);
    $hFb  = hitungTinggi($pdf,$wFb,$fb,$h);
    $rowHeight = max($hKet,$hFb);

    // CETAK NORMAL
    $pdf->Cell($wNo,$rowHeight,$no++,1);
    $pdf->Cell($wTgl,$rowHeight,$row['tanggal'],1);
    $pdf->Cell($wNis,$rowHeight,$row['nis'],1);
    $pdf->Cell($wNama,$rowHeight,$row['nama'],1);
    $pdf->Cell($wKat,$rowHeight,$row['ket_kategori'],1);
    $pdf->Cell($wLok,$rowHeight,$row['lokasi'],1);

    // KETERANGAN
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell($wKet,$h,$row['ket'],1);
    $pdf->SetXY($x+$wKet,$y);

    $pdf->Cell($wStat,$rowHeight,$row['status'],1);

    // FEEDBACK
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell($wFb,$h,$fb,1);
}


$pdf->Output();
exit;
