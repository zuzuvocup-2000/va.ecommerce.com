<?php
helper('form', 'data');
$baseController = new App\Controllers\BaseController();
$get_catalogue = check_type_canonical($language);
if($get_catalogue['content'] == 'silo'){
	$class = 'get_catalogue';
}else{
	$class = '';
}
	$model = new App\Models\AutoloadModel();
?>
<div class="row">
	<div class="col-lg-8 clearfix">
		<div class="ibox mb20">
			<div class="ibox-title" style="padding: 9px 15px 0px;">
				<div class="uk-flex uk-flex-middle uk-flex-space-between">
					<h5>Thông tin cơ bản <small class="text-danger">Điền đầy đủ các thông tin được mô tả dưới đây</small></h5>
					<div class="ibox-tools">
						<button type="submit" name="create" value="create" class="btn btn-primary block full-width m-b">Lưu</button>
					</div>
				</div>
			</div>
			<div class="ibox-content">
				<div class="row mb15">
					<div class="col-lg-12">
						<div class="form-row">
							<label class="control-label text-left">
								<span>Tiêu đề Sản phẩm <b class="text-danger">(*)</b></span>
							</label>
							<?php echo form_input('title', validate_input(set_value('title', (isset($product['title'])) ? $product['title'] : '')), 'class="form-control '.(($method == 'create') ? 'title' : '').'" placeholder="" id="title" autocomplete="off"'); ?>
						</div>
					</div>
				</div>
				<div class="row mb15">
					<div class="col-lg-12">
						<div class="form-row form-description">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<label class="control-label text-left">
									<span>Mô tả ngắn</span>
								</label>
								<a href="" title="" data-target="description" class="uploadMultiImage">Upload hình ảnh</a>
							</div>
							<?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', (isset($product['description'])) ? $product['description'] : ''))), 'class="form-control ck-editor" id="description" placeholder="" autocomplete="off"');?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12	">
						<div class="form-row mb15">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<label class="control-label text-left">
									<span>Nội dung</span>
								</label>
								<a href="" title="" data-target="content" class="uploadMultiImage">Upload hình ảnh</a>
							</div>
							<?php echo form_textarea('content', htmlspecialchars_decode(html_entity_decode(set_value('content', (isset($product['content'])) ? $product['content'] : ''))), 'class="form-control ck-editor" id="content" placeholder="" autocomplete="off"');?>
						</div>
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<label class="control-label text-left ">
								<span>Nội dung mở rộng</span>
							</label>
							<a href="" title="" class="add-attr" onclick="return false;">Thêm nội dung +</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox">
			<div class="row" id="sortable-view">
				<div class="col-lg-12 ui-sortable attr-more">
					<?php if(isset($product['sub_title']) && is_array($product['sub_title']) && count($product['sub_title'])){ ?>
					<?php foreach ($product['sub_title'] as $key => $value) {?>
					<?php $id = slug($value) ?>
					<div class="ibox desc-more" style="opacity: 1;">
						<div class="ibox-title ui-sortable-handle ">
							<div class="uk-flex uk-flex-middle row">
								<div class="col-lg-8">
									<input type="text" name="sub_content[title][]" class="form-control" value="<?php echo $value ?>" placeholder="Tiêu đề">
								</div>
								<div class="col-lg-4">
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<a href="" title="" data-target="<?php echo $id ?>" class="uploadMultiImage">Upload hình ảnh</a>
										<div class="ibox-tools">
											<a class="collapse-link ui-sortable">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a class="close-link">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="ibox-content" style="">
							<div class="row">
								<div class="col-lg-12" >
									<textarea name="sub_content[description][]" class="form-control ck-editor" id="<?php echo $id ?>" placeholder="Mô tả"><?php echo $product['sub_content'][$key] ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<?php }} ?>
				</div>
			</div>
		</div>
		
		<div class="ibox mb20 ">
			<div class="ibox-title">Ưu đãi Shock</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-row form-description">
							<?php echo form_textarea('shock', htmlspecialchars_decode(html_entity_decode(set_value('shock', (isset($product['shock'])) ? $product['shock'] : ''))), 'class="form-control ck-editor" id="shock" placeholder="" autocomplete="off"');?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox ibox-seo mb20">
			<div class="ibox-title">
				<div class="uk-flex uk-flex-middle uk-flex-space-between">
					<h5>Tối ưu SEO <small class="text-danger">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy bạn.</small></h5>
					<div class="uk-flex uk-flex-middle uk-flex-space-between">
						<div class="edit">
							<a href="#" class="edit-seo">Chỉnh sửa SEO</a>
						</div>
					</div>
				</div>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<?php
							$metaTitle = (isset($_POST['meta_title'])) ? $_POST['meta_title'] : ((isset($product['meta_title']) && $product['meta_title'] != '') ? $product['meta_title'] : 'Bạn chưa nhập tiêu đề SEO cho Sản phẩm') ;
							$googleLink = (isset($_POST['canonical'])) ? $_POST['canonical'] : ((isset($product['canonical']) && $product['canonical'] != '') ? BASE_URL.$product['canonical'].HTSUFFIX : BASE_URL.'duong-dan-website'.HTSUFFIX) ;
							$metaDescription = (isset($_POST['meta_description'])) ? $_POST['meta_description'] : ((isset($product['meta_description']) && $product['meta_description'] != '') ? $product['meta_description'] : 'Bạn Chưa nhập mô tả SEO cho Sản phẩm') ;
						?>
						<div class="google">
							<div class="g-title"><?php echo $metaTitle; ?></div>
							<div class="g-link"><?php echo $googleLink ?></div>
							<div class="g-description" id="metaDescription">
								<?php echo $metaDescription; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="seo-group hidden">
					<hr>
					<div class="row mb15">
						<div class="col-lg-12">
							<div class="form-row">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label ">
										<span>Tiêu đề SEO</span>
									</label>
									<span style="color:#9fafba;"><span id="titleCount">0</span> trên 70 ký tự</span>
								</div>
								<?php echo form_input('meta_title', htmlspecialchars_decode(html_entity_decode(set_value('meta_title', (isset($product['meta_title'])) ? $product['meta_title'] : ''))), 'class="form-control meta-title" placeholder="" autocomplete="off"');?>
							</div>
						</div>
					</div>
					<div class="row mb15">
						<div class="col-lg-12">
							<div class="form-row">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label ">
										<span>Mô tả SEO</span>
									</label>
									<span style="color:#9fafba;"><span id="descriptionCount">0</span> trên 320 ký tự</span>
								</div>
								<?php echo form_textarea('meta_description', set_value('meta_description', (isset($product['meta_description'])) ? $product['meta_description'] : ''), 'class="form-control meta-description" id="seoDescription" placeholder="" autocomplete="off"');?>
							</div>
						</div>
					</div>
					<div class="row mb15">
						<div class="col-lg-12">
							<div class="form-row">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label ">
										<span>Đường dẫn <b class="text-danger">(*)</b></span>
									</label>
								</div>
								<div class="outer">
									<div class="uk-flex uk-flex-middle">
										<div class="base-url"><?php echo base_url(); ?></div>
										<?php echo form_input('canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', (isset($product['canonical'])) ? $product['canonical'] : ''))), 'class="form-control canonical" placeholder="" autocomplete="off" data-flag="0" ');?>
										<?php echo form_hidden('original_canonical', htmlspecialchars_decode(html_entity_decode(set_value('original_canonical', (isset($product['canonical'])) ? $product['canonical'] : ''))), 'class="form-control canonical" placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" name="create" value="create" class="btn btn-primary block m-b pull-right">Lưu</button>
	</div>
	<div class="col-lg-4">
		<div class="ibox mb20">
			<div class="ibox-title">
				<h5>Lựa chọn danh mục cha </h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-row mb10">
							<small class="text-danger">Chọn [Root] Nếu không có danh mục cha</small>
						</div>
						<div class="form-row">
							<?php echo form_dropdown('catalogueid', $dropdown, set_value('catalogueid', (isset($product['catalogueid'])) ? $product['catalogueid'] : ''), 'data-module= "'.$module.'" class="form-control m-b select2 '.($method == 'create' ? $class : '').'"');?>
						</div>
						<script>
						var catalogue = '<?php echo (isset($_POST['catalogue'])) ? json_encode($_POST['catalogue']) : ((isset($product['catalogue']) && $product['catalogue'] != null) ? $product['catalogue'] : '');  ?>';
						</script>
						<div class="form-row mt20">
							<label class="control-label text-left">
								<span>Danh mục phụ</span>
							</label>
							<div class="form-row">
								<?php echo form_dropdown('catalogue[]', '', NULL, 'class="form-control selectMultiple" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm..."  style="width: 100%;" data-join="'.$module.'_translate" data-module="'.$module.'_catalogue" data-select="title"'); ?>
							</div>
						</div>
						<div class="form-row mt20">
							<label class="control-label text-left">
								<span>Chọn thời gian hết hạn Sản phẩm</span>
							</label>
							<div class="form-row">
								<?php echo form_input('time_end', htmlspecialchars_decode(html_entity_decode(set_value('time_end', (isset($product['time_end'])) ? $product['time_end'] : ''))), 'class="form-control simplepicker"  placeholder="" autocomplete="off" ');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox mb20 ">
			<div class="ibox-title"><h5>Iframe Video</h5></div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-row form-description">
							<?php echo form_textarea('video', htmlspecialchars_decode(html_entity_decode(set_value('video', (isset($product['video'])) ? $product['video'] : ''))), 'class="form-control" id="video" placeholder="" autocomplete="off"');?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox mb20 ">
			<div class="ibox-title uk-flex-middle uk-flex uk-flex-space-between">
				<h5 class="choose-image" style="cursor: pointer;margin:0;">Ảnh sản phẩm </h5>
				<a href="" title="" data-target="image" class="uploadIcon">Upload hình ảnh</a>
			</div>
			<div class="ibox-content">
				<div class="form-row">
					<?php echo form_input('icon', htmlspecialchars_decode(set_value('icon', (isset($product['icon'])) ? $product['icon'] : '')), 'class="form-control icon-display" placeholder="" autocomplete="off" data-flag="0" ');?>
				</div>
			</div>
		</div>
		<div class="ibox mb20 ">
			<div class="ibox-title"><h5>Thông tin cơ bản</h5></div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12 m-b">
						<div class="form-row">
							<label class="control-label text-left">
								<span>Giá Sản phẩm <b class="text-danger">(*)</b></span>
							</label>
							<?php echo form_input('price', validate_input(set_value('price', (isset($product['price'])) ? $product['price'] : '')), 'class="form-control price int" placeholder="" id="price" autocomplete="off"'); ?>
						</div>
					</div>
					<div class="col-lg-12 m-b">
						<label class="control-label ">
							<span>Giá khuyến mại</span>
						</label>
						<?php echo form_input('promotion_price', set_value('promotion_price', (isset($product['price_promotion'])) ? $product['price_promotion'] : ''), 'class="form-control price int" placeholder="" id="promotion_price" autocomplete="off"'); ?>
					</div>
					<div class="col-lg-12 mb15">
						<label class="control-label ">
							<span>Barcode</span>
						</label>
						<?php echo form_input('bar_code', set_value('bar_code', (isset($product['bar_code'])) ? $product['bar_code'] : ''), 'class="form-control" placeholder="" id="bar_code" autocomplete="off"'); ?>
					</div>
					<div class="col-lg-12 mb15">
						<label class="control-label ">
							<span>Model</span>
						</label>
						<?php echo form_input('model', set_value('model', (isset($product['model'])) ? $product['model'] : ''), 'class="form-control" placeholder="" id="model" autocomplete="off"'); ?>
					</div>
					<div class="col-lg-12 mb15">
						<label class="control-label ">
							<span>Xuất xứ</span>
						</label>
						<?php echo form_input('made_in', set_value('made_in', (isset($product['made_in'])) ? $product['made_in'] : ''), 'class="form-control" id="made_in" autocomplete="off"'); ?>
					</div>
					<div class="col-lg-12 mb15 ">
						<label class="control-label ">
							<span class="label-title">Mã sản phẩm <b class="text-danger">(*)</b></span>
						</label>
						<script>
						var productid = '<?php echo isset($product['productid']) ? $product['productid'] : $productid ?>'
						</script>
						<div class="dd-item">
							<?php echo form_input('productid', set_value('productid', (isset($product['productid'])) ? $product['productid'] : $productid), 'class="form-control va-uppercase productid" readonly placeholder="" autocomplete="off"');?>
							<input type="text" name="productid_original" class="form-control va-uppercase productid_original" value="<?php echo (isset($product['productid_original'])) ? $product['productid_original'] : ((isset($product['productid']) ? $product['productid'] : '')) ?>" style="display: none;">
							<input type="checkbox" id="toogle_readonly" name="toogle_readonly">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox mb20 ">
			<div class="ibox-title"><h5>Liên Kết Bài viết</h5></div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-row form-description">
							<?php echo form_input('articleid', htmlspecialchars_decode(html_entity_decode(set_value('articleid', (isset($product['articleid'])) ? $product['articleid'] : ''))), 'class="form-control tagsinput" placeholder="" autocomplete="off"');?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox mb20 ">
			<div class="ibox-title">
				<h5>Chọn TAGS cho Sản phẩm </h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-row">
							<?php echo form_input('tags', validate_input(set_value('tags', (isset($tags)) ? $tags : '')), 'class="form-control tags tagsinput" placeholder="" id="tags" autocomplete="off"'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ibox mb20">
			<div class="ibox-title">
				<h5>Hiển thị </h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-row">
							<div class="text-warning mb15">Quản lý thiết lập hiển thị cho blog này.</div>
							<div class="block clearfix">
								<div class="i-checks mr30" style="width:100%;">
									<span style="color:#000;" class="uk-flex uk-flex-middle">
										<?php echo form_radio('publish', set_value('publish', 1), ((isset($_POST['publish']) && $_POST['publish'] == 1 || (isset($product['publish']) && $product['publish'] == 1)) ? true : (!isset($_POST['publish'])) ? true : false),'class=""  id="publish"  style="margin-top:0;margin-right:10px;" '); ?>
										<label for="publish" style="margin:0;cursor:pointer;">Cho phép hiển thị trên website</label>
									</span>
								</div>
							</div>
							<div class="block clearfix">
								<div class="i-checks" style="width:100%;">
									<span style="color:#000;" class="uk-flex uk-flex-middle">
										<?php echo form_radio('publish', set_value('publish', 0), ((isset($_POST['publish']) && $_POST['publish'] == 0 || (isset($product['publish']) && $product['publish'] == 0)) ? true : false),'class=""   id="no-publish" style="margin-top:0;margin-right:10px;" '); ?>
										<label for="no-publish" style="margin:0;cursor:pointer;">Không Cho phép hiển thị trên website</label>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>