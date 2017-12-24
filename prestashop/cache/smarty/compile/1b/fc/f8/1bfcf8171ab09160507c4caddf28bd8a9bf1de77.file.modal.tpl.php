<?php /* Smarty version Smarty-3.1.19, created on 2017-06-09 21:33:46
         compiled from "/htdocs/prestashop/admin454axiavf/themes/default/template/helpers/modules_list/modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:715933638593af81a8fc973-74665098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bfcf8171ab09160507c4caddf28bd8a9bf1de77' => 
    array (
      0 => '/htdocs/prestashop/admin454axiavf/themes/default/template/helpers/modules_list/modal.tpl',
      1 => 1497034156,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '715933638593af81a8fc973-74665098',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_593af81a8ff736_95333753',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593af81a8ff736_95333753')) {function content_593af81a8ff736_95333753($_smarty_tpl) {?><div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules and Services'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<?php }} ?>
