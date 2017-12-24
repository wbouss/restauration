<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:53
         compiled from "/htdocs/prestashop/admin/themes/default/template/controllers/orders/_shipping.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1406883435593aeefda69957-06716900%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0256cf89e1d88fb14e537374da75972fd1c33b33' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/controllers/orders/_shipping.tpl',
      1 => 1497034129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1406883435593aeefda69957-06716900',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'line' => 0,
    'currency' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeefdaf0991_76644403',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeefdaf0991_76644403')) {function content_593aeefdaf0991_76644403($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/htdocs/prestashop/tools/smarty/plugins/modifier.replace.php';
?>
<div class="table-responsive">
	<table class="table" id="shipping_table">
		<thead>
			<tr>
				<th>
					<span class="title_box "><?php echo smartyTranslate(array('s'=>'Date'),$_smarty_tpl);?>
</span>
				</th>
				<th>
					<span class="title_box ">&nbsp;</span>
				</th>
				<th>
					<span class="title_box "><?php echo smartyTranslate(array('s'=>'Carrier'),$_smarty_tpl);?>
</span>
				</th>
				<th>
					<span class="title_box "><?php echo smartyTranslate(array('s'=>'Weight'),$_smarty_tpl);?>
</span>
				</th>
				<th>
					<span class="title_box "><?php echo smartyTranslate(array('s'=>'Shipping cost'),$_smarty_tpl);?>
</span>
				</th>
				<th>
					<span class="title_box "><?php echo smartyTranslate(array('s'=>'Tracking number'),$_smarty_tpl);?>
</span>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value->getShipping(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->_loop = true;
?>
			<tr>
				<td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['line']->value['date_add'],'full'=>true),$_smarty_tpl);?>
</td>
				<td>&nbsp;</td>
				<td><?php echo $_smarty_tpl->tpl_vars['line']->value['carrier_name'];?>
</td>
				<td class="weight"><?php echo sprintf("%.3f",$_smarty_tpl->tpl_vars['line']->value['weight']);?>
 <?php echo Configuration::get('PS_WEIGHT_UNIT');?>
</td>
				<td class="center">
					<?php if ($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod()==@constant('PS_TAX_INC')) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['line']->value['shipping_cost_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['line']->value['shipping_cost_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>

					<?php }?>
				</td>
				<td>
					<span class="shipping_number_show"><?php if ($_smarty_tpl->tpl_vars['line']->value['url']&&$_smarty_tpl->tpl_vars['line']->value['tracking_number']) {?><a class="_blank" href="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['line']->value['url'],'@',$_smarty_tpl->tpl_vars['line']->value['tracking_number']);?>
"><?php echo $_smarty_tpl->tpl_vars['line']->value['tracking_number'];?>
</a><?php } else { ?><?php echo $_smarty_tpl->tpl_vars['line']->value['tracking_number'];?>
<?php }?></span>
				</td>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['line']->value['can_edit']) {?>
						<form method="post" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
">
							<span class="shipping_number_edit" style="display:none;">
								<input type="hidden" name="id_order_carrier" value="<?php echo htmlentities($_smarty_tpl->tpl_vars['line']->value['id_order_carrier']);?>
" />
								<input type="text" name="tracking_number" value="<?php echo htmlentities($_smarty_tpl->tpl_vars['line']->value['tracking_number']);?>
" />
								<button type="submit" class="btn btn-default" name="submitShippingNumber">
									<i class="icon-ok"></i>
									<?php echo smartyTranslate(array('s'=>'Update'),$_smarty_tpl);?>

								</button>
							</span>
							<a href="#" class="edit_shipping_number_link btn btn-default">
								<i class="icon-pencil"></i>
								<?php echo smartyTranslate(array('s'=>'Edit'),$_smarty_tpl);?>

							</a>
							<a href="#" class="cancel_shipping_number_link btn btn-default" style="display: none;">
								<i class="icon-remove"></i>
								<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>

							</a>
						</form>
					<?php }?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php }} ?>
