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
$obj_pdf = new DigiPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
            table-layout: auto;
            border-collapse: collapse;
            width: 100%;
            /* border-collapse: collapse; */
        }
        table th, table td 
        {
            white-space: nowrap;
            border: 0.5px solid #222;
        }
        tr td:last-child
        {
            width: 100%;
            white-space: nowrap;
        }
        tr > th {
            background-color: #ddd;
            text-align: center;
            font-weight: bold;
        }
        .ttd > tr > td {
            border: none;
        }
        /*
        thead 
        {
            display: table-header-group;
        }
        .table table
        {
            table-layout: auto !important;
        }
        table th, .table td, .table thead th, .table tbody td, .table tfoot td, .table tfoot th
        {
            width: auto !important;
        } */
    </style>
</head>
<body>
    <h2>Laporan Marketshare</h2>
    <table>
        <thead>
            <tr style="text-align: center">         
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Kecamatan</th>
                <th colspan="3">QTY Telkomsel</th>
                <th colspan="2">QTY Indosat</th>
                <th rowspan="2">QTY XL</th>
                <th rowspan="2">QTY Tri</th>
                <th rowspan="2">QTY Smartfrend</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Presentase Telkomsel</th>
                <th rowspan="2">Presentase Indosat</th>
                <th rowspan="2">Presentase XL</th>
                <th rowspan="2">Presentase Tri</th>
                <th rowspan="2">Presentase Smartfrend</th>
                <th rowspan="2">Total Presentase</th>
            </tr>
            <tr>
                <th>Simpati</th>
                <th>AS</th>
                <th>Loop</th>
                <th>Mentari</th>
                <th>IM3</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
        <?php foreach($market as $ex) : ?>
        <tr>
            <?php
            $total = $ex->qty_telkomsel_marketshare + $ex->qty_indosat_marketshare + $ex->qty_xl_marketshare + $ex->qty_tri_marketshare + $ex->qty_smartfrend_marketshare;
            $tel = round(($ex->qty_telkomsel_marketshare / $total) * 100, 2);
            $ind = round(($ex->qty_indosat_marketshare / $total) * 100, 2);
            $xl = round(($ex->qty_xl_marketshare / $total) * 100, 2);
            $tri = round(($ex->qty_tri_marketshare / $total) * 100, 2);
            $smart = round(($ex->qty_smartfrend_marketshare / $total) * 100, 2);
            $persentage = round($tel + $ind + $xl + $tri + $smart);
            ?>
            <td><?php echo $no ?></td>
            <td><?php echo $ex->tanggal ?></td>
            <td><?php echo $ex->kecamatan ?></td>
            <td style="text-align:right"><?php echo $ex->qty_simpati_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_as_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_loop_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_mentari_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_im3_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_xl_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_tri_marketshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_smartfrend_marketshare ?></td>
            <td style="text-align:right"><?php echo $total ?></td>
            <td style="text-align:right"><?php echo $tel . "%"?></td>
            <td style="text-align:right"><?php echo $ind . "%"?></td>
            <td style="text-align:right"><?php echo $xl . "%"?></td>
            <td style="text-align:right"><?php echo $tri . "%"?></td>
            <td style="text-align:right"><?php echo $smart . "%"?></td>
            <td style="text-align:right"><?php echo $persentage . "%"?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Laporan Rechargeshare</h2>
    <table>
        <thead>
            <tr style="text-align: center">         
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Kecamatan</th>
                <th colspan="3">Mount Telkomsel</th>
                <th colspan="2">Mount Indosat</th>
                <th rowspan="2">Mount XL</th>
                <th rowspan="2">Mount Tri</th>
                <th rowspan="2">Mount Smartfrend</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Presentase Telkomsel</th>
                <th rowspan="2">Presentase Indosat</th>
                <th rowspan="2">Presentase XL</th>
                <th rowspan="2">Presentase Tri</th>
                <th rowspan="2">Presentase Smartfrend</th>
                <th rowspan="2">Total Presentase</th>
            </tr>
            <tr>
                <th>Simpati</th>
                <th>AS</th>
                <th>Loop</th>
                <th>Mentari</th>
                <th>IM3</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
        <?php foreach($recharge as $ex) : ?>
        <tr>
            <?php
            $total = $ex->mount_telkomsel_rechargeshare + $ex->mount_indosat_rechargeshare + $ex->mount_xl_rechargeshare + $ex->mount_tri_rechargeshare + $ex->mount_smartfrend_rechargeshare;
            $tel = round(($ex->mount_telkomsel_rechargeshare / $total) * 100, 2);
            $ind = round(($ex->mount_indosat_rechargeshare / $total) * 100, 2);
            $xl = round(($ex->mount_xl_rechargeshare / $total) * 100, 2);
            $tri = round(($ex->mount_tri_rechargeshare / $total) * 100, 2);
            $smart = round(($ex->mount_smartfrend_rechargeshare / $total) * 100, 2);
            $persentage = round($tel + $ind + $xl + $tri + $smart);
            ?>
            <td><?php echo $no ?></td>
            <td><?php echo $ex->tanggal ?></td>
            <td><?php echo $ex->kecamatan ?></td>
            <td style="text-align:right"><?php echo $ex->mount_simpati_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $ex->mount_as_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $ex->mount_loop_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $ex->mount_mentari_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $ex->mount_im3_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $ex->mount_xl_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $ex->mount_tri_rechargeshare ?></td>
            <td style="text-align:right"><?php echo $total ?></td>
            <td style="text-align:right"><?php echo $total ?></td>
            <td style="text-align:right"><?php echo $tel . "%"?></td>
            <td style="text-align:right"><?php echo $ind . "%"?></td>
            <td style="text-align:right"><?php echo $xl . "%"?></td>
            <td style="text-align:right"><?php echo $tri . "%"?></td>
            <td style="text-align:right"><?php echo $smart . "%"?></td>
            <td style="text-align:right"><?php echo $persentage . "%"?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Laporan Salesshare</h2>
    <table>
        <thead>
            <tr style="text-align: center">         
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Kecamatan</th>
                <th colspan="3">QTY Telkomsel</th>
                <th colspan="2">QTY Indosat</th>
                <th rowspan="2">QTY XL</th>
                <th rowspan="2">QTY Tri</th>
                <th rowspan="2">QTY Smartfrend</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Presentase Telkomsel</th>
                <th rowspan="2">Presentase Indosat</th>
                <th rowspan="2">Presentase XL</th>
                <th rowspan="2">Presentase Tri</th>
                <th rowspan="2">Presentase Smartfrend</th>
                <th rowspan="2">Total Presentase</th>
            </tr>
            <tr>
                <th>Simpati</th>
                <th>AS</th>
                <th>Loop</th>
                <th>Mentari</th>
                <th>IM3</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
        <?php foreach($sales as $ex) : ?>
        <tr>
            <?php
            $total = $ex->qty_telkomsel_salesshare + $ex->qty_indosat_salesshare + $ex->qty_xl_salesshare + $ex->qty_tri_salesshare + $ex->qty_smartfrend_salesshare;
            $tel = round(($ex->qty_telkomsel_salesshare / $total) * 100, 2);
            $ind = round(($ex->qty_indosat_salesshare / $total) * 100, 2);
            $xl = round(($ex->qty_xl_salesshare / $total) * 100, 2);
            $tri = round(($ex->qty_tri_salesshare / $total) * 100, 2);
            $smart = round(($ex->qty_smartfrend_salesshare / $total) * 100, 2);
            $persentage = round($tel + $ind + $xl + $tri + $smart);
            ?>
            <td><?php echo $no ?></td>
            <td><?php echo $ex->tanggal ?></td>
            <td><?php echo $ex->kecamatan ?></td>
            <td style="text-align:right"><?php echo $ex->qty_simpati_salesshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_as_salesshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_loop_salesshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_mentari_salesshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_im3_salesshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_xl_salesshare ?></td>
            <td style="text-align:right"><?php echo $ex->qty_tri_salesshare ?></td>
            <td style="text-align:right"><?php echo $total ?></td>
            <td style="text-align:right"><?php echo $total ?></td>
            <td style="text-align:right"><?php echo $tel . "%"?></td>
            <td style="text-align:right"><?php echo $ind . "%"?></td>
            <td style="text-align:right"><?php echo $xl . "%"?></td>
            <td style="text-align:right"><?php echo $tri . "%"?></td>
            <td style="text-align:right"><?php echo $smart . "%"?></td>
            <td style="text-align:right"><?php echo $persentage . "%"?></td>
        </tr>
        <?php $no++; ?>
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