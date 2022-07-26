<?php $banner = get_slide(['keyword' => 'banner-top' , 'language' => $language ]); ?>
<?php $banner_ads = get_slide(['keyword' => 'image-album' , 'language' => $language ]); ?>
<?php
    $model = new App\Models\AutoloadModel();
    $productList = $model->_get_where([
        'select' => 'tb2.title, tb2.canonical, tb1.lft, tb1.rgt, tb1.parentid, tb1.level, tb1.id',
        'where' => [
            'tb1.deleted_at' => 0,
            'tb1.publish' => 1,
            'tb1.hot' => 1,
        ],
        'table' => 'product_catalogue as tb1',
        'join' => [
            [
                'product_translate as tb2','tb2.module = "product_catalogue" AND tb2.objectid = tb1.id AND tb2.language = \''.$language.'\'', 'inner'
            ]
        ],
        'group_by' => 'tb1.id',
        'order_by' => 'tb2.title desc'
    ], true);
    if(isset($productList) && is_array($productList) && count($productList)){
        foreach ($productList as $key => $value) {
            $id_list = [];
            $id_list[] = $value['id'];
            $productList[$key]['child'] = $model->_get_where([
                'select' => 'tb2.title, tb2.canonical, tb1.lft, tb1.rgt, tb1.parentid, tb1.level, tb1.id',
                'table' => 'product_catalogue as tb1',
                'join' => [
                    [
                        'product_translate as tb2','tb2.module = "product_catalogue" AND tb2.objectid = tb1.id AND tb2.language = \''.$language.'\'', 'inner'
                    ]
                ],
                'where' => ['lft >' => $value['lft'],'rgt <' => $value['rgt']],
                'group_by' => 'tb1.id',
                'order_by' => 'tb2.title desc'
            ], TRUE);
            if(isset($productList[$key]['child']) && is_array($productList[$key]['child']) && count($productList[$key]['child'])){
                foreach ($productList[$key]['child'] as $keyChild => $valueChild) {
                    $id_list[] = $valueChild['id'];
                }
            }

            $productList[$key]['data'] = $model->_get_where([
                'select' => 'tb1.id,tb1.viewed,tb1.hot, tb1.created_at ,tb1.productid, tb1.bar_code,tb1.model, tb1.image,tb1.price,tb1.rate, tb1.price_promotion,  tb1.album, tb3.title, tb3.canonical, tb3.meta_title, tb3.meta_description, tb3.module, tb3.description, tb3.content, tb1.model, tb1.bar_code, tb3.info, tb1.length, tb1.width, tb4.title as cat_title,tb4.canonical as cat_canonical,',
                'table' => 'product as tb1',
                'where' => [
                    'tb1.deleted_at' => 0,
                    'tb1.publish' => 1
                ],
                'where_in' => $id_list,
                'where_in_field' => 'tb1.catalogueid',
                'join' => [
                    [
                        'product_translate as tb3','tb1.id = tb3.objectid AND tb3.module = "product" AND tb3.language = \''.$language.'\' ','inner'
                    ],
                    [
                        'product_translate as tb4','tb1.catalogueid = tb4.objectid AND tb4.module = "product_catalogue" AND tb4.language = \''.$language.'\' ','inner'
                    ]
                ],
                'limit' => 12,
                'group_by' => 'tb1.id',
                'order_by' => 'tb1.id desc'
            ], TRUE);
        }
    }
?>
<section class="home">
	<?php if(isset($banner) && is_array($banner) && count($banner)){ ?>
	    <section class="big-slide">
	        <div class="uk-slidenav-position" data-uk-slideshow>
	            <ul class="uk-slideshow">
	            	<?php foreach ($banner as $value) { ?>
		                <li class="big-slide-item">
		                    <a href="<?php echo $value['canonical'] ?>" class="img img-cover">
		                        <img src="<?php echo $value['image'] ?>">
		                    </a>
		                </li>
		            <?php } ?>
	            </ul>
	            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous">
	                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
	            </a>
	            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next">
	                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
	            </a>
	        </div>
	    </section>
	<?php } ?>

    <section class="quality-panel mb50">
        <div class="uk-container uk-container-center">
            <div class="panel-body">
                <div class="uk-grid uk-grid-collapse">
                    <div class="uk-width-large-1-4">
                        <div class="body-content ">
                            <div class="quality-icon img img-scaledown">
                                <img src="public/top.png">
                            </div>
                            <div class="quality-header">
                                UY TÍN HÀNG ĐẦU
                            </div>
                            <div class="quality-description">
                                Uy tín trên từng sản phẩm và dịch vụ
                            </div>
                        </div>
                    </div>
                     <div class="uk-width-large-1-4">
                        <div class="body-content ">
                            <div class="quality-icon img img-scaledown">
                                <img src="public/car.png">
                            </div>
                            <div class="quality-header">
                                Giao hàng nhanh chóng
                            </div>
                            <div class="quality-description">
                                Đóng gói & vận chuyển chuyên nghiệp
                            </div>
                        </div>
                    </div>
                     <div class="uk-width-large-1-4">
                        <div class="body-content ">
                            <div class="quality-icon img img-scaledown">
                                <img src="public/da.png">
                            </div>
                            <div class="quality-header">
                                Sản phẩm đa dạng
                            </div>
                            <div class="quality-description">
                                Đa dạng sản phẩm thoải mái lựa chọn
                            </div>
                        </div>
                    </div>
                     <div class="uk-width-large-1-4">
                        <div class="body-content ">
                            <div class="quality-icon img img-scaledown">
                                <img src="public/chart.png">
                            </div>
                            <div class="quality-header">
                                Cập nhật xu hướng mới
                            </div>
                            <div class="quality-description">
                                Dẫn đầu xu hướng sản phẩm và dịch vụ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php if(isset($banner_ads) && is_array($banner_ads) && count($banner_ads)){ ?>
	    <section class="new-video-panel mb50">
	        <div class="uk-container uk-container-center">
	            <div class="panel-body">
	                <div class="uk-grid uk-grid-medium">
	                	<?php foreach ($banner_ads as $value) { ?>
		                    <div class="uk-width-large-1-3 mb15">
		                        <div class="body-content video">
		                            <a href="<?php echo $value['canonical'] ?>" class="img img-cover ">
		                                <img src="<?php echo $value['image'] ?>">
		                            </a>
		                        </div>
		                    </div>
		                <?php } ?>
	                </div>
	            </div>
	        </div>
	    </section>
	<?php } ?>
    <?php
        $a = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
        $b = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';

        $owlInit = [
            'items' => 3,
            'margin' => 10,
            'nav' => true,
            'navText'=>[$a ,$b],
            'dots' =>false,
            'autoWidth' => true,
        ];
    ?>
    <section class="home-main-panel">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-small">
                <div class="uk-width-large-1-4">
                    <?php echo view('frontend/homepage/common/asideproduct') ?>
                </div>
                <div class="uk-width-large-3-4">
                    <?php if(isset($productList) && is_array($productList) && count($productList)){ 
                        foreach ($productList as $keyCatalogue => $valueCatalogue) {
                    ?>
                        <div class="medical-section-panel mb30">
                            <div class="medical-section-top mb30">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <header class="medical-section-header">
                                        <h2 class="heading">
                                            <?php echo $valueCatalogue['title'] ?>
                                        </h2>
                                    </header>
                                    <?php if(isset($valueCatalogue['child']) && is_array($valueCatalogue['child']) && count($valueCatalogue['child'])){ ?>
                                        <div class="medical-section-list">
                                            <div class="owl-slide slide-cate-prd">
                                                <div class="owl-carousel" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">
                                                    <?php foreach ($valueCatalogue['child'] as $value) { ?>
                                                        <div class="medical-section-item">
                                                            <div class=" item-title">
                                                                <a href="<?php echo $value['canonical'].HTSUFFIX ?>">
                                                                    <?php echo $value['title'] ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="section-more">
                                        <a href="<?php echo $valueCatalogue['canonical'].HTSUFFIX ?>">
                                            Xem thêm
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="medical-section-body">
                                <div class="uk-grid uk-grid-small">
                                    <?php if(isset($valueCatalogue['data']) && is_array($valueCatalogue['data']) && count($valueCatalogue['data'])){
                                        foreach ($valueCatalogue['data'] as $value) {
                                    ?>
                                        <div class="uk-width-large-1-4 uk-width-1-2 mb10">
                                            <div class="medical-item product">
                                                <div class="item-pic">
                                                    <a href="<?php echo $value['canonical'].HTSUFFIX ?>" class="img img-cover product-media">
                                                        <img src="<?php echo $value['image'] ?>">
                                                    </a>
                                                    <div class="item-function">
                                                        <div class="uk-flex uk-flex-middle">
                                                            <div class="icon icon-img-action mr10">
                                                                <a href="<?php echo $value['canonical'].HTSUFFIX ?>">
                                                                    <img src="public/eye.png" alt="" class="p10">
                                                                </a>
                                                            </div>
                                                            <div class="icon icon-img-action mr10">
                                                                <a class="buy_now" data-id="<?php echo $value['id'] ?>" data-sku="SKU_<?php echo $value['id'] ?>">
                                                                    <img src="public/cart.png" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="icon icon-img-action" >
                                                                <a  data-id="<?php echo $value['id'] ?>" class="btn-wishlist">
                                                                    <i class="d-icon-heart"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-text">
                                                    <div class="product-title product-name mb5">
                                                        <a href="<?php echo $value['canonical'].HTSUFFIX ?>" class="limit-line-3 ">
                                                            <?php echo $value['title'] ?> <?php echo (!empty($value['model']) ? ' - Model: '.$value['model'] : '') ?> <?php echo (!empty($value['bar_code']) ? ' - Hãng: '.$value['bar_code'] : '') ?><?php echo (!empty($value['made_in']) ? ' - '.$value['made_in'] : '') ?>
                                                        </a>
                                                    </div>
                                                    <div class="product-star mb5">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="product-contact mb10 product-price">
                                                        <a href="<?php echo $value['canonical'].HTSUFFIX ?>">
                                                            <div class="prd-price uk-clearfix">
                                                                <span class="price-old uk-display-block "><?php echo empty($value['price_promotion']) ? '' : number_format(check_isset($value['price']),0,',','.').' VNĐ' ?></span>
                                                                <span class="price-new new-price"><?php echo (empty($value['price'] ) ? 'Liên hệ' : (!empty($value['price_promotion']) ? number_format(check_isset($value['price_promotion']),0,',','.').' VNĐ' : number_format(check_isset($value['price']),0,',','.').' VNĐ')) ?></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }} ?>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </section>
</section>