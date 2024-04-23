<?php

namespace App\Libraries;

use FPDF;
use Illuminate\Support\Carbon;

class PDF extends FPDF
{
    function BookTable($header, $data)
    {
        $mytime = Carbon::now()->format('d - M - Y');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 0, $mytime, 0, 1, 'L');
        $this->Image(public_path('assets/img/logo-book.png'), 95, 10, 20, 20);

        // Judul Laporan
        $this->SetY(30); 
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Laporan Buku', 0, 1, 'C');
        $this->Cell(0, 10, 'Reading a Book', 0, 1, 'C');
        
        // Jeda antara gambar dan tabel
        $this->Ln(10); // Sesuaikan jaraknya sesuai kebutuhan
    
        $this->setX(20);
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(173, 216, 230); // Warna latar belakang untuk header
        $this->SetTextColor(0);
        $this->Cell(10, 13, 'No', 1, 0, 'C');
        // Header Tabel
        foreach($header as $col)
            $this->Cell(30, 13, $col, 1, 0, 'C');
        $this->Ln();
    
        // Data Tabel
        $count = 1;
        foreach ($data as $row) {
            $this->setX(20);
            
            $this->SetFont('Arial', '', 12);
            $this->Cell(10, 35, $count++, 1, 0, 'C'); 
            $this->Cell(30, 35, $row[0], 1, 0, 'C'); // Judul
            $this->Cell(30, 35, $row[1], 1, 0, 'C'); // Penulis
            $this->Cell(30, 35, $row[2], 1, 0, 'C'); 
             $this->Cell(30, 35, '', 1); // Buat sel kosong dengan border
            $this->Image(public_path($row[3]), $this->GetX()-25, $this->GetY() + 2, 20, 30);// Kategori
            $this->Ln(); // Next row
        }
    }
}
