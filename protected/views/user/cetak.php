<?php
Yii::import('application.extensions.fpdf.*');
require_once("fpdf.php");

// cell use A4 210
// left indent 25 right 15 top bottom 15
// $pdf = new FPDF();
$pdf = new fpdf('A4','P','mm');
$pdf->AddPage();
$pdf->setMargins(25, 25, 15);

$pdf->setX(25);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(170,6,'Formulir Penggunaan Ruangan',0,1,'C');
$pdf->ln();

$pdf->SetFont('Arial','',12);
$pdf->Cell(170,6,'A. PERMOHONAN',0,1,'L');

$pdf->setLeftMargin(30);
$pdf->Cell(50,6,'Dari',0,0,'L');
$pdf->Cell(120,6,': '.$model->dari,0,1,'L');

$pdf->Cell(50,6,'Kepada',0,0,'L');
$pdf->Cell(120,6,': Kepala Bagian Tata Usaha',0,1,'L');

$pdf->Cell(50,6,'Kegiatan',0,0,'L');
$pdf->Cell(120,6,': '.$model->mata_kuliah,0,1,'L');

$pdf->Cell(50,6,'Jumlah Peserta',0,0,'L');
$pdf->Cell(120,6,': '.number_format($model->jumlah_peserta, 0, ',',  '.'),0,1,'L');

$pdf->Cell(50,6,'Waktu',0,0,'L');
$firstDay = $event[0]['tanggal_guna'];
$lastDay = end($event)['tanggal_guna'];
$days = date('d-m-Y', strtotime($firstDay)) . " s.d " . date('d-m-Y', strtotime($lastDay));
if($firstDay == $lastDay) $days = date('d-m-Y', strtotime($firstDay));
$pdf->Cell(120,6,': '. $days,0,1,'L');

$pdf->Cell(50,6,'Ruangan',0,0,'L');
$pdf->Cell(120,6,': '.$model->kelas->kelas,0,1,'L');

$pdf->Cell(50,6,'Penanggung Jawab',0,0,'L');
$pdf->Cell(120,6,': '.$model->penanggung_jawab,0,1,'L');

$pdf->Cell(50,6,'Lain-Lain',0,0,'L');
$konsumsi = $model->konsumsi == 1 ? "Konsumsi" : "Tidak Konsumsi";
$pdf->Cell(120,6,': '.$konsumsi,0,1,'L');

$pdf->Cell(50,6,'TOR/KAK',0,0,'L');
$torKak = $model->tor_kak == 1 ? "Ada" : "Tidak Ada";
$pdf->Cell(120,6,': '.$torKak,0,1,'L');

$pdf->setLeftMargin(120);
$pdf->setY($pdf->getY()+6);
$pdf->Cell(50,6,'Banda Aceh, '.date('d M Y', strtotime($model->DateCreate)),0,1,'L');
$pdf->Cell(50,6,'Pemohon',0,1,'L');

$pdf->setY($pdf->getY()+18);
$pdf->Cell(50,6, $model->yang_mengajukan,0,1,'L');


$pdf->setXY(25, $pdf->getY()+12);
$pdf->setLeftMargin(25);
$pdf->Cell(170,6,'B. PERSETUJUAN',0,1,'L');

$pdf->setLeftMargin(30);
$pdf->Cell(120,6,'Setuju / Tidak Setuju',0,1,'L');
$pdf->Cell(50,6,'Ruang yang digunakan',0,0,'L');
$pdf->Cell(120,6,': ',0,1,'L');

$pdf->Cell(50,6,'Konsumsi',0,0,'L');
$pdf->Cell(120,6,': Setuju / Tidak Setuju',0,1,'L');

$pdf->setLeftMargin(120);
$pdf->setY($pdf->getY()+6);
$model->approval_date = $model->approval_date ?? date('Y-m-d');
$pdf->Cell(50,6,'Banda Aceh, '.date('d M Y', strtotime($model->approval_date)),0,1,'L');
$pdf->Cell(50,6,'Menyetujui,',0,1,'L');
$pdf->Cell(50,6,'Kepala Bagian Tata Usaha',0,1,'L');

$pdf->setY($pdf->getY()+18);
$pdf->Cell(50,6, $model->approver ?? '...................................',0,1,'L');

$pdf->setXY(25, $pdf->getY()+12);
$pdf->setLeftMargin(25);
$pdf->Cell(170,6,'Catatan: Kepala Bagian Tata Usaha',0,1,'L');
$pdf->Cell(170,6, $model->catatan,0,1,'L');

$pdf->Output();
// Yii::app()->end();
?>