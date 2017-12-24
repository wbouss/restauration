<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:49
         compiled from "/htdocs/prestashop/admin/themes/default/template/helpers/tree/tree_node_folder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1020928280593aeef9dc2b84-65916734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06882d92d8c690658104fe61b0b18af468aaa8ee' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/helpers/tree/tree_node_folder.tpl',
      1 => 1497034158,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1020928280593aeef9dc2b84-65916734',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'node' => 0,
    'children' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeef9dca1d5_54191689',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeef9dca1d5_54191689')) {function content_593aeef9dca1d5_54191689($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/htdocs/prestashop/tools/smarty/plugins/modifier.escape.php';
?>
<li class="tree-folder">
	<span class="tree-folder-name">
		<i class="icon-folder-close"></i>
		<label class="tree-toggler"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</label>
	</span>
	<ul class="tree">
		<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['children']->value, 'UTF-8');?>

	</ul>
</li><?php }} ?>
