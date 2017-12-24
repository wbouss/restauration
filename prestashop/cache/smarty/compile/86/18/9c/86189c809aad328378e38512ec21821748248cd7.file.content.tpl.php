<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 21:34:25
         compiled from "/htdocs/prestashop/admin454axiavf/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1509027095593af8411ab0a5-10016545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86189c809aad328378e38512ec21821748248cd7' => 
    array (
      0 => '/htdocs/prestashop/admin454axiavf/themes/default/template/content.tpl',
      1 => 1497033548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1509027095593af8411ab0a5-10016545',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593af8411b76b9_46869627',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593af8411b76b9_46869627')) {function content_593af8411b76b9_46869627($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
