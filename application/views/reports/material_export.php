<?php
// require_once('tcpdf_include.php');

// create new PDF document
ob_start();


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('KnCorp');
$pdf->setTitle('MMS | Material Stock Report');
$pdf->setSubject('Request Report');
$pdf->setKeywords('TCPDF, PDF, tdk, mms,material,report');

// set default header data
$pdf->SetHeaderData(false, false, "MMS - Material Monitoring System", "PT TRIMITRA DATA KOMUNIKASI");
// $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// $pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
// $pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
// $pdf->setCellMargins(1, 1, 1, 1);

// set color for background
// $pdf->setFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
// create some HTML content
$html1 = '
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>' . $title . '</title>
	</head>
	<body>
    ';
$html1 .= '
        <table border="0" cellspacing="0" cellpadding="1">
            <tbody>
                <tr>
                    <td style="text-align:center;font-weight:bold;font-size:18px">MATERIAL STOCK</td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size:16px"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
';



$html1 .= '
        <table border="0" cellspacing="0" cellpadding="3" width="100%">
            <tbody>
                <tr>
                    <th width="30%">KODE PROYEK</th>
                    <td width="70%">: ' . $project->kd_project . '</td>
                </tr>
                <tr>
                    <th width="30%">NAMA PROYEK</th>
                    <td width="70%">: ' . $project->project_name . '</td>
                </tr>
                <tr>
                    <th width="30%">AREA</th>
                    <td width="70%">: ' . $project->area . '</td>
                </tr>
                
                <tr>
                    ';
if ($request->status == 1) {
    echo '<th width="30%">STATUS</th><td width="70%">: Diminta</td></tr>';
} elseif ($request->status == 2) {
    echo '<th width="30%">STATUS</th><td width="70%">: Diproses</td></tr>';
} elseif ($request->status == 3) {
    echo '<th width="30%">STATUS</th><td width="70%">: Selesai</td></tr>';
}
$html1 .= '

            </tbody>
        </table>
        <br><br><br>
        ';

$html1 .= '<table border="0" cellspacing="0" cellpadding="3" width="100%">
            <tr>
                <th width="30%" style="font-weight:bold">MATERIAL STOCK</th>
            </tr>
        </table>';
$html1 .= '
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th width="5%" style="text-align:center;font-weight:bold">#</th>
                    <th width="60%" style="font-weight:bold">KODE/NAMA MATERIAL </th>
                    <th width="35%" style="text-align:center;font-weight:bold">VOLUME/SATUAN</th>
                </tr>
        ';
$no = 1;
foreach ($material_stock as $key => $data) {
    $html1 .= '
                <tr>
                    <td width="5%" style="text-align:center">' . $no++ . '</td>
                    <td width="60%">
                    ' . $data->kd_material . '
                    <br>
                    ' . $data->material_name . '
                    </td>
                    <td width="35%" style="text-align:center">' . $data->volume . ' ' . $data->unit . '</td>
                </tr>
        ';
}

$html1 .=    '
        </table>
    <br><br>';


$pdf->writeHTML($html1, true, false, true, false, '');

$pdf->AddPage();
$html2 = '<table border="0" cellspacing="0" cellpadding="3" width="100%">
            <tr>
                <th width="30%" style="font-weight:bold">MATERIAL IN</th>
            </tr>
        </table>';

$html2 .= '
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th width="5%" style="text-align:center;font-weight:bold">#</th>
                    <th width="60%" style="font-weight:bold">KODE/NAMA MATERIAL </th>
                    <th width="35%" style="text-align:center;font-weight:bold">VOLUME/SATUAN</th>
                </tr>
        ';
$no = 1;
foreach ($material_in as $key => $data) {
    $html2 .= '
                <tr>
                    <td width="5%" style="text-align:center">' . $no++ . '</td>
                    <td width="60%">
                    ' . $data->kd_material . '
                    <br>
                    ' . $data->material_name . '
                    </td>
                    <td width="35%" style="text-align:center">' . $data->volume . ' ' . $data->unit . '</td>
                </tr>
        ';
}

$html2 .=    '
        </table>
    <br><br>';


$pdf->writeHTML($html2, true, false, true, false, '');

$pdf->AddPage();
$html3 = '<table border="0" cellspacing="0" cellpadding="3" width="100%">
            <tr>
                <th width="30%" style="font-weight:bold">MATERIAL OUT</th>
            </tr>
        </table>';
$html3 .= '
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th width="5%" style="text-align:center;font-weight:bold">#</th>
                    <th width="60%" style="font-weight:bold">KODE/NAMA MATERIAL </th>
                    <th width="35%" style="text-align:center;font-weight:bold">VOLUME/SATUAN</th>
                </tr>
        ';
$no = 1;
foreach ($material_out as $key => $data) {
    $html3 .= '
                <tr>
                    <td width="5%" style="text-align:center">' . $no++ . '</td>
                    <td width="60%">
                    ' . $data->kd_material . '
                    <br>
                    ' . $data->material_name . '
                    </td>
                    <td width="35%" style="text-align:center">' . $data->volume . ' ' . $data->unit . '</td>
                </tr>
        ';
}

$html3 .=    '
        </table>
    <br><br>';


$html3 .= '
    </body>
</html>
    ';

$pdf->writeHTML($html3, true, false, true, false, '');


// move pointer to last page
// $pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('MaterialStock.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
