<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:49
         compiled from "/htdocs/prestashop/admin/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1724759804593aeef9b6b5d6-41428275%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12923c72b04e570d234363e4dc8a1016241bbf42' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/content.tpl',
      1 => 1497033548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1724759804593aeef9b6b5d6-41428275',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeef9b71d00_03115301',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeef9b71d00_03115301')) {function content_593aeef9b71d00_03115301($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
