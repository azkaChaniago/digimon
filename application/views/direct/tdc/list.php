<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/direct/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/direct/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/direct/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/direct/_parts/breadcrumb.php") ?>

				<div class="card mb-3">
					<div class="card-header">
						<h2>TDC</h2><hr>
						<a href="<?php echo site_url('direct/tdc/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama TDC</th>
										<th>Manager</th>
										<th>No Telepon</th>
										<th>No Callcenter</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tdc as $t): ?>
									<tr>
										<td width="150">
											<?php echo $t->nama_tdc ?>
										</td>
										<td class="small">
											<?php echo $t->manager ?>
										</td>
										<td class="small">
											<?php echo $t->no_telepon ?>
										</td>
										<td class="small">
											<?php echo $t->no_callcenter ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('direct/tdc/edit/'.$t->kode_tdc) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('direct/tdc/remove/'.$t->kode_tdc) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Remove</a>
											<a href="<?php echo site_url('direct/tdc/detail/'.$t->kode_tdc) ?>" 
											 class="btn btn-small text-success"><i class="fas fa-info"></i> Detail</a>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			    <!-- Sticky Footer -->
			    <?php $this->load->view("admin/direct/_parts/footer.php") ?>
            </div>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/direct/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/direct/_parts/modal.php") ?>

	<?php $this->load->view("admin/direct/_parts/js.php") ?>

	<script>

		function deleteConfirm(url){
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}

		$('[data-toggle="collapse"]').on('click', function() {
            var $this = $(this),
                    $parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;
            if($parent === undefined) { /* Just toggle my  */
                $this.find('.fas').toggleClass('fa-plus fa-minus');
                return true;
            }

            /* Open element will be close if parent !== undefined */
            var currentIcon = $this.find('.fas');
            currentIcon.toggleClass('fa-plus fa-minus');
            $parent.find('.fas').not(currentIcon).removeClass('fa-minus').addClass('fa-minus');

        });

	</script>

</body>

</html>
