

<?php
//============================================================+
// File name   : example_059.php
// Begin       : 2010-05-06
// Last Update : 2013-05-14
//
// Description : Example 059 for TCPDF class
//               Table Of Content using HTML templates.
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Table Of Content using HTML templates.
 * @author Nicola Asuni
 * @since 2010-05-06
 */

// Include the main TCPDF library (search for installation path).
require_once ('../public/library/examples/tcpdf_include.php');
require_once ('../public/library/tcpdf.php');


/**
 * TCPDF class extension with custom header and footer for TOC page
 */
class TOC_TCPDF extends TCPDF {

    /**
      * Overwrite Header() method.
     * @public
     */
    public function Header() {

    }

      public function Footer() {
        // Position at 15 mm from bottom
        $cara='<span align="center" style="color: grey;">Copyright 2021 AEON Co.(M) Bhd. All rights reserved | Digital Interal Audit (DIA)</span>';

        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
        $this->Cell(0, 10, 'Page '. $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        $this->SetY(-10);
        $this->SetFont('helvetica', '', 8);


        $this->writeHTML($cara, true, false, false, false, '');
    }

} // end of class

// create new PDF document
$pdf = new TOC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information


// set default header data


// set header and footer fonts


// set default monospaced font


// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)


// set font
$pdf->SetFont('dejavusans', '', 10);



// ---------------------------------------------------------

// create some content ...

// add a page

$page2=<<<EOD



 <table border="1" cellpadding="3" style="margin-top:100px;">

    <tr>
                    <td colspan="4" style="text-align:left; font-weight: bold;">VERSION HISTORY</td>
                    </tr>
                    <tr >
                        <th style="text-align:left; font-weight: bold;"  width= '30%'>VERSION NO.</th>
                        <td>$generatesop->version_no </td>

                        <th style="text-align:left; font-weight: bold;">EFFECTIVE DATE</th>
                        <td>$generatesop->effective_date  </td>
                    </tr>

                    <tr>
                        <th style="text-align:left; font-weight: bold;">Process Owner</th>
                        <td colspan="3">$generatesop->Process_owner </td>

                    </tr>

                    <tr>
                        <th style="text-align:left; font-weight: bold;">Process Execution</th>
                        <td colspan="3">$generatesop->Process_exec </td>


                    </tr>

                    <tr>
                        <th><span  style="text-align:left; font-weight:bold;">Reviewed By</span> <div style="font-size:7; font-weight:bold;">(Name,ID)</div><span style="font-size:7; font-weight:bold;">(Please Sign If printed)</span> </th>
                        <td>$generatesop->revised_by</td>

                        <th><span  style="text-align:left; font-weight: bold;">Approved By </span><div style="font-size:7; font-weight:bold;">(Name,ID)</div>  <span style="font-size:7; font-weight:bold;">(Please Sign If printed)</span>  </th>
                        <td>$generatesop->approved_by</td>
                    </tr>


            </table>

EOD;




$history=<<<EOD
<h1> LOG HISTORY</h1>

            <table border="1" cellpadding="3" cellspacing="0" style="margin-top:100px;">
            <tr>

            <th><span style="font-weight:bold;" align="center">Uploaded Date</span></th>
            <th><span style="font-weight:bold;" align="center">Created by</span></th>
            <th><span style="font-weight:bold;" align="center">Staff ID</span></th>
            <th><span style="font-weight:bold;" align="center">BUSINESS UNIT</span></th>

            </tr>

            <tr>
            <td>$generatesop->created_at</td>
            <td>$generatesop->uploaded_by</td>
            <td>$generatesop->Employee_id</td>
            <td>$generatesop->business_unit</td>

            </tr>
            </table>
EOD;

$policy=<<<EOD
<h2>POLICY</h2>
            <table cellpadding="13" style="margin-top:5px;">
            <tr>
            <td style="border: 1px solid black;">$generatesop->policy</td>
            </tr>
            </table>
EOD;

$purpose=<<<EOD
<h2>PURPOSE</h2>
            <table cellpadding="13" style="margin-top:5px;">
            <tr>
            <td style="border: 1px solid black;">$generatesop->purpose</td>
            </tr>
            </table>
EOD;

$scope=<<<EOD
<h2>SCOPE</h2>
            <table cellpadding="13" style="margin-top:5px;">
            <tr>
            <td style="border: 1px solid black;">$generatesop->scope</td>
            </tr>
            </table>

EOD;

$review_pro=<<<EOD
<h2>REVIEW PROCEDURE</h2>
            <table cellpadding="13" style="margin-top:5px;">
            <tr>
            <td style="border: 1px solid black;">$generatesop->review_pro</td>
            </tr>
            </table>

EOD;

$monitoring=<<<EOD
<h2>MONITORING</h2>
            <table cellpadding="13" style="margin-top:5px;">
            <tr nobr="true">
            <td style="border: 1px solid black;">$generatesop->monitoring</td>
            </tr>
            </table>

EOD;

$verification=<<<EOD
<h2 >VERIFICATION AND RECORD KEEPING</h2>
            <table cellpadding="13" style="margin-top:5px;">
            <tr nobr="true">
            <td style="border: 1px solid black;">$generatesop->verification</td>
            </tr>
            </table>

EOD;

$flow=<<<EOD
<h2>Process Flow of $generatesop->sop_title </h2> <br><br><br>
EOD;


$procedure='<h2>PROCEDURE</h2>
           <table border="1" cellpadding="10">';

            $a=1;
            foreach($generatesop->steps as $key=>$new){

          $procedure.='<tr nobr="true">

            <td style="font-size:12px; vertical-align: top; width:30%"><b>'.$a++.'-'.$new.'</b></td>


            <td style="font-size:12px; width:70%">'.$generatesop->desc[$key].'</td>
            </tr>';
        }

       $procedure.='</table>';

$appendix=<<<EOD
<h2> APPENDIX</h2>
EOD;

$sop_title=<<<EOD
<h3 style align='center'>$generatesop->sop_title</h3>
EOD;




$pdf->AddPage();
// set a bookmark for the current position
$page1=file_get_contents('data:image/png;base64,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');

$pdf->Image('@' . $page1, 75, 0, 60, 0, '', '', '', true, 200);

$pdf->SetFont('dejavusans', 'B', 20);
$pdf->Cell(0, 50, 'STANDARD OPERATING PROCEDURES (SOP)', 0, 1, 'C');

$pdf->SetFont('dejavusans', 'B', 20);
$pdf->writeHTML($sop_title, true, false, false, false, 'C');

$pdf->SetTopMargin(210);
$pdf->SetFont('dejavusans', '', 9);
$pdf->writeHTML($page2, true, false, false, false, '');


$pdf->SetTopMargin(15);

$pdf->AddPage();
$pdf->Bookmark('Log history', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($history, true, false, false, false, '');


$pdf->AddPage();

$pdf->Bookmark('Policy', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($policy, true, false, false, false, '');

$pdf->Bookmark('Purpose', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($purpose, true, false, false, false, '');

$pdf->Bookmark('Scope', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($scope, true, false, false, false, '');

$pdf->AddPage();
$pdf->Bookmark('Review Procedure', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($review_pro, true, false, false, false, '');

$pdf->Bookmark('Monitoring ', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($monitoring, true, false, false, false, '');

$pdf->Bookmark('Verification and Record Keeping ', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($verification, true, false, false, false, '');


$pdf->AddPage('L');
$pdf->Bookmark('Flow', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($flow, true, false, false, false, '');

$flow=explode(',',$generatesop->img);
$countflow=count($flow);

$c=0;
foreach (array_reverse($flow) as $img) {

 $c++;
if($generatesop->img){
$imges=file_get_contents(Storage::disk('s3')->url('images/'.$img));

$pdf->Image('@' . $imges, 0, 30, 220, 150, '', '', '', true, 200,'C');

if($c < $countflow){
$pdf->AddPage('L');
}
}
}

$pdf->AddPage('P');
$pdf->Bookmark('Procedures', 0, 0, '', 'B', array(0,64,128));
$pdf->writeHTML($procedure, true, false, false, false, '');

$pdf->AddPage('L');
$pdf->Bookmark('Appendix', 0, 0, '', 'B', array(0,64,128));
//$pdf->writeHTML('APPENDIX', true, false, false, false, '');

$image=$generatesop->appendix;
$d=0;
$count=0;

foreach ($image as $value) {
    $count+=count($value);
}

$b=0;

foreach ($image as $key=>$images) {
$b++;
$pdf->SetFont('dejavusans', 'B', 14);
if($images){
$pdf->writeHTML('APPENDIX '. $b, true, false, false, false, '');


foreach ($images as $pkey=>$value) { 
$d++
$appendix_images=file_get_contents(Storage::disk('s3')->url('images/'.$value))

$pdf->Image('@' . $appendix_images, 0, 30, 220, 150, '', '', '', true, 200,'C');

if($d < $count){
$pdf->AddPage('L');
}
}
}
}




// print a line using Cell()
//$pdf->Cell(0, 10, 'Chapter 1', 0, 1, 'L');
//$pdf->writeHTML($flow, true, false, false, false, '');
//$pdf->Image('@' . $imges, 12, 40, 185, 0, '', '', '', true, 150);









// print a line using Cell()













// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .


// add a new page for TOC
$pdf->addTOCPage('P');

// write the TOC title and/or other elements on the TOC page

$pdf->SetFont('dejavusans', 'B', 15);
$pdf->MultiCell(0, 0, 'TABLE OF CONTENT', 0, 'L', 0, 1, '', '', true, 0);
$pdf->Ln();
$pdf->SetFont('dejavusans', '', 10);



// define styles for various bookmark levels
$bookmark_templates = array();

/*
 * The key of the $bookmark_templates array represent the bookmark level (from 0 to n).
 * The following templates will be replaced with proper content:
 *     #TOC_DESCRIPTION#    this will be replaced with the bookmark description;
 *     #TOC_PAGE_NUMBER#    this will be replaced with page number.
 *
 * NOTES:
 *     If you want to align the page number on the right you have to use a monospaced font like courier, otherwise you can left align using any font type.
 *     The following is just an example, you can get various styles by combining various HTML elements.
 */

// A monospaced font for the page number is mandatory to get the right alignment
$bookmark_templates[0] = '<table border="1" cellpadding="2" cellspacing="0"><tr><td width="155mm"><span style="font-family:dejavusans;font-size:9pt;color:black;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:dejavusans;font-size:9pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
$bookmark_templates[1] = '<table border="1" cellpadding="2" cellspacing="1"><tr><td width="5mm">&nbsp;</td><td width="150mm"><span style="font-family:times;font-size:11pt;color:green;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:courier;font-size:11pt;color:green;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
$bookmark_templates[2] = '<table border="1" cellpadding="2" cellspacing="1"><tr><td width="10mm">&nbsp;</td><td width="145mm"><span style="font-family:times;font-size:10pt;color:#666666;"><i>#TOC_DESCRIPTION#</i></span></td><td width="25mm"><span style="font-family:courier;font-size:10pt;color:#666666;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
// add other bookmark level templates here ...

// add table of content at page 1
// (check the example n. 45 for a text-only TOC
$pdf->addHTMLTOC(2, 'INDEX',$bookmark_templates, true, 'B', array(128,0,0));


// end of TOC page
$pdf->endTOCPage();







// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($generatesop->sop_title.'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
