<?php

namespace App\Helpers;

use setasign\Fpdi\TcpdfFpdi; // Pastikan library terinstal

class PdfSigner
{
    public static function addSignature($pdfPath, $signaturePath, $nama, $nip)
    {
        $pdf = new TcpdfFpdi();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Import halaman dari PDF original
        $pageCount = $pdf->setSourceFile($pdfPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);

            // Hanya tambahkan gambar signature di halaman terakhir, di atas nama
           if ($pageNo === $pageCount && $signaturePath && file_exists($signaturePath)) {
        $w = $size['width'];
        $h = $size['height'];

        // UNTUK LEBIH KE KANAN:
        // Sebelumnya mungkin menggunakan $w - 60 atau $w * 0.6.
        // Ubah menjadi pengurang yang lebih kecil atau persentase yang lebih besar.
        $x = $w - 55; // Mengurangi nilai pengurang akan menggeser gambar ke kanan

        // UNTUK AGAK NAIK KE ATAS:
        // Sebelumnya menggunakan $h - 70.
        // Ubah menjadi pengurang yang lebih besar untuk menarik koordinat Y ke atas.
        $y = $h - 85; // Menambah nilai pengurang akan menarik gambar lebih tinggi dari bawah kertas

        // Ukuran lebar gambar signature (misal: 45mm)
        $pdf->Image($signaturePath, $x, $y, 45, 0, 'PNG', '', '', false, 300, '', false, false, 0);
    }
        }

        // Simpan PDF signed baru sebagai temporary
        $signedPath = storage_path('app/public/' . basename($pdfPath) . '_signed.pdf');
        $pdf->Output($signedPath, 'F');

        return $signedPath;
    }
}