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
            <!-- Area Chart Example-->
            <div class="card">
                <div class="header">
                    <h2>KPI Canvasser Bulan <?php echo isset($kpi_canvasser[0]->bulan) ? $kpi_canvasser[0]->bulan : date('F')?> </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form method="post" action="<?php base_url('indirect/indirect') ?>">
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input class="form-control" type="text" name="awal" required/>
                                        <label class="form-label">Periode Awal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group form-float">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input class="form-control" type="text" name="akhir" required/>
                                        <label class="form-label">Periode Akhir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input class="btn btn-primary waves-effect" type="submit" value="TAMPIL" name="tampil_can"/>
                            </div>
                        </form>
                    </div>
                    <canvas id="canvasser" width="100%" height="30"></canvas>
                </div>
            </div>  

            <div class="card">
                <div class="header">
                    <h2>KPI Collector Bulan <?php echo isset($kpi_collector[0]->bulan) ? $kpi_collector[0]->bulan : date('F')?></h2>
                </div>
                <div class="body">
                    <div class="row">
                        <form method="post" action="<?php base_url('indirect/indirect') ?>">
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input class="form-control" type="text" name="awal" required/>
                                        <label class="form-label">Periode Awal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group form-float">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input class="form-control" type="text" name="akhir" required/>
                                        <label class="form-label">Periode Akhir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input class="btn btn-primary waves-effect" type="submit" value="TAMPIL" name="tampil_col"/>
                            </div>
                        </form>
                    </div>
                    <canvas id="collector" width="100%" height="30"></canvas>
                </div>
            </div>
            
       <!-- <div id="responsecontainer" text-align="center"></div> -->
            <?php if($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>       
        </div>
    </section>

    <?php $this->load->view("indirect/_parts/js.php") ?>
    
    <script>
        /**
        * sends a request to the specified url from a form. this will change the window location.
        * @param {string} path the path to send the post request to
        * @param {object} params the paramiters to add to the url
        * @param {string} [method=post] the method to use on the form
        */
        function post(path, params, method) {
            method = method || 'post';

            var form = document.createElement("form");
            form.setAttribute('method', method);
            form.setAttribute('action', path);

            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement('input');
                    hiddenField.setAttribute('type', 'hidden');
                    hiddenField.setAttribute('name', key);
                    hiddenField.setAttribute('value', params[key]);

                    form.appendChild(hiddenField);
                }
            }
            document.body.appendChild(form);
            form.submit();
        }
        
        var data_kpi = JSON.parse(<?php echo "'" . json_encode(($kpi_canvasser)) . "'" ?>);
        // console.log(data_kpi.map(k => k.nama_marketing));     
        console.log(data_kpi)
        var backgroundColor = [];
		var borderColor = [];
		var i = 0;
		while(i < data_kpi.map(k => k.nama_marketing).length) {
			var randR = Math.floor((Math.random()* 130) + 100);
			var randG = Math.floor((Math.random()* 130) + 100);
			var randB = Math.floor((Math.random()* 130) + 100);
			var graphColor = "rgb("+ randR +","+ randG +","+ randB +")";
			backgroundColor.push(graphColor);
			var outlineColor = "rgb("+ (randR - 80) +","+ (randG - 80) +","+ (randB - 80) +")";
			borderColor.push(outlineColor);
			i++;
		}

        var kpiChart = document.getElementById('canvasser').getContext('2d');
        var kpi_ch = new Chart(kpiChart, {
            type: 'bar',
            data: {
                labels: data_kpi.map(k => k.nama_marketing),
                datasets: [{
                    label: 'Total KPI Canvasser',
                    data: data_kpi.map(k => k.total_kpi),
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            max: 1
                        }
                    }]
                }
            }
        });
        var can_month = data_kpi.map(k => k.bulan)[0];
        
        document.getElementById("canvasser").onclick = function(evt){
            var activePoints = kpi_ch.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = kpi_ch.data.labels[firstPoint._index];
            data_kpi.map(function(e){
                lbl = e.kode_marketing;
                date = e.tanggal;
                post(<?php echo site_url('indirect/canperformance'); ?>, {kode_marketing: lbl, tanggal: date}));
            });
            window.location.href = "<?php echo site_url('indirect/indirect/canperformance/') ?>" + label + "/" + can_month;
        };


        var data_collector = JSON.parse(<?php echo "'" . json_encode(($kpi_collector)) . "'" ?>);
        console.log(data_collector.map(k => k.nama_marketing));     
        
        var backgroundColor = [];
		var borderColor = [];
		var i = 0;
		while(i < data_collector.map(k => k.nama_marketing).length) {
			var randR = Math.floor((Math.random()* 130) + 100);
			var randG = Math.floor((Math.random()* 130) + 100);
			var randB = Math.floor((Math.random()* 130) + 100);
			var graphColor = "rgb("+ randR +","+ randG +","+ randB +")";
			backgroundColor.push(graphColor);
			var outlineColor = "rgb("+ (randR - 80) +","+ (randG - 80) +","+ (randB - 80) +")";
			borderColor.push(outlineColor);
			i++;
		}

        var colChart = document.getElementById('collector').getContext('2d');
        var kpi_col = new Chart(colChart, {
            type: 'bar',
            data: {
                labels: data_collector.map(k => k.nama_marketing),
                datasets: [{
                    label: 'Total KPI Collector',
                    data: data_collector.map(k => k.total_kpi),
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            max: 1
                        }
                    }]
                }
            }
        });
        var col_month = data_collector.map(k => k.bulan)[0];
        document.getElementById("collector").onclick = function(evt){
            var activePoints = kpi_col.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = kpi_col.data.labels[firstPoint._index];
            // var value = kpi_col.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            window.location.href = "<?php echo site_url('indirect/indirect/colperformance/') ?>" + label + "/" + col_month;
        };

    </script>
    
</body>

</html>
