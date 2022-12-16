<?php
// require_once('tcpdf_include.php');

// create new PDF document
ob_start();


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('KnCorp');
$pdf->setTitle('MMS | Request Report #' . $request->id_request);
$pdf->setSubject('Request Report');
$pdf->setKeywords('TCPDF, PDF, tdk, mms,request,report');

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
$html = '
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Laporan Patroli</title>
	</head>
	<body>
    ';
$html .= '
        <table border="0" cellspacing="0" cellpadding="1">
            <tbody>
                <tr>
                    <td style="text-align:center;font-weight:bold;font-size:18px">REQUEST LIST</td>
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



$html .= '
        <table border="0" cellspacing="0" cellpadding="3" width="100%">
            <tbody>
            <tr>
                    <td width="30%"><>ID REQUEST</td>
                    <td width="70%">: #' . $request->id_request . '</td>
                </tr>
                <tr>
                    <th width="30%">KODE PROYEK</th>
                    <td width="70%">: ' . $request->kd_project . '</td>
                </tr>
                <tr>
                    <th width="30%">NAMA PROYEK</th>
                    <td width="70%">: ' . $request->project_name . '</td>
                </tr>
                <tr>
                    <th width="30%">AREA</th>
                    <td width="70%">: ' . $request->area . '</td>
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
$html .= '

            </tbody>
        </table>
        <br><br><br>
        ';

$html .= '
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th width="5%" style="text-align:center;font-weight:bold">#</th>
                    <th width="60%" style="font-weight:bold">KODE/NAMA MATERIAL </th>
                    <th width="35%" style="text-align:center;font-weight:bold">VOLUME/SATUAN</th>
                </tr>
        ';
$no = 1;
foreach ($material as $key => $data) {
    $html .= '
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

$html .=    '
        </table>
    <br><br><br><br>';
$html .= '
     <div>
        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <tr>
                <th width="33%">Diminta pada: ' . indo_date($request->createdAt) . '</th>
                <th width="33%">Diterima pada: ' . indo_date($request->applyAt) . '</th>
                <th width="34%">Diselesaikan pada: ' . indo_date($request->finisedAt) . '</th>
            </tr>
            <tr>
                <th width="33%">Diminta oleh: <br><b>' . $request->user_request . '</b></th>
                <th width="33%">Diterima oleh: <br><b>' . $request->user_apply . '</b></th>
                <th width="34%">Diselesaikan oleh: <br><b>' . $request->user_apply . '</b></th>
            </tr>
        </table>
    </div>';


$html .= '
    </body>
</html>
    ';

$pdf->writeHTML($html, true, false, true, false, '');


// move pointer to last page
// $pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('Request.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
