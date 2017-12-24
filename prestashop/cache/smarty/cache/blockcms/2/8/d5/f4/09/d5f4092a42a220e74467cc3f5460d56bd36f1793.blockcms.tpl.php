<?php /*%%SmartyHeaderCode:1812388385593afa8095e9d6-42166337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5f4092a42a220e74467cc3f5460d56bd36f1793' => 
    array (
      0 => '/htdocs/prestashop/themes/default-bootstrap/modules/blockcms/blockcms.tpl',
      1 => 1497033822,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1812388385593afa8095e9d6-42166337',
  'variables' => 
  array (
    'block' => 0,
    'cms_titles' => 0,
    'cms_key' => 0,
    'cms_title' => 0,
    'cms_page' => 0,
    'link' => 0,
    'show_price_drop' => 0,
    'PS_CATALOG_MODE' => 0,
    'show_new_products' => 0,
    'show_best_sales' => 0,
    'display_stores_footer' => 0,
    'show_contact' => 0,
    'contact_url' => 0,
    'cmslinks' => 0,
    'cmslink' => 0,
    'show_sitemap' => 0,
    'footer_text' => 0,
    'display_poweredby' => 0,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593afa80a39f83_16682888',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593afa80a39f83_16682888')) {function content_593afa80a39f83_16682888($_smarty_tpl) {?>
	<!-- Block CMS module footer -->
	<section class="footer-block col-xs-12 col-sm-2" id="block_various_links_footer">
		<h4>Information</h4>
		<ul class="toggle-footer">
							<li class="item">
					<a href="http://bibi-burger.fr/prestashop/promotions" title="Specials">
						Specials
					</a>
				</li>
									<li class="item">
				<a href="http://bibi-burger.fr/prestashop/nouveaux-produits" title="New products">
					New products
				</a>
			</li>
										<li class="item">
					<a href="http://bibi-burger.fr/prestashop/meilleures-ventes" title="Top sellers">
						Top sellers
					</a>
				</li>
										<li class="item">
					<a href="http://bibi-burger.fr/prestashop/magasins" title="Our stores">
						Our stores
					</a>
				</li>
									<li class="item">
				<a href="http://bibi-burger.fr/prestashop/nous-contacter" title="Contact us">
					Contact us
				</a>
			</li>
															<li class="item">
						<a href="http://bibi-burger.fr/prestashop/content/3-conditions-utilisation" title="Conditions d&#039;utilisation">
							Conditions d&#039;utilisation
						</a>
					</li>
																<li class="item">
						<a href="http://bibi-burger.fr/prestashop/content/4-a-propos" title="A propos">
							A propos
						</a>
					</li>
													<li>
				<a href="http://bibi-burger.fr/prestashop/plan-site" title="Sitemap">
					Sitemap
				</a>
			</li>
					</ul>
		
	</section>
		<section class="bottom-footer col-xs-12">
		<div>
			<?php echo smartyTranslate(array('s'=>'[1] %3$s %2$s - Ecommerce software by %1$s [/1]','mod'=>'blockcms','sprintf'=>array('PrestaShop™',date('Y'),'©'),'tags'=>array('<a class="_blank" href="http://www.prestashop.com">')),$_smarty_tpl);?>

		</div>
	</section>
		<!-- /Block CMS module footer -->
<?php }} ?>
