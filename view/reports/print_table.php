<?php
require_once("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->SetTitle($table_html_name . ' Report PDF');
$pdf->AliasNbPages();

$font1 = 16;
$font2 = 12;
$font3 = 10;
$font4 = 9;
$font = 'Times';

// add new page for all results returned
$pdf->AddPage();
$pdf->Image(LOGO, 20, 5, 35);
$pdf->SetFont($font, '', $font3);

// title page header
$pdf->SetFont($font, 'B', $font1);
$pdf->Cell(0, 10, $table_html_name . ' Report PDF', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont($font, 'B', $font3);
$pdf->Cell(0, 0, 'Jefferson County', 0, 1, 'C');
$pdf->Cell(0, 10, 'Office of the Medical Examiner', 0, 1, 'C');
$pdf->SetFont($font, '', $font3);
$pdf->Cell(0, 0, '311 S. Center Avenue, Room 114', 0, 1, 'C');
$pdf->Cell(0, 10, 'Jefferson, WI 53549', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: (920) 674-7119', 0, 1, 'C');
$pdf->SetY(10);
$pdf->SetX(160);
$pdf->Write(10, 'Date: ');
$pdf->SetFont($font,'U', $font3);
$pdf->Write(10, date('M d, Y'));

$pdf->SetY(50);
$by_table = explode(">", $table_html);
if($table_html_name == 'Annual'){
    $table_count = 1;
    $width = 0;
    for($i = 0; $i < count($by_table); $i++){
        $line = $by_table[$i];
        switch($table_count){
            case 1:
                $width = 190/13;
                break;
            case 2:
                $width = 190/7;
                break;
            case 3:
                $width = 190/6;
                break;
            case 4:
                $width = 190/13;
                break;
        }
        if(strpos($line, 'h6') != false){
            $new_line = explode("<h6", $line)[0];
            $new_line = explode("</h6", $new_line)[0];
            if($new_line != null){
                $pdf->SetFont($font, 'B', $font2);
                $pdf->Cell(0, 5, $new_line, 0, 2, 'R');
            }
        }
        else if(strpos($line, 'th') != false){
            $new_line = explode("<th", $line)[0];
            $new_line = explode("<", $new_line)[0];
            $new_line = explode("</", $new_line)[0];
            if($new_line == 'Fentanyl and/or Fentanyl Analogs'){
                $pdf->SetFont($font, 'B', $font2);
                $pdf->Cell($width, 10, 'Fentanyl', 1, 0, 'C');
            } else if ($new_line == 'Methamphetamine'){
                $pdf->SetFont($font, 'B', $font2);
                $pdf->Cell($width, 10, 'Meth', 1, 0, 'C');
            } else if($new_line != null){
                $pdf->SetFont($font, 'B', $font2);
                $pdf->Cell($width, 10, $new_line, 1, 0, 'C');
            }
        } else if(strpos($line, 'tbody') != false){
            $pdf->Ln(5);
        }
        // case td
        else if(strpos($line, 'td') != false){
            $new_line = explode("<td", $line)[0];
            $new_line = explode("<", $new_line)[0];
            $new_line = explode("</", $new_line)[0];
            if($new_line != null){
                $pdf->SetFont($font, '', $font3);
                $pdf->Cell($width, 10, $new_line, 1, 0, 'R');
            }
        }
        // case br
        else if(strpos($line, 'br') != false){
            $pdf->Ln(15);
            $table_count = $table_count + 1;
        }
        
    }
} else {
    for($i = 0; $i < count($by_table); $i++){
        $line = $by_table[$i];
        $line = str_replace("⊆", "{}", $line);
        
        // case table
        if(strpos($line, 'table') != false){
            $pdf->Cell(0, 1, '', 1, 2, 'C', true);
        }
        // case th
        else if(strpos($line, 'th') != false){
            $new_line = explode("<th", $line)[0];
            $new_line = explode("<", $new_line)[0];
            $new_line = explode("</", $new_line)[0];
            if($new_line != null){
                $pdf->SetFont($font, 'B', $font2);
                $pdf->Cell(0, 10, $new_line, 1, 2, 'C');
            }
        }
        // case td
        else if(strpos($line, 'td') != false){
            $new_line = explode("<td", $line)[0];
            $new_line = explode("<", $new_line)[0];
            $new_line = explode("</", $new_line)[0];
            if($new_line != null){
                $pdf->SetFont($font, '', $font3);
                $pdf->Cell(0, 5, $new_line, 1, 2, 'R');
            }
        } else if(strpos($line, 'a') != false){
            $new_line = explode("<a", $line)[0];
            $new_line = explode("<", $new_line)[0];
            $new_line = explode("</", $new_line)[0];
            if($new_line != null){
                $pdf->SetFont($font, '', $font3);
                $pdf->Cell(0, 5, $new_line, 1, 2, 'R');
            }
        }
        // case br
        else if(strpos($line, 'br') != false){
            $pdf->Ln(5);
        }
    }
}
// save and output
ob_end_clean();
$pdf->Output();
?>