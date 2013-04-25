<?php /* Smarty version Smarty-3.1.13, created on 2013-04-23 23:21:11
         compiled from "./templates/regist_schedule.html" */ ?>
<?php /*%%SmartyHeaderCode:760389203517698d77573c6-79451827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9e6b62b8757b3f5e9f481297f54bde5e6272351' => 
    array (
      0 => './templates/regist_schedule.html',
      1 => 1366714913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '760389203517698d77573c6-79451827',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517698d777ed35_67108342',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517698d777ed35_67108342')) {function content_517698d777ed35_67108342($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('show_schedule_system.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<a
  id="remove_schedule"
  class="standard_button"
  href="javascript:void(0);"
  >削除</a>
<a
  id="modify_schedule"
  class="standard_button"
  href="javascript:void(0);"
  >変更</a>
<a
  id="add_schedule"
  class="standard_button"
  href="javascript:void(0);"
  >追加</a>
<script src="/script/regist_schedule.js"></script>
<?php }} ?>