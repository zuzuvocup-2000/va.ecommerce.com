<?php
	$footer_menu = get_menu(['keyword' => 'menu-footer','language' => $language,'output' => 'array']);
?>
<?php 
    $owlInit = array(
        'margin' => 20,
        'lazyload' => true,
        'nav' => false,
        'dots' => false,
        'loop' => true,
        'autoplay' => true,
        'responsive' => array(
            0 => array(
                'items' => 2,
            ),
            480 => array(
                'items' => 2,
            ),
            768 => array(
                'items' => 4,
            ),
            960 => array(
                'items' => 5,
            ),
        )
    );
?>
<?php $banner = get_slide(['keyword' => 'customer' , 'language' => $language ]); ?>
<?php if(isset($banner) && is_array($banner) && count($banner)){ ?>
<div class="slide-customer mt50">
    <div class="uk-container uk-container-center">
        <div class="panel-body owl-slide wrap-slide-customer" >
            <div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">
                <?php foreach ($banner as $key => $value) {  ?>
                    <div class="wrap-slide">
                        <div class="img-scaledown img-customer">
                            <img src="<?php echo $value['image'] ?>" alt="">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<footer class="footer bg-general" style="background: url(<?php echo $general['banner_footer'] ?>);">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-large uk-clearfix">
            <div class="uk-width-1-1 uk-width-large-1-2">
                <div class="wrap-grid">
                    <div class="uk-grid uk-grid-medium uk-grid-width-1-2 uk-clearfix">
                        <?php if(isset($footer_menu['data']) && is_array($footer_menu['data']) && count($footer_menu['data'])){
                            foreach ($footer_menu['data'] as $key => $value) {
                         ?>
                            <section class="panel mb30">
                                <header class="panel-head">
                                    <h3 class="heading"><span><?php echo $value['title'] ?></span></h3>
                                </header>
                                <?php if(isset($value['children']) && is_array($value['children']) && count($value['children'])){ ?>
                                    <section class="panel-body">
                                        <ul class="uk-list site-link">
                                            <?php foreach ($value['children'] as $valueChild) {  ?>
                                            <li><a href="<?php echo $valueChild['canonical'] ?>" title="<?php echo $valueChild['title'] ?>"><?php echo $valueChild['title'] ?></a></li>
                                        <?php } ?>
                                        </ul>
                                    </section>
                                <?php } ?>
                            </section>
                        <?php }} ?>
                        <section class="panel mb30">
                            <header class="panel-head">
                                <h3 class="heading"><span><?php echo $general['homepage_slogan'] ?></span></h3>
                            </header>
                            <div class="wrap-info-ft">
                                <?php echo $general['homepage_general'] ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1 uk-width-large-1-2">
                <div class="wrap-grid">
                    <section class="panel mb30">
                        <header class="panel-head">
                            <h3 class="heading"><span>Theo dõi chúng tôi</span></h3>
                        </header>
                        <div class="wrap-fanpage">
                            Trang chủ facebook (khi có fb chuẩn)
                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-head">
                            <h3 class="heading"><span>ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI</span></h3>
                        </header>
                        <div class="wrap-dangky">
                            <form class="input-wrapper input-wrapper-inline contact_email_va">
                                <input type="text" class="form-control phone endow_footer email_contact_va" name="email" id="email2" placeholder="Nhập email của bạn">
                                <button class="btn btn-primary  submit-endow" data-type="1" data-endow="endow_footer" type="submit">Đăng ký</button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</footer>

<a id="scroll-top" title="Top" role="button" class="scroll-top show" style="display: block;"><i class="d-icon-arrow-up"></i></a>
<section id="loading_box"><div id="loading_image"></div></section>
<div class="phone-fixed uk-flex uk-flex-middle">
    <div class="img-scaledown img-phone-fixed">
        <img src="public/phone_fixed.png" alt="">
    </div>
    <?php echo $general['contact_hotline'] ?>
</div>