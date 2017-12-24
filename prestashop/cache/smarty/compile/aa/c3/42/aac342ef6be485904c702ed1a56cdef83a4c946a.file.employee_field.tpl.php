<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:52
         compiled from "/htdocs/prestashop/admin/themes/default/template/controllers/logs/employee_field.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1382638940593aeefc462ef3-28838903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aac342ef6be485904c702ed1a56cdef83a4c946a' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/controllers/logs/employee_field.tpl',
      1 => 1497034120,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1382638940593aeefc462ef3-28838903',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'employee_image' => 0,
    'employee_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeefc46a8e5_65766856',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeefc46a8e5_65766856')) {function content_593aeefc46a8e5_65766856($_smarty_tpl) {?>
<span class="employee_avatar_small">
	<img class="imgm img-thumbnail" alt="" src="<?php echo $_smarty_tpl->tpl_vars['employee_image']->value;?>
" width="32" height="32" />
</span>
<?php echo $_smarty_tpl->tpl_vars['employee_name']->value;?>
<?php }} ?>
