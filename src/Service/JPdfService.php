<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class JPdfService
{
    private $domPdf;

    public function __construct() {
        $this->domPdf = new Dompdf();

        // Set options
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Garamond');
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->set('isJavascriptEnabled', true);

        // Set paper size and orientation
        $pdfOptions->set('defaultPaperSize', 'A4');
        $pdfOptions->set('defaultPaperOrientation', 'portrait');

        // Set margins
        $pdfOptions->set('marginTop', 10);
        $pdfOptions->set('marginRight', 10);
        $pdfOptions->set('marginBottom', 10);
        $pdfOptions->set('marginLeft', 10);

        $this->domPdf->setOptions($pdfOptions);
    }

    public function showPdfFile($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("details.pdf", [
            'Attachment' => true
        ]);
    }

    public function generateBinaryPDF($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->output();
    }
}