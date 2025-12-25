<?php

namespace App\Helpers;

use setasign\Fpdi\TcpdfFpdi; 

class PdfSigner
{
    // Tambahkan parameter $customX dan $customY dengan default null
    public static function addSignature($pdfPath, $signaturePath, $nama, $nip, $customX = null, $customY = null)
    {
        $pdf = new TcpdfFpdi();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pageCount = $pdf->setSourceFile($pdfPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);

            if ($pageNo === $pageCount && $signaturePath && file_exists($signaturePath)) {
                $w = $size['width']; // Lebar kertas (biasanya 210mm untuk A4)
                $h = $size['height']; // Tinggi kertas (biasanya 297mm untuk A4)

                // LOGIKA BARU:
                // Jika custom coordinate diisi dari Controller, gunakan itu.
                // Jika tidak, gunakan default lama ($w - 55, dll).
                if ($customX !== null && $customY !== null) {
                    $x = $customX;
                    $y = $customY;
                } else {
                    // Default lama (fallback)
                    $x = $w - 55; 
                    $y = $h - 85; 
                }

                // Simpan gambar
                $pdf->Image($signaturePath, $x, $y, 80, 0, 'PNG', '', '', false, 300, '', false, false, 0);
            }
        }

        $signedPath = storage_path('app/public/' . basename($pdfPath) . '_signed.pdf');
        $pdf->Output($signedPath, 'F');

        return $signedPath;
    }
}