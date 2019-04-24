<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_parts/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_parts/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_parts/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_parts/breadcrumb.php") ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/superuser/user/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama User</th>
										<th>Level</th>
										<th>TDC</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($user as $u): ?>
									<tr>
										<td width="150">
											<?php echo $u->nama_user ?>
										</td>
										<td class="small">
											<?php echo $u->level ?>
										</td>
										<td class="small">
											<?php echo $u->nama_tdc ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('admin/superuser/user/edit/'.$u->kode_user) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<!-- <a onclick="deleteConfirm('<?php echo site_url('admin/superuser/user/remove/'.$u->kode_user) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Remove</a> -->
											<a href="<?php echo site_url('admin/superuser/user/detail/'.$u->kode_user) ?>" 
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
			    <?php $this->load->view("admin/_parts/footer.php") ?>
            </div>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_parts/scrolltop.php") ?>
	<?php $this->load->view("admin/_parts/modal.php") ?>

	<?php $this->load->view("admin/_parts/js.php") ?>

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
