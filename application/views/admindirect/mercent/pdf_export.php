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
          table {
            border-spacing: 0;
            border: 0.2px solid #000;
          }
          td, th {
            padding:0;
            border: 0.2px solid #000;   
          }
          thead {
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
          .img-cell {
            border: none;
            height: 90px;
          }
          .no_border_bottom {
            border: none;
          }
        </style>
    <head>
    <body>
        <h2>Laporan Mercent</h2>
        <?php foreach($export as $exp) : ?>
          <table>
            <tr>
              <th>Tanggal</th><td><?php echo $exp->tanggal ?></td>
              <th>No HP Pic</th><td style="text-align:right"><?php echo $exp->no_hp_pic ?></td>
              <th colspan="5">Gambar</th>
            </tr>
            <tr>
              <th>Nama TDC</th><td><?php echo $exp->nama_tdc ?></td>
              <th>No KTP</th><td style="text-align:right"><?php echo $exp->no_ktp ?></td>
            </tr>
            <tr>
              <th>Nama Marketing</th><td><?php echo $exp->nama_marketing ?></td>
              <th>NPWP</th><td style="text-align:right"><?php echo $exp->npwp ?></td>
              <?php
              $i = 0;
              if ($exp->foto_mercent != null && json_decode($exp->foto_mercent) != JSON_ERROR_NONE) :
                foreach (json_decode($exp->foto_mercent) as $im):?>
                  <?php 
                  if ($i <= 5) : ?>
                    <td class="img-cell" rowspan="4"><img src="<?= base_url('upload/mercent/'.$im->file_name) ?>" width="100" style="display:inline;margin:5px" /></td>
                  <?php else : ?>
                    <td class="img-cell" rowspan="4"><img src="<?= base_url('upload/mercent/default.png') ?>" width="100" style="display:inline;margin:5px" /></td>  
                  <?php endif;
                  $i++;
                endforeach; 
              else : ?>
                <td class="img-cell" rowspan="4"><img src="<?= base_url('upload/mercent/default.png') ?>" width="100" style="display:inline;margin:5px" /></td>
              <?php endif;?>
            </tr>
            <tr>
              <th>Nama Mercent</th><td><?php echo $exp->nama_mercent ?></td>
              <th>Longtitude</th><td style="text-align:right"><?php echo $exp->longtitude ?></td>
            </tr>
            <tr>
              <th>Nama Pic</th><td><?php echo $exp->nama_pic ?></td>
              <th>Latitude</th><td style="text-align:right"><?php echo $exp->latitude ?></td>
            </tr>
            <tr>
              <th>Alamat</th><td><?php echo $exp->alamat ?></td>
              <th>Produk diajukan</th><td><?php echo $exp->produk_diajukan ?></td>
            </tr>
          </table>
          <br><br>
        <?php endforeach; ?>
        <br><br><br>
        <table class="ttd" style="border:none !important">
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