<!DOCTYPE html>
<html lang="en">

  <head>
    <?php $this->load->view("direct/_parts/head.php") ?>
  </head>
   
  <body class="theme-red">

    <?php $this->load->view("direct/_parts/navbar.php") ?>

    <?php $this->load->view("direct/_parts/sidebar.php") ?>

      <div class="content">
        <div class="container-fluid">
         <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Performansi : Januari 2019
            </div>
            <div class="card-body">
              <canvas id="myBarChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div>
      <?php $this->load->view("direct/_parts/js.php") ?>
    <script>
      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#292b2c';

      // Bar Chart Example
      var ctx = document.getElementById("myBarChart");
      var myLineChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: [
            <?php 
            foreach ($direct as $dr) {
                echo "'" . $dr->nama_marketing . "',";
            }
          ?>
          ],
          datasets: [{
          label: "Performansi",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: [
              <?php 
              foreach ($direct as $dr) {
                echo "'" . $dr->jumlah_outlet . "',";
              }
              ?>
          ],
          }],
      },
      options: {
          scales: {
          xAxes: [{
              time: {
              unit: 'month'
              },
              gridLines: {
              display: false
              },
              ticks: {
              maxTicksLimit: 6
              }
          }],
          yAxes: [{
              ticks: {
              min: 0,
              max: 15000,
              maxTicksLimit: 5
              },
              gridLines: {
              display: true
              }
          }],
          },
          legend: {
          display: true
          }
      }
      });
  </script>
  </body>

</html>
