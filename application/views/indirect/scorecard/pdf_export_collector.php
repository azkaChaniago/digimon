<?php
// tcpdf();
$hs = ' <table style="text-align:center">
            <tr>
                <td style="font-size: 18px; font-weight: bold;">PT GOLDEN COMMUNICATION</td>
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
    <h2>Laporan Scorecard Collector</h2>
    
    <table>
        <thead>
            <tr style="text-align: center">
                <th>Tahun</th><th>Bulan</th><th>Nama Marketing</th><th>New RS Non Outlet</th><th>NSB</th><th>GT Pulsa</th><th>Collecting</th>
            </tr>
        </thead>
        <tbody>
        
        <?php foreach($scorecard as $dist) : ?>
        <tr>
            <td><?php echo date('Y', strtotime($dist->tanggal)) ?></td>
            <td><?php echo date('F', strtotime($dist->tanggal)) ?></td>
            <td><?php echo $dist->nama_marketing ?></td>
            <td style="text-align:right"><?php echo $dist->new_rs_non_outlet ?></td>
            <td style="text-align:right"><?php echo $dist->nsb ?></td>
            <td style="text-align:right"><?php echo $dist->gt_pulsa ?></td>
            <td style="text-align:right"><?php echo $dist->collecting ?></td>
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