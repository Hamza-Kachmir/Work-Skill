<?php
session_name("workskill");
session_start();

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $this->Image('logopdf.jpg', 35, 5, 40, 40, '', '', '', true, 150, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 30);
        // Title
        $this->Cell(0, 40, 'WorkSkill', 0, false, 'C', 0, '', 0, false, 'Center-Center', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Team Fojo K');
$pdf->SetTitle('WorkSkill');
$pdf->SetSubject('Resultat Competence');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->AddPage();

// set some text to print
$txt = '
<p style="font-size: large;font-family: Arial, Helvetica, sans-serif;">Nom : '. $_SESSION["nomvisiteur"] .'<br>Prénom : '. $_SESSION["prenomvisiteur"] .'<br>Date : '. $_SESSION["datefinish"] .'</p>
</br>
<h3 style="text-align: center;font-size: xx-large;font-family: Arial, Helvetica, sans-serif;">Résultat du test au niveau des compétences</h3>
<h4 style="font-size: x-large;text-align: center;font-family: Arial, Helvetica, sans-serif;">Pour le métier de '. $_SESSION["metier"] .'</h4>
</br></br>
<p style="font-size: large;font-family: Arial, Helvetica, sans-serif;">Compétences acquises :</p>
</br>

<p style="font-size: large;font-family: Arial, Helvetica, sans-serif;">Compétences à revoir :</p>

';

// print a block of text using Write()
$pdf->writeHTMLCell(200,20,5,60, $txt, '', 0, '', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('resultat.pdf', 'I');
