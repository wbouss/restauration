<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:50
         compiled from "/htdocs/prestashop/admin/themes/default/template/helpers/list/list_action_removestock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1795275244593aeefa6e7d82-13038675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54b9e1b694f40db1941645cb6d9ae37dd3029f74' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/helpers/list/list_action_removestock.tpl',
      1 => 1497034154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1795275244593aeefa6e7d82-13038675',
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
  'unifunc' => 'content_593aeefa6f45e8_90630081',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeefa6f45e8_90630081')) {function content_593aeefa6f45e8_90630081($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<i class="icon-circle-arrow-down"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a>
<?php }} ?>
