<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:52
         compiled from "/htdocs/prestashop/admin/themes/default/template/controllers/request_sql/list_action_export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:599509550593aeefc7ed637-57759447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12f4ce794f869f5102e9b7ecfec4c563cb7b77cb' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/controllers/request_sql/list_action_export.tpl',
      1 => 1497034136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '599509550593aeefc7ed637-57759447',
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
  'unifunc' => 'content_593aeefc7f6305_52539400',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeefc7f6305_52539400')) {function content_593aeefc7f6305_52539400($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="btn btn-default">
	<i class="icon-cloud-upload"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
