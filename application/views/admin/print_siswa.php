<?php
$pdf = new FPDF("L", "cm", "F4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
// $pdf->Image('assets/img/aplikasi/logo.png', 2.5, 0.5, 3, 2.5);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "LAPORAN SISWA DITERIMA", 0, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "Tk Aba Al Amin Pasaranom", 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, 'Desa Pasaranom, Kec. Grabag, Kab. Purworejo, Prov. Jawa Tengah, Kode Pos 54265
', 0, 'C');
$pdf->Line(2, 3.1, 31, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(2, 3.2, 31, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->MultiCell(31, 0.7, "DATA SISWA ", 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(31, 0.7, '' . $ket . '', 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 0.6, "Di cetak pada : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Lengkap', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'No Telepon', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Jenis Kelamin', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Tempat Lahir', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Tanggal Lahir', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Agama', 1, 0, 'C');


$pdf->ln();

if (!empty($siswa_all)) {
    $no = 1;
    foreach ($siswa_all as $data) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(1, 0.6, $no++, 1, 0, 'C');
        $pdf->Cell(4, 0.6, $data->full_name, 1, 0, 'C');
        $pdf->Cell(3, 0.6, $data->no_tlp, 1, 0, 'C');
        $pdf->Cell(4.5, 0.6, $data->jenis_kelamin, 1, 0, 'C');
        $pdf->Cell(5, 0.6, $data->tempat_lahir, 1, 0, 'C');
        $pdf->Cell(5, 0.6, $data->tanggal_lahir, 1, 0, 'C');
        $pdf->Cell(5, 0.6, $data->agama, 1, 0, 'C');

        $pdf->ln();
    }
}
$pdf->Output("Laporan SPP Siswa.pdf", "I");
