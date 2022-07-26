<?php $actual_link = trim("$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>
<?php
	$model = new App\Models\AutoloadModel();
	$mainNav = get_menu(['keyword' => 'main-menu','language' => $language,'output' => 'array']);
	$cart = \Config\Services::cart();
	$cartTotal = $cart->contents();
	$price_voucher = check_voucher();
?>
<?php $cookie = (isset($_COOKIE['product_wishlist']) && $_COOKIE['product_wishlist'] != '' ? explode(',', $_COOKIE['product_wishlist']) : []) ?>
<?php $auth = (isset($_COOKIE[AUTH.'member']) ? json_decode($_COOKIE[AUTH.'member'], true) : []) ?>
<header class="pc-header uk-visible-large">
	<div class="banner-header-top bg-general" style="background-image: url(<?php echo $general['banner_header'] ?>);">
		<div class="uk-container uk-container-center">
			<div class="uk-position-relative">
				<div class="btn-cart-hd">
					<a href="<?php echo 'gio-hang'.HTSUFFIX ?>" class="mr10">Mua ngay</a>
				</div>
			</div>
		</div>
	</div>
	<section class="upper pt20 pb20">
		<div class="uk-container uk-container-center">
			<div class="uk-flex uk-flex-middle uk-flex-space-between container">
				<div class="logo" itemscope itemtype="http://schema.org/Hotel">
					<a itemprop="url" href="" title="<?php echo $general['homepage_brand'] ?>">
						<img src="<?php echo $general['homepage_logo'] ?>" alt="<?php echo $general['homepage_brand'] ?>" itemprop="logo" />
					</a>
				</div>
				<div class="pc-search header-search">
					<div class="uk-flex uk-flex-middle">
						<div class="info-hd">
							<div class="uk-flex uk-flex-middle">
								<div class="img img-scaledown">
									<img src="/public/phone.png" alt="">
								</div>
								<div class="info-wrap-hd">
									<div class="info-title-hd">Hotline bán hàng</div>
									<div class="info-data-hd"><?php echo $general['contact_hotline'] ?></div>
								</div>
							</div>
						</div>
						<div class="info-hd">
							<div class="uk-flex uk-flex-middle">
								<div class="img img-scaledown">
									<img src="/public/mail.png" alt="">
								</div>
								<div class="info-wrap-hd">
									<div class="info-title-hd">Email hỗ trợ</div>
									<div class="info-data-hd"><?php echo $general['contact_email'] ?></div>
								</div>
							</div>
						</div>
						<form action="<?php echo HTSEARCH.HTSUFFIX ?>" method="get" class="uk-form form uk-clearfix uk-position-relative">
							<div class="form-row text-row input-hd-search">
								<input type="text" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" class="uk-width-1-1 input-text" placeholder="Tìm kiếm..." />
							</div>
							<button type="submit" name="" class="btn-submit"><img src="/public/search.png" alt=""></button>
						</form>
						<span class="divider"></span>
						<a href="wishlist" class="wishlist">
							<i class="d-icon-heart">
							<span class="wishlist-count"><?php echo count($cookie) ?></span>
							</i>
						</a>
						<span class="divider"></span>
						<div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
							<a class="cart-toggle label-block link loadding-cart">
								<div class="cart-label d-lg-show">
									<span class="cart-name">Giỏ hàng:</span>
									<span class="cart-price"><?php echo number_format(($cart->total() - $price_voucher > 0 ? $cart->total() - $price_voucher : 0),0,',','.') ?> ₫</span>
								</div>
								<i class="d-icon-bag"><span class="cart-count"><?php echo count($cartTotal) ?></span></i>
							</a>
							<div class="cart-overlay"></div>
							<!-- End Cart Toggle -->
							<div class="dropdown-box">
								<div class="cart-header">
									<h4 class="cart-title">Giỏ hàng</h4>
									<a class="btn btn-dark btn-link btn-icon-right btn-close">Đóng<i class="d-icon-arrow-right"></i><span class="sr-only">Giỏ hàng</span></a>
								</div>
								<div class="products scrollable list-cart__loadding">
									<p style="margin-top: 25px;">Không có sản phẩm nào trong giỏ hàng!</p>
								</div>
							</div>
							<!-- End Dropdown Box -->
						</div>
					</div>
				</div>
			</div>
			<!-- .container -->
		</div>
	</section>
	<!-- .upper -->
	<section class="lower">
		<div class="uk-container uk-container-center">
			<nav class="main-nav uk-flex uk-flex-middle uk-flex-space-between">
				<ul class="uk-navbar-nav uk-clearfix main-menu">
					<?php if(isset($mainNav['data']) && is_array($mainNav['data']) && count($mainNav['data'])){
						foreach ($mainNav['data'] as $value) {
					?>
						<li>
							<a href="<?php echo $value['canonical'] ?>" title="<?php echo $value['title'] ?>">
								<?php echo $value['title'] ?>
							</a>
							<?php if(isset($value['children']) && is_array($value['children']) && count($value['children'])){ ?>
								<div class="dropdown-menu">
									<ul class="uk-list sub-menu">
										<?php foreach ($value['children'] as $valueChildren) { ?>
											<li><a href="<?php echo $valueChildren['canonical'] ?>" title="<?php echo $valueChildren['title'] ?>"><?php echo $valueChildren['title'] ?></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
						</li>
					<?php }} ?>
				</ul>
				<ul class="uk-list social-list-hd uk-flex uk-flex-middle">
					<li><a href="<?php echo $general['social_facebook'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/fb.png" alt=""></a></li>
					<li><a href="<?php echo $general['social_twitter'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/tt.png" alt=""></a></li>
					<li><a href="<?php echo $general['social_insta'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/insta.png" alt=""></a></li>
					<li><a href="<?php echo $general['social_google'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/gg.png" alt=""></a></li>
					<li><a href="<?php echo $general['social_tiktok'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/tiktok.png" alt=""></a></li>
					<li><a href="<?php echo $general['social_youtube'] ?>" target="_blank" class="img img-scaledown"><img src="/public/youtube.png" alt=""></a></li>
				</ul>
			</nav>
			<!-- .main-nav -->
		</div>
	</section>
	<!-- .lower -->
</header>
<!-- .header -->
<!-- MOBILE HEADER -->
<?php $cookie = (isset($_COOKIE['product_wishlist']) && $_COOKIE['product_wishlist'] != '' ? explode(',', $_COOKIE['product_wishlist']) : []) ?>
<?php $auth = (isset($_COOKIE[AUTH.'member']) ? json_decode($_COOKIE[AUTH.'member'], true) : []) ?>

<header class="header uk-hidden-large">
	<div class="banner-header-top bg-general" style="background-image: url(<?php echo $general['banner_header']; ?>);">
		<div class="uk-container uk-container-center">
			<div class="uk-position-relative">
				<div class="btn-cart-hd">
					<a href="<?php echo 'gio-hang' . HTSUFFIX; ?>" class="mr10">Mua ngay</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End HeaderTop -->
	<div class="sticky-content-wrapper" style="height: 105px;"><div class="header-middle sticky-header fix-top sticky-content">
		<div class="container">
			<div class="header-left">
				<a href="#" class="mobile-menu-toggle">
					<i class="d-icon-bars2"></i>
				</a>
				<a href="/" class="logo">
					<img src="<?php echo $general['homepage_logo']; ?>" alt="logo-toancau2" width="153" height="44">
				</a>
				<!-- End Logo -->
				<div class="header-search hs-simple">
					<form action="<?php echo site_url('tim-kiem' . HTSUFFIX); ?>" class="input-wrapper">
						<input type="text" class="form-control" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" name="keyword" autocomplete="off" placeholder="Tìm kiếm..." required="">
						<button class="btn btn-search" type="submit">
						<i class="d-icon-search"></i>
						</button>
					</form>
				</div>
			<div class="header-right">
				<span class="divider"></span>
				<a href="wishlist" class="wishlist" style="display: block;">
					<i class="d-icon-heart">
					<span class="wishlist-count"><?php echo count($cookie); ?></span>
					</i>
				</a>
				<div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
					<a class="cart-toggle label-block link loadding-cart">
						<div class="cart-label d-lg-show">
							<span class="cart-name">Giỏ hàng:</span>
							<span class="cart-price"><?php echo number_format($cart->total() - $price_voucher > 0 ? $cart->total() - $price_voucher : 0, 0, ',', '.'); ?> ₫</span>
						</div>
						<i class="d-icon-bag"><span class="cart-count"><?php echo count($cartTotal); ?></span></i>
					</a>
					<div class="cart-overlay"></div>
					<div class="dropdown-box">
						<div class="cart-header">
							<h4 class="cart-title">Giỏ hàng</h4>
							<a class="btn btn-dark btn-link btn-icon-right btn-close">Đóng<i class="d-icon-arrow-right"></i><span class="sr-only">Giỏ hàng</span></a>
						</div>
						<div class="products scrollable list-cart__loadding">
							<p style="margin-top: 25px;">Không có sản phẩm nào trong giỏ hàng!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="" class="count_wishlist" value="<?php echo count($cookie); ?>">
	<div class="header-bottom d-lg-show">
		<div class="container">
			<div class="header-logo__fix">
				<a href="/" class="logo">
					<img src="<?php echo $general['homepage_logo']; ?>" alt="logo-toancau2" width="153" height="44">
				</a>
			</div>
			<div class="header-left">
				<nav class="main-nav">
					<ul class="menu">
						<?php if (isset($mainNav['data']) && is_array($mainNav['data']) && count($mainNav['data'])) {
          					foreach ($mainNav['data'] as $key => $value) { ?>
							<li class="<?php echo isset($value['children']) && is_array($value['children']) && count($value['children']) ? 'submenu' : ''; ?>">
								<a href="<?php echo $value['canonical']; ?>"><?php echo $value['title']; ?></a>
								<?php if (isset($value['children']) && is_array($value['children']) && count($value['children'])) { ?>
									<ul>
										<?php foreach ($value['children'] as $keyChild => $valueChild) { ?>
											<li style="text-transform: capitalize;"><a href="<?php echo $valueChild['canonical']; ?>"><?php echo $valueChild['title']; ?></a></li>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
						<?php }} ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>

<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay">
    </div>
    <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
    <div class="mobile-menu-container scrollable">
        <form action="<?php echo site_url('tim-kiem' . HTSUFFIX); ?>" class="input-wrapper">
            <input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" autocomplete="off"
            placeholder="Tìm kiếm..." required />
            <button class="btn btn-search" type="submit">
            <i class="d-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->
        <ul class="mobile-menu mmenu-anim mb30">
        	<?php if (isset($mainNav['data']) && is_array($mainNav['data']) && count($mainNav['data'])) {
             foreach ($mainNav['data'] as $key => $value) { ?>
	            <li>
	                <a <?php echo isset($value['children']) && is_array($value['children']) && count($value['children']) ? 'class="show-menu-level2" data-show="1"' : ''; ?> href="<?php echo $value['canonical']; ?>" ><?php echo $value['title']; ?></a>
	                <?php if (isset($value['children']) && is_array($value['children']) && count($value['children'])) { ?>
						<ul>
							<?php foreach ($value['children'] as $keyChild => $valueChild) { ?>
								<li ><a href="<?php echo $valueChild['canonical']; ?>"><?php echo $valueChild['title']; ?></a></li>
							<?php } ?>
						</ul>
					<?php } ?>
	            </li>
	        <?php }
         } ?>
        </ul>

        <ul class="uk-list social-list-hd uk-flex uk-flex-middle uk-flex-center">
			<li><a href="<?php echo $general['social_facebook'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/fb.png" alt=""></a></li>
			<li><a href="<?php echo $general['social_twitter'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/tt.png" alt=""></a></li>
			<li><a href="<?php echo $general['social_insta'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/insta.png" alt=""></a></li>
			<li><a href="<?php echo $general['social_google'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/gg.png" alt=""></a></li>
			<li><a href="<?php echo $general['social_tiktok'] ?>" target="_blank" class="img img-scaledown mr10"><img src="/public/tiktok.png" alt=""></a></li>
			<li><a href="<?php echo $general['social_youtube'] ?>" target="_blank" class="img img-scaledown"><img src="/public/youtube.png" alt=""></a></li>
		</ul>
    </div>
</div>