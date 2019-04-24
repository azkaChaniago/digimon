<?php
// tcpdf();
$hs = ' <table style="text-align:center">
            <tr>
                <td style="font-size: 18px; font-weight: bold;">PT DIGITAL GOLDEN COMMUNICATION</td>
            </tr>
            <tr>
                <td style="font-size: 12px; font-weight: normal;">Jalan Teuku Umar No 10 G Penengahan - Kedaton Bandar Lampung</td>
            </tr>
        </table>';
$obj_pdf = new DigiPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Laporan Rekapitulasi";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, $hs);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
// we can have any view part here like HTML, PHP etc
?>
<html>
<head>
    <style>
        table
        {
            border-spacing: 0;
            /* border: 0.5px solid #000; */
            /* border-collapse: collapse; */
        }
        td, th 
        {
            padding:0;
            border: 0.2px solid #000;   
        }
        thead 
        {
            display: table-header-group;
        }
        tr > th {
            background-color: #ddd;
            text-align: center;
            font-weight: bold;
        }
        .ttd > tr > td {
            border: none;
        }
    </style>
</head>
<body>
    <h2>Laporan Share Broadband</h2>
    <table border="1">
        <thead>
            <tr style="text-align: center">         
                <th>Tanggal</th>
                <th>Kecamatan</th>
                <th>QTY Telkomsel Marketshare</th>
                <th>QTY Indosat Marketshare</th>
                <th>QTY XL Marketshare</th>
                <th>QTY Tri Marketshare</th>
                <th>QTY Smartfrend Marketshare</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($export as $ex) : ?>
        <tr>
            <td><?php echo $ex->tanggal ?></td>
            <td><?php echo $ex->kecamatan ?></td>
            <td><?php echo $ex->qty_telkomsel_marketshare ?></td>
            <td><?php echo $ex->qty_indosat_marketshare ?></td>
            <td><?php echo $ex->qty_xl_marketshare ?></td>
            <td><?php echo $ex->qty_tri_marketshare ?></td>
            <td><?php echo $ex->qty_smartfrend_marketshare ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br><br><br>
    <table class="ttd">
        <tr><td colspan="7"></td><td colspan="2">Mengetahui,</td></tr>
        <tr><td colspan="7" height="50"></td><td colspan="2" height="50">Bendahara TDC Kedaton</td></tr>
        <tr><td colspan="7"></td><td colspan="2"><?php echo $user; ?></td></tr>
    </table>
</body>
</html>
<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');