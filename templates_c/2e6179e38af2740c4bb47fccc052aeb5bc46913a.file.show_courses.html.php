<?php /* Smarty version Smarty-3.1.13, created on 2013-05-01 00:38:12
         compiled from "./templates/show_courses.html" */ ?>
<?php /*%%SmartyHeaderCode:10864090885176a49cd25f61-93326767%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e6179e38af2740c4bb47fccc052aeb5bc46913a' => 
    array (
      0 => './templates/show_courses.html',
      1 => 1367331604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10864090885176a49cd25f61-93326767',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5176a49cd5b2f2_68953037',
  'variables' => 
  array (
    'conf_list' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5176a49cd5b2f2_68953037')) {function content_5176a49cd5b2f2_68953037($_smarty_tpl) {?><nav>
  ←
  <a
    href="javascript:void(0);"
    class="to_back"
    >トップページ</a></p>
  <p>★学科・コースを確認、追加を行えます。</p>
</nav>

<article>
  <table>
    <tr>
      <!--<th>course_id-->
      <th>学科名
      <th>コース名
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['conf_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
    <tr>
      <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['course_id'];?>
-->
      <td><?php echo $_smarty_tpl->tpl_vars['v']->value['department_name'];?>

      <td><?php echo $_smarty_tpl->tpl_vars['v']->value['course_name'];?>

    <?php } ?>
  </table>
  <a
    id="add_course"
    class="standard_button"
    href="javascript:void(0);"
    >コースを追加</a>
</article>

<script>
$(function(){
  change_subtitle('学科とコースの確認', 'show_courses')
  multiple_bind_audio_with_command
  ( [ [ '.to_back'   , 'to_back'   , 'main'      ]
    , [ '#add_course', 'add_course', 'add_course']
    ]
  )
})
</script>
<?php }} ?>