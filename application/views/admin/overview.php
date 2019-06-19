<!DOCTYPE html>
<html lang="en">

  <head>
    <?php $this->load->view("admin/_parts/head.php") ?>
  </head>
   
  <body class="theme-red">

    <?php $this->load->view("admin/_parts/navbar.php") ?>
    <?php $this->load->view("admin/_parts/sidebar.php") ?>

    <section class="content">
        <div class="container-fluid">

         <!-- Area Chart Example-->
          <!-- <div class="card">
            <div class="header">
            <h2><i class="material-icons">bar_chart</i> Performansi : <?php echo date('F Y') ?></h2>
            <div id="responsecontainer" text-align="center"></div>
            <form class="form-horizontal" action="<?php echo site_url('admin/overview/getperformance') ?>" method="post" id="form_advanced_validation">
                <div class="col-md-3">
                    <div class="form-group form-float">
                        <div class="form-line">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai" id="nama" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-float">
                        <div class="form-line" id="bs_datepicker_container">
                            <input class="form-control" type="text" name="awal"/>
                            <label class="form-label" for="awal">Tanggal Periode Awal*</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-float">
                        <div class="form-line" id="bs_datepicker_container">
                            <input class="form-control" type="text" name="akhir"/>
                            <label class="form-label" for="akhir">Tanggal Periode Akhir*</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"><input type="submit" id="sendAjax" class="btn btn-primary waves-effect" value="Tampil" /></div>
            </form>  
            <div class="clearfix"></div>
            <div class="body">
              <canvas id="canvas" width="100%" height="30"></canvas>  
            </div>
          </div>
        </div> -->
    </section>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("admin/_parts/scrolltop.php") ?>

    <?php $this->load->view("admin/_parts/modal.php") ?>
    <?php $this->load->view("admin/_parts/js.php") ?>
    
  <script>
     var ctx = document.getElementById("canvas").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ['New Opening Outlet', 'Outlet Aktif Digital', 'Outlet Aktif Voucher', 'Outlet Aktif Bang Tcash', 'Sales Perdana', 'NSB', 'MKIOS Reguler', 'MKIOS Bulk', 'GT Pulsa'],
                datasets: [{
                    label: 'Performansi <?php echo $perform->nama_marketing ? $perform->nama_marketing : ""  . " Bulan " . $perform->bulan ? $perform->bulan : "" ?>',
                    data: [
                        <?php echo $perform->new_opening_outlet ? $perform->new_opening_outlet : "" ?>,
                        <?php echo $perform->outlet_aktif_digital ? $perform->outlet_aktif_digital : "" ?>,
                        <?php echo $perform->outlet_aktif_voucher ? $perform->outlet_aktif_voucher : "" ?>,
                        <?php echo $perform->outlet_aktif_bang_tcash ? $perform->outlet_aktif_bang_tcash : "" ?>,
                        <?php echo $perform->sales_perdana ? $perform->sales_perdana : "" ?>,
                        <?php echo $perform->nsb ? $perform->nsb : "" ?>,
                        <?php echo $perform->mkios_reguler ? $perform->mkios_reguler : "" ?>,
                        <?php echo $perform->mkios_bulk ? $perform->mkios_bulk : "" ?>,
                        <?php echo $perform->gt_pulsa ? $perform->gt_pulsa : "" ?>
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
  </script>
  </body>

</html>
