<form method="post" action="" class="backend-product">
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
			</div><!-- /.box-body -->
		</div>
		<div class="wrap-scroll-va bg-white">
            <ul class="nav nav-pills mb-3  uk-flex uk-flex-wrap" id="pills-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link " id="general-info-tab" data-toggle="pill" href="#general-info" role="tab" aria-controls="general-info" aria-selected="true">Thông tin cơ bản</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="album-tab" data-toggle="pill" href="#album" role="tab" aria-controls="album" aria-selected="true">Album ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="wholesale-tab" data-toggle="pill" href="#wholesale" role="tab" aria-controls="wholesale" aria-selected="true">Giá bán buôn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="version-tab" data-toggle="pill" href="#version" role="tab" aria-controls="version" aria-selected="true">Phiên bản sản phẩm</a>
                </li>
            </ul>
        </div>
        <div class="tab-content tab-by-va" id="pills-tabContent">
        	<div class="tab-pane active" id="general-info" role="tabpanel" aria-labelledby="general-info-tab">
				<?php echo view('backend/product/product/common/general_info') ?>
        	</div>
        	<div class="tab-pane" id="album" role="tabpanel" aria-labelledby="album-tab">
				<?php echo view('backend/product/product/common/album') ?>
        	</div>
        	<div class="tab-pane" id="wholesale" role="tabpanel" aria-labelledby="wholesale-tab">
				<?php echo view('backend/product/product/common/wholesale') ?>
        	</div>
        	<div class="tab-pane" id="version" role="tabpanel" aria-labelledby="version-tab">
				<?php echo view('backend/product/product/common/attribute_product') ?>
        	</div>
        </div>
	</div>
</form>


<div id="product_add_brand" class="modal fade">
      <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                    <div class="uk-flex uk-flex-space-between uk-flex-middle" >
                       <h4 class="modal-title">Tạo Thương hiệu mới cho Sản phẩm</h4>
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_form">
                    	<div class="uk-flex uk-flex-middle ">
                    		<div class="brand-avatar">
                    			<div class="form-row">
									<div class="avatar" style="cursor: pointer;"><img src="public/not-found.png" class="img-thumbnail" alt=""></div>
									<?php echo form_input('brand_img', htmlspecialchars_decode(html_entity_decode(set_value('image'))), 'class="form-control " placeholder="Đường dẫn của ảnh"  id="brand_img"  autocomplete="off" style="display:none;" ');?>
								</div>
                    		</div>
                    		<div class="brand-content">
                    			<label>Tiêu đề Thương hiệu</label>
		                        <input type="text" name="brand_title" id="brand_title" class="form-control" />
		                        <input type="hidden" name="brand_canonical" id="brand_canonical" class="form-control" />
		                        <br />
		                        <label>Nhãn hiệu</label>
		                        <input type="text" name="keyword" id="keyword" class="form-control" />
		                        <br />
		                        <input type="submit" name="insert" id="insert" value="Thêm mới" class="btn btn-success " />
                    		</div>
                    	</div>
                    </form>
                </div>
           </div>
      </div>
 </div>

 <div id="product_add_attribute" class="modal inmodal fade">
      <div class="modal-dialog modal-xl">
           <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Thêm mới thuộc tính</h4>
					<small class="font-bold text-danger">Cập nhật đầy đủ thông tin người dùng giúp việc quản lý dễ dàng hơn</small>
				</div>
				<div class="modal-body p-md">
					<form method="post" id="attribute_form">
						<div class="row">
							<div class="box-body error hidden">
								<div class="alert alert-danger"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
							<label class="col-md-4">
								<div class=" control-label">
									<span class="m-r">Tên thuộc tính <b class="text-danger">(*)</b></span>
								</div>
							</label>
							<div class="col-md-8">
								<input type="text" name="title" value="" id="modal_attribute_title" class="form-control " placeholder="" autocomplete="off">
							</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="col-md-4">
									<div class=" control-label">
										<span class="m-r">Nhóm thuộc tính <b class="text-danger">(*)</b></span>
									</div>
								</label>
								<div class="col-md-8">
									<select name="catalogueid_modal" class="form-control input-sm perpage  catalogueid_modal select2" style="width:100%" >
										<?php
											if(isset($attribute_catalogue) && is_array($attribute_catalogue) && count($attribute_catalogue)){
												array_unshift($attribute_catalogue,[
													'title' => '---Chọn nhóm thuộc tính---',
													'objectid' => 'root'
												]);
												foreach ($attribute_catalogue as $key => $value) {
										 ?>
											<option value="<?php echo $value['objectid'] ?>"><?php echo $value['title'] ?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Thêm mới</button>
						</div>
					</form>
				</div>


			</div>
      </div>
 </div>



<!-- ==================================================== Modal ============================================================ -->

<div class="modal fade modal_version" id="openModalDetail">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header ">
	      		<div class="uk-flex uk-flex-middle uk-flex-space-between">
		        	<h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa chi tiết phiên bản sản phẩm</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	      	<form method="post" action="" id="render_input_version" class="submit_version">
		      	<div class="modal-body">
		      		<div class="row mb15">
		      			<div class="col-lg-6">
		      				<div class="form-row">
		      					<label class="control-label ">
									<span>BarCode</span>
								</label>
								<input type="text" name="barcode_version[]" value="" class="form-control modal_barcode_version" autocomplete="off">
		      				</div>
		      			</div>
		      			<div class="col-lg-6">
		      				<div class="form-row">
		      					<label class="control-label ">
									<span>Model</span>
								</label>
								<input type="text" name="model_version[]" value="" class="form-control modal_model_version" autocomplete="off">
		      				</div>
		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="col-lg-12">
		      				<div class="form-row">

								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label ">
										<span>Album sản phẩm</span>
									</label>
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<div class="edit">
											<a onclick="BrowseServerAlbumModal($(this), '<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>');return false;" href="" title="" class="upload-picture">Chọn hình</a>
										</div>
									</div>
								</div>

								<div class="click-to-upload" >
									<div class="icon">
										<a type="button" class="upload-picture" onclick="BrowseServerAlbumModal($(this), '<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>');return false;">
											<svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
										</a>
									</div>
									<div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
								</div>
								<div class="upload-list"  style="padding:5px; display: none;">
									<div class="row">
										<ul class="clearfix sortui sort-modal">

										</ul>
									</div>
								</div>
								<div class="pull-right"><button type="submit" class="btn btn-primary block m-b pull-right mt30 ">Lưu</button></div>
								<?php if(isset($method) && $method == 'update'){ ?>
									<div class="pull-right mr10">
										<button type="button" class="btn btn-open-modal  btn-success block m-b pull-right mt30" data-toggle="modal" onclick="detail_version($(this))" data-title="" data-canonical="" data-target="#openDetailProduct" >Phiên bản nâng cao</button>
									</div>
								<?php } ?>
		      				</div>
		      			</div>
		      		</div>
		      	</div>
	      	</form>
    	</div>
  	</div>
</div>
