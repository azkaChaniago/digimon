<!DOCTYPE html>
<html>

<head>
<?php $this->load->view("adminindirect/_parts/head.php") ?>
</head>

<body class="theme-red">
    <?php $this->load->view("adminindirect/_parts/navbar.php") ?>

    <?php $this->load->view("adminindirect/_parts/sidebar.php") ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2><i class="material-icons">bar_chart</i> Performansi : <?php echo isset($perform->nama_marketing) ? $perform->nama_marketing . " Bulan " . $perform->bulan : "" ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="body">
                        <canvas id="canvas" width="100%" height="30"></canvas>
                        </div>
                    </div>        
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2><i class="material-icons">bar_chart</i> Performansi : <?php echo isset($perform->nama_marketing) ? $perform->nama_marketing . " Bulan " . $perform->bulan : "" ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="body">
                        <canvas id="progress" width="100%" height="30"></canvas>
                        </div>
                    </div>       
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class="material-icons">bar_chart</i> Performansi : <?php echo isset($perform->nama_marketing) ? $perform->nama_marketing . " Bulan " . $perform->bulan : "" ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr><th colspan="5" class="text-center">TARGET ASSIGNMENT</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>TAHUN</th>
                                            <th>BULAN</th>
                                            <th>NEW RS NON OUTLET</th>
                                            <th>NSB</th>
                                            <th>GT PULSA</th>
                                            <th>MKIOS Regular</th>
                                        </tr>
                                        <tr>
                                            <?php foreach ($targetassignment as $target) :
                                            echo "<td>" . date('Y', strtotime($target->tanggal)) . "</td>";
                                            echo "<td>" . date('F', strtotime($target->tanggal)) . "</td>";
                                            echo "<td style='text-align:right'>$target->new_rs_non_outlet</td>";
                                            echo "<td style='text-align:right'>$target->nsb</td>";
                                            echo "<td style='text-align:right'>$target->gt_pulsa</td>";
                                            echo "<td style='text-align:right'>$target->collecting</td>";
                                            endforeach;?>
                                        </tr>
                                        <tr><th colspan="5" class="text-center">SCORE CARD</th></tr>
                                        <?php foreach($scorecard as $score):
                                            echo "<tr>";
                                            echo "<td colspan='2'>" . date('d F Y', strtotime($score->tanggal)) . "</td>";
                                            echo "<td style='text-align:right'>$score->new_rs_non_outlet</td>";
                                            echo "<td style='text-align:right'>$score->nsb</td>";
                                            echo "<td style='text-align:right'>$score->gt_pulsa</td>";
                                            echo "<td style='text-align:right'>$score->collecting</td>";
                                            echo "</tr>";
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
            </div>
        </div>
    </section>

    <?php $this->load->view("adminindirect/_parts/js.php") ?>
    
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
                },
                plugins: {
					datalabels: {
						color: '#000',
						display: true,
						align: 'center',
						anchor: 'center',
                        formatter: val => Math.round(val) + '%'
					}
				}
            }
        });

        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const target_assignment = <?= $ta ?>;
        const score_card = <?= $sc ?>;
        const d = new Date(target_assignment[2].tanggal);
        console.log(monthNames[new Date(target_assignment[2].tanggal).getMonth()])

        const kpi = target_assignment.map( (item, k) => {
            if (typeof score_card[k] === 'undefined') {
                return 0;
            } else {
                return Number(((((item.new_rs_non_outlet / score_card[k].new_rs_non_outlet) * 25) / 100) +
                    (((item.nsb / score_card[k].nsb) * 25) / 100) +
                    (((item.gt_pulsa / score_card[k].gt_pulsa) * 25) / 100) +
                    (((item.collecting  / score_card[k].collecting ) * 25) / 100)).toFixed(2));
            }
        })

        var cty = document.getElementById("progress").getContext('2d');
        var myLineChart = new Chart(cty, {
            type: 'line',
            data: {
                labels: target_assignment.map(k => monthNames[new Date(k.tanggal).getMonth()]),
                datasets: [{
                    label: 'Performansi <?php echo isset($progress->bulan) ? $progress->bulan : "" ?> ',
                    data: kpi.map(k => k),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1,
                }]
            },
            options: {
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
                },
                plugins: {
					datalabels: {
						color: '#000',
						display: true,
						align: 'center',
						anchor: 'center',
					}
				}
            }
        });


    </script>
    
</body>

</html>
