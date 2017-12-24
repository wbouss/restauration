<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:49
         compiled from "/htdocs/prestashop/admin/themes/default/template/helpers/tree/tree_node_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:707045127593aeef9c83865-02471341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7decfeb301abdaa3b97786e8568950f1e3a94d3' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/helpers/tree/tree_node_item.tpl',
      1 => 1497034159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '707045127593aeef9c83865-02471341',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'node' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeef9c86861_50204836',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeef9c86861_50204836')) {function content_593aeef9c86861_50204836($_smarty_tpl) {?>

<li class="tree-item">
	<span class="tree-item-name">
		<i class="tree-dot"></i>
		<label class="tree-toggler"><?php echo $_smarty_tpl->tpl_vars['node']->value['name'];?>
</label>
	</span>
</li><?php }} ?>
