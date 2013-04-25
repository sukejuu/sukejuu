<?php /* Smarty version Smarty-3.1.13, created on 2013-04-24 16:21:59
         compiled from "./templates/add_course.html" */ ?>
<?php /*%%SmartyHeaderCode:899267472517788175d89e4-43674940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c859f0a95ef5fd99ccd2cee0b56298af5932e030' => 
    array (
      0 => './templates/add_course.html',
      1 => 1366722352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '899267472517788175d89e4-43674940',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'departments' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51778817627701_98613580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51778817627701_98613580')) {function content_51778817627701_98613580($_smarty_tpl) {?><div id="main">
  
  <!--	
  <header>
  </header>
  -->
  
  ←
  <a
    class="to_main"
    href="javascript:void(0);"
    >トップページ</a>
  &gt;
  <a
    class="to_show_courses"
    href="javascript:void(0);"
    >学科・コース変更、追加</a>
  <p>★学科とコース新規追加を行うでござる</p>
  
  <article>
    <form>
      <input
        id="is_text"
        type="checkbox"
        >←新設学科の場合はここをチェックして学科名を手打ちするでござる
      
      <br />
      <br />
        
      <div>
        学科名：
        <select id="department_select">
          <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
          <?php } ?>
        </select>
        <input id="department_text" class="hidden">
      </div>
      <div>
        コース名：
        <input id="course_text">
      </div>
    </form>

  
    <a
      id="add_course"
      class="standard_button"
      href="javascript:void(0);"
      >追加</a>
  
  </article>
</div>

<script src="/script/add_course.js"></script>
<?php }} ?>