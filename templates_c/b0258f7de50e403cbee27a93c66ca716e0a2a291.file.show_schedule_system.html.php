<?php /* Smarty version Smarty-3.1.13, created on 2013-04-25 21:54:00
         compiled from "./templates/show_schedule_system.html" */ ?>
<?php /*%%SmartyHeaderCode:1754918615517698d77819d6-99713952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0258f7de50e403cbee27a93c66ca716e0a2a291' => 
    array (
      0 => './templates/show_schedule_system.html',
      1 => 1366894427,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1754918615517698d77819d6-99713952',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517698d77c4b82_37222434',
  'variables' => 
  array (
    'categories' => 0,
    'c' => 0,
    'v' => 0,
    'departments' => 0,
    'd' => 0,
    'courses' => 0,
    'date_min' => 0,
    'date_max' => 0,
    'date_today' => 0,
    'schedules' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517698d77c4b82_37222434')) {function content_517698d77c4b82_37222434($_smarty_tpl) {?><nav>
  ←
  <a
    href="javascript:void(0);"
    class="to_back"
    >トップページ</a>
  <p>★スケジュールを確認できます。</p>
</nav>

<article>
  
  <!-- filter -->
  <div id="filters">
    
    <p>分類：</p>
    <div id="category">
      <ul>
        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
        <li><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" checked><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>

        <?php } ?>
      </ul>
    </div>
    
    <div id="filter_params">
      <form>
        
        <!-- grade -->
        <select id="grade">
          <option value="null" selected>[全ての学年]</option>
          <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = array(1,2,3,4); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
          <?php } ?>
        </select>
        
        <!-- department -->
        <select id="department">
          <option value="null" selected>[全ての学科]</option>
          <?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
$_smarty_tpl->tpl_vars['d']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
</option>
          <?php } ?>
        </select>
        
        <!-- course -->
        <select id="course">
          <option value="null" selected>[全てのコース]</option>
          <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['courses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</option>
          <?php } ?>
        </select>
        
        <!-- date -->
        <div>
          表示期間（始）：
          <input id="date_begin"
            type="date"
            min="<?php echo $_smarty_tpl->tpl_vars['date_min']->value;?>
"
            max="<?php echo $_smarty_tpl->tpl_vars['date_max']->value;?>
"
            value="<?php echo $_smarty_tpl->tpl_vars['date_today']->value;?>
"
            >
          表示期間（終）：
          <input id="date_end"
            type="date"
            min="<?php echo $_smarty_tpl->tpl_vars['date_min']->value;?>
"
            max="<?php echo $_smarty_tpl->tpl_vars['date_max']->value;?>
"
            value="<?php echo $_smarty_tpl->tpl_vars['date_max']->value;?>
"
            >
        </div>
      </form>
    </div>
  </div>
  
  <!-- schedules -->
  <table id="schedules" class="zebra">
  </table>

  <!-- schedule detail -->
  <article id="schedule_detail">
    <header>
      <h1 class="schedule_title"> - </h1>
      <p>分　類:   <span class="schedule_category"  > - </span></p>
      <p>学　科:   <span class="schedule_department"> - </span></p>
      <p>コース: <span class="schedule_course"    > - </span></p>
      <p>学　年:   <span class="schedule_grade"     > - </span></p>
    </header>
    <pre class="schedule_content"> - </pre>
    <footer>
      <p>記入者: <address class="schedule_author"> - </address></p>
    </footer>
  </article>

  <!-- calendar -->
  <table id="calendar" class="calendar">
  </table>
</article>

<script>
var categories  = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['categories']->value);?>
')
var departments = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['departments']->value);?>
')
var courses     = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['courses']->value);?>
')
var schedules   = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['schedules']->value);?>
')
</script>
<script src="/script/show_schedule_system.js"></script>
<?php }} ?>