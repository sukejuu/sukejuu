<?php /* Smarty version Smarty-3.1.13, created on 2013-04-25 21:52:54
         compiled from "./templates/regist_schedule_new.html" */ ?>
<?php /*%%SmartyHeaderCode:246368710517698d9c71934-50391108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aee23fe25a5328d07233b8753f1fb374032c05e2' => 
    array (
      0 => './templates/regist_schedule_new.html',
      1 => 1366894354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '246368710517698d9c71934-50391108',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517698d9ce0572_60954816',
  'variables' => 
  array (
    'categories' => 0,
    'c' => 0,
    'v' => 0,
    'departments' => 0,
    'd' => 0,
    'courses' => 0,
    'datetime_now' => 0,
    'is_modify' => 0,
    'schedules' => 0,
    'schedule' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517698d9ce0572_60954816')) {function content_517698d9ce0572_60954816($_smarty_tpl) {?><nav>
  ←
  <a
    class="to_main"
    href="javascript:void(0);"
    >トップページ</a>
  &gt;
  <a
    class="to_regist_schedule"
    href="javascript:void(0);"
    >予定の削除、変更、追加</a>
  <p>★予定の変更・新規追加を行うでござる</p>
</nav>

<article>
  <div id="regist">
    <form>

      <!-- category -->
      分類:
      <select id="category">
        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</option>
        <?php } ?>
      </select>
      
      <!-- grade -->
      学年:
      <select id="grade">
        <option value="0">[全ての学年] 
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = array(1,2,3,4); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>

        <?php } ?>
      </select>

      <!-- department -->
      学科: 
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
      コース: 
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

      <!-- invoke_time -->
      開始日時:
      <input id="datetime_begin"
        type="datetime-local"
        value="<?php echo $_smarty_tpl->tpl_vars['datetime_now']->value;?>
"
        >
      
      <!--  -->
      終了日時:
      <input id="datetime_end"
        type="datetime-local"
        value="<?php echo $_smarty_tpl->tpl_vars['datetime_now']->value;?>
"
        >
      <!-- title -->
      件名:
      <input id="title">
      
      <!-- content -->
      内容:
      <textarea id="content"></textarea>
      
    </form>
  </div>
  <a
    id="add_or_modify_schedule"
    class="standard_button"
    href="javascript:void(0);"
    ><?php if ($_smarty_tpl->tpl_vars['is_modify']->value==='true'){?>変更<?php }else{ ?>追加<?php }?></a>

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
<script>
var is_modify = <?php echo $_smarty_tpl->tpl_vars['is_modify']->value;?>

var schedule
try { schedule = JSON.parse('<?php echo $_smarty_tpl->tpl_vars['schedule']->value;?>
') } catch(e) { }
</script>
<script>
var params = function()
{
  var r = is_modify ? schedule : { }

  r.category_id = $('#category').val()
  r.grade       = $('#grade').val()
  r.course_id   = $('#course').val()
  if(typeof r.course_id !== typeof 0)
    r.course_id = 0
  r.invoke_time = $('#datetime_begin')[0].valueAsNumber
  r.time_span   = $('#datetime_end')[0].valueAsNumber - r.invoke_time
  r.title       = $('#title').val()
  r.content     = $('#content').val()

  return r;
}

var add_or_modify_schedule = function()
{
  var c = (is_modify ? 'modify' : 'add') + '_schedule'
  var ps = params()
  console.log(c, ps)
  command
  ( c
  , ps
  , function(r)
    {
      console.log(r)
      if(r.return)
        command('regist_schedule')
      else
        audio_play_function('failed')()
    }
  )
}

$(function() {
  
  var f = function(e)
  {
    $(e).unbind('mouseover')
    $(e).unbind('focus')
  }
  
  var unbinds = 
  [ '#category'
  , '#grade'
  , '#department'
  , '#course'
  , '#date_begin'
  , '#date_end'
  , '#title'
  , '#content'
  ]

  for(var k in unbinds)
    f(unbinds[k])
  
  //$('#department').change(update_courses);
  
  if(is_modify)
  {
    change_subtitle('予定登記（変更）', 'modify_schedule')
    $('#category'  ).val(schedule.category_id)
    $('#grade'     ).val(schedule.grade)
    $('#department').val(attached_department_id(schedule.course_id))
    $('#course'    ).val(schedule.course_id)
    $('#title'     ).val(schedule.title)
    $('#content'   ).val(schedule.content)
  }
  else
    change_subtitle('予定登記（新規）', 'add_schedule')

  multiple_bind_audio_with_command
  ( [ [ '.to_main'           , 'to_back'   , 'main'           ]
    , [ '.to_regist_schedule', 'to_back'   , 'regist_schedule']
    , [ '#add_or_modify_schedule'
      , is_modify
        ? 'modify_schedule'
        : 'add_schedule'
      , null
      ]
    ]
  )
  
  $('#add_or_modify_schedule').click(add_or_modify_schedule)
  $('#datetime_begin').change
  ( function()
    {
      var b = $('#datetime_begin')
      var e = $('#datetime_end')
      e.attr('min', b.val())
      if(e[0].valueAsNumber < b[0].valueAsNumber)
        e.val(b.val())
    }
  )
  
  update_schedules = function() { }
} )
</script>
<?php }} ?>