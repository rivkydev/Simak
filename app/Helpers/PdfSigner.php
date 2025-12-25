<?php

namespace App\Helpers;

use setasign\Fpdi\Fpdi;

class PdfSigner
{
    /**
     * Menambahkan tanda tangan digital ke PDF yang sudah ada
     * 
     * @param string $pdfPath Path ke file PDF asli
     * @param string $signaturePath Path ke gambar tanda tangan (PNG dengan background transparan)
     * @param string $signerName Nama penandatangan
     * @param string $signerNIP NIP penandatangan
     * @return string Path ke PDF yang sudah ditandatangani
     */
    public static function addSignature($pdfPath, $signaturePath, $signerName, $signerNIP)
    {
        $pdf = new Fpdi();
        
        // Hitung jumlah halaman
        $pageCount = $pdf->setSourceFile($pdfPath);
        
        // Loop semua halaman
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // Import halaman
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);
            
            // Tambah halaman dengan ukuran yang sama
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            
            // Gunakan template (halaman asli)
            $pdf->useTemplate($templateId);
            
            // Jika halaman terakhir, tambahkan tanda tangan
            if ($pageNo === $pageCount) {
                self::addSignatureToPage($pdf, $signaturePath, $signerName, $signerNIP, $size);
            }
        }
        
        // Simpan ke temporary file
        $tempPath = storage_path('app/temp/signed_' . time() . '.pdf');
        
        // Pastikan folder temp ada
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        $pdf->Output('F', $tempPath);
        
        return $tempPath;
    }
    
    /**
     * Menambahkan signature ke halaman
     */
    private static function addSignatureToPage($pdf, $signaturePath, $signerName, $signerNIP, $pageSize)
    {
        $pdf->SetFont('Times', '', 10);
        
        // Posisi tanda tangan (kanan bawah)
        $x = $pageSize['width'] * 0.6; // 60% dari lebar (kanan)
        $y = $pageSize['height'] - 60; // 60mm dari bawah
        
        // Tambahkan teks "Mengetahui,"
        $pdf->SetXY($x, $y);
        $pdf->Cell(0, 5, 'Telah Diverifikasi,', 0, 1, 'L');
        
        // Tambahkan nama penandatangan
        $pdf->SetXY($x, $y + 5);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(0, 5, strtoupper($signerName), 0, 1, 'L');
        
        // Tambahkan gambar tanda tangan jika ada
        if (file_exists($signaturePath)) {
            $pdf->Image($signaturePath, $x, $y + 12, 40, 20, 'PNG');
        } else {
            // Jika tidak ada gambar, tambahkan teks
            $pdf->SetXY($x, $y + 12);
            $pdf->SetFont('Times', 'I', 8);
            $pdf->Cell(40, 20, '(Ditandatangani secara digital)', 0, 1, 'C');
        }
        
        // Tambahkan garis bawah nama
        $pdf->SetXY($x, $y + 35);
        $pdf->SetFont('Times', 'BU', 10);
        $pdf->Cell(0, 5, strtoupper($signerName), 0, 1, 'L');
        
        // Tambahkan NIP
        $pdf->SetXY($x, $y + 40);
        $pdf->SetFont('Times', '', 9);
        $pdf->Cell(0, 5, 'NIP. ' . $signerNIP, 0, 1, 'L');
        
        // Tambahkan timestamp verifikasi
        $pdf->SetXY($x, $y + 46);
        $pdf->SetFont('Times', 'I', 7);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 3, 'Diverifikasi: ' . now()->format('d/m/Y H:i'), 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
    }
}