<?php
require_once('fpdf/fpdf.php');

// Data dari database
include 'config.php';
$stmt = $pdo->query("SELECT c.name AS country, g.name AS group_name, c.menang, c.seri, c.kalah, c.poin FROM countries c LEFT JOIN groups g ON c.group_id = g.id");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Extend FPDF untuk membuat custom header dan footer
class PDF extends FPDF {

    // Set header
    function Header() {
        // Title
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Data Negara UEFA 2024',0,1,'C');
        
        // Line break
        $this->Ln(10);

        // Additional text
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Data Group B',0,1,'C');
        $this->Cell(0,10,'Per ' . date('d/m/Y H:i:s'),0,1,'C');
        $this->Cell(0,10,'211011401955',0,1,'C');

        // Table header
        $this->SetFont('Arial','B',10);
        $this->Cell(45,10,'Tim',1,0,'C');
        $this->Cell(45,10,'Grup',1,0,'C');
        $this->Cell(20,10,'Menang',1,0,'C');
        $this->Cell(20,10,'Seri',1,0,'C');
        $this->Cell(20,10,'Kalah',1,0,'C');
        $this->Cell(20,10,'Poin',1,1,'C');
    }

    // Set data
    function setData($data) {
        // Content
        $this->SetFont('Arial','',10);
        foreach($data as $row) {
            $this->Cell(45,10,$row['country'],1,0,'L');
            $this->Cell(45,10,$row['group_name'],1,0,'L');
            $this->Cell(20,10,$row['menang'],1,0,'C');
            $this->Cell(20,10,$row['seri'],1,0,'C');
            $this->Cell(20,10,$row['kalah'],1,0,'C');
            $this->Cell(20,10,$row['poin'],1,1,'C');
        }
    }
}

// Buat objek PDF
$pdf = new PDF();

// Set informasi dokumen
$pdf->SetTitle('Data Negara UEFA 2024');
$pdf->SetAuthor('UEFA 2024');
$pdf->SetSubject('Data Negara UEFA 2024');
$pdf->SetKeywords('UEFA, 2024, data, PDF');

// Tambahkan halaman
$pdf->AddPage();

// Set data ke PDF
$pdf->setData($data);

// Output PDF ke browser
$pdf->Output('data_negara_uefa_2024.pdf', 'I');
?>
