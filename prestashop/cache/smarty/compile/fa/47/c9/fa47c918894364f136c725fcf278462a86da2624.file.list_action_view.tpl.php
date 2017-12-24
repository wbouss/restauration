<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 21:45:41
         compiled from "/htdocs/prestashop/admin454axiavf/themes/default/template/helpers/list/list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:360334829593afae529b7f3-83739234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa47c918894364f136c725fcf278462a86da2624' => 
    array (
      0 => '/htdocs/prestashop/admin454axiavf/themes/default/template/helpers/list/list_action_view.tpl',
      1 => 1497034154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '360334829593afae529b7f3-83739234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593afae52b0e35_63331751',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593afae52b0e35_63331751')) {function content_593afae52b0e35_63331751($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" >
	<i class="icon-search-plus"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>
