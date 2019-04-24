<!DOCTYPE html>
<html>

<head>
<?php $this->load->view("indirect/_parts/head.php") ?>
</head>

<body class="theme-red">
    <?php $this->load->view("indirect/_parts/navbar.php") ?>

    <?php $this->load->view("indirect/_parts/sidebar.php") ?>

    <section class="content">
        <div class="container-fluid">
        <div class="col-lg-12"> 
        <!-- Area Chart Example-->

        <div class="card">
            <div class="header">
                <h2><i class="material-icons">bar_chart</i> Performansi : <?php echo isset($perform->nama_marketing) ? $perform->nama_marketing . " Bulan " . $perform->bulan : "" ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="body">
            <canvas id="canvas" width="100%" height="30"></canvas>
            </div>
        </div>        
    </section>

    <?php $this->load->view("indirect/_parts/js.php") ?>
    
    <script>
        /** CHART PER KARYAWAN */

        var perf_json = JSON.parse(<?php echo "'" . json_encode(isset($perform) ? $perform : false) . "'" ?>);
        
        delete perf_json.bulan;
        delete perf_json.nama_marketing;
        delete perf_json.tahun;
        delete perf_json.kode_marketing;
        console.log(perf_json);
        
        var ctx = document.getElementById("canvas").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: Object.keys(perf_json),
                datasets: [{
                    label: 'Performansi <?php echo isset($perform->nama_marketing) ? $perform->nama_marketing : "" ?> ',
                    data: Object.values(perf_json),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1,
                }]
            },
            options: {
                "hover": {
                    "animationDuration": 0
                },
                "animation": {
                    "duration": 1,
                    "onComplete": function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'center';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                    }
                },
                tooltips: {
                    "enabled": false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            max: 100
                        }
                    }]
                }
            }
        });


    </script>
    
</body>

</html>
