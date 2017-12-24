<?php /*%%SmartyHeaderCode:377421749593bc3f1b90575-47265159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c6cee62408938f22c15a8e6190818fc55087ac2' => 
    array (
      0 => '/htdocs/prestashop/themes/default-bootstrap/modules/blockspecials/blockspecials.tpl',
      1 => 1497033834,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '377421749593bc3f1b90575-47265159',
  'variables' => 
  array (
    'link' => 0,
    'special' => 0,
    'PS_CATALOG_MODE' => 0,
    'priceDisplay' => 0,
    'specific_prices' => 0,
    'priceWithoutReduction_tax_excl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593bc3f1d3ff26_32549037',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593bc3f1d3ff26_32549037')) {function content_593bc3f1d3ff26_32549037($_smarty_tpl) {?>
<!-- MODULE Block specials -->
<div id="special_block_right" class="block">
	<p class="title_block">
        <a href="http://bibi-burger.fr/prestashop/promotions" title="Specials">
            Specials
        </a>
    </p>
	<div class="block_content products-block">
    		<ul>
        	<li class="clearfix">
            	<a class="products-block-image" href="http://bibi-burger.fr/prestashop/robes-ete/5-robe-ete-imprimee.html">
                    <img 
                    class="replace-2x img-responsive" 
                    src="http://bibi-burger.fr/prestashop/12-small_default/robe-ete-imprimee.jpg" 
                    alt="" 
                    title="Robe d&#039;été imprimée" />
                </a>
                <div class="product-content">
                	<h5>
                        <a class="product-name" href="http://bibi-burger.fr/prestashop/robes-ete/5-robe-ete-imprimee.html" title="Robe d&#039;été imprimée">
                            Robe d&#039;été imprimée
                        </a>
                    </h5>
                                        	<p class="product-description">
                            Longue robe imprimée à fines...
                        </p>
                                        <div class="price-box">
                    	                        	<span class="price special-price">
                                                                    34,78 €                            </span>
                                                                                                                                 <span class="price-percent-reduction">-5%</span>
                                                                                         <span class="old-price">
                                                                    36,61 €                            </span>
                            
                                            </div>
                </div>
            </li>
		</ul>
		<div>
			<a 
            class="btn btn-default button button-small" 
            href="http://bibi-burger.fr/prestashop/promotions" 
            title="All specials">
                <span>All specials<i class="icon-chevron-right right"></i></span>
            </a>
		</div>
    	</div>
</div>
<!-- /MODULE Block specials -->
<?php }} ?>
