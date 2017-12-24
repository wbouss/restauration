<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:54
         compiled from "/htdocs/prestashop/admin/themes/default/template/controllers/shop/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:872200861593aeefe605d87-55749430%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4a1bbdeb25d00dd5655ae1e1019728e957d5391' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/controllers/shop/content.tpl',
      1 => 1497034138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '872200861593aeefe605d87-55749430',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shops_tree' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeefe60e6b2_10987023',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeefe60e6b2_10987023')) {function content_593aeefe60e6b2_10987023($_smarty_tpl) {?>

<div class="row">
	<div class="col-lg-4">
		<?php echo $_smarty_tpl->tpl_vars['shops_tree']->value;?>

	</div>
	<div class="col-lg-8"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</div>
</div><?php }} ?>
