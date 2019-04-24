<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
// $obj_pdf->SetTitle($title);
// $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
// $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// $obj_pdf->SetDefaultMonospacedFont('helvetica');
// $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
// we can have any view part here like HTML, PHP etc
?>
<html>
    <body>
        <h2>Laporan Target Assignment</h2>
        <table border="1">
            <tr style="text-align: center">
                <th>Bulan</th><th>Nama Marketing</th><th>New Opening Outlet</th><th>Outlet Aktif Digital</th><th>Outlet Aktif Voucher</th><th>Outlet Aktif Bang Tcash</th><th>Sales Perdana</th><th>NSB</th><th>MKIOS Reguler</th><th>MKIOS Bulk</th><th>GT Pulsa</th>
            </tr>
            <?php foreach($distribusi as $dist) : ?>
            <tr>
                <td><?php echo date('F', strtotime($dist->tanggal)) ?></td>
                <td><?php echo $dist->nama_marketing ?></td>
                <td style="text-align:right"><?php echo $dist->new_opening_outlet ?></td>
                <td style="text-align:right"><?php echo $dist->outlet_aktif_digital ?></td>
                <td style="text-align:right"><?php echo $dist->outlet_aktif_voucher ?></td>
                <td style="text-align:right"><?php echo $dist->outlet_aktif_bang_tcash ?></td>
                <td style="text-align:right"><?php echo $dist->sales_perdana ?></td>
                <td style="text-align:right"><?php echo $dist->nsb ?></td>
                <td style="text-align:right"><?php echo $dist->mkios_bulk ?></td>
                <td style="text-align:right"><?php echo $dist->mkios_reguler ?></td>
                <td style="text-align:right"><?php echo $dist->gt_pulsa ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');