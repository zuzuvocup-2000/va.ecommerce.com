<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Cập nhật Voucher</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url('admin'); ?>">Home</a>
			</li>
			<li class="active"><strong>Cập nhật Voucher</strong></li>
		</ol>
	</div>
</div>
<?php echo view('backend/product/voucher/store',  ['method' => $method]) ?>
