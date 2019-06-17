<!DOCTYPE html>
<html lang="en">

  <head>
    <?php $this->load->view("admindirect/_parts/head.php") ?>
  </head>
   
  <body class="theme-red">

    <?php $this->load->view("admindirect/_parts/navbar.php") ?>

    <?php $this->load->view("admindirect/_parts/sidebar.php") ?>

      <section class="content">
        <div class="container-fluid">
         <!-- Area Chart Example-->
          <div class="row">
            <div class="card mb-3">
              <div class="header">
                <i class="material-icons"></i>
                Performansi : Januari 2019
              </div>
              <div class="body">
                <canvas id="myBarChart" width="100%" height="30"></canvas>
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php $this->load->view("admindirect/_parts/js.php") ?>
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
            foreach ($admindirect as $dr) {
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
              foreach ($admindirect as $dr) {
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
