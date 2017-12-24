<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 20:54:53
         compiled from "/htdocs/prestashop/admin/themes/default/template/controllers/slip/_print_pdf_icon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1587672901593aeefde4d143-33615852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46ca1560a6f24221e1776cf2f3ce33eb240f3f73' => 
    array (
      0 => '/htdocs/prestashop/admin/themes/default/template/controllers/slip/_print_pdf_icon.tpl',
      1 => 1497034140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1587672901593aeefde4d143-33615852',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'order_slip' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593aeefde62f72_28991664',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593aeefde62f72_28991664')) {function content_593aeefde62f72_28991664($_smarty_tpl) {?>



<a class="btn btn-default _blank" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), ENT_QUOTES, 'UTF-8', true);?>
&amp;submitAction=generateOrderSlipPDF&amp;id_order_slip=<?php echo intval($_smarty_tpl->tpl_vars['order_slip']->value->id);?>
">
	<i class="icon-file-text"></i>
	<?php echo smartyTranslate(array('s'=>'Download credit slip'),$_smarty_tpl);?>

</a>

<?php }} ?>
