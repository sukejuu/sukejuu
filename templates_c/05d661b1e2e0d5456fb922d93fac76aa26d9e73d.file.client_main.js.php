<?php /* Smarty version Smarty-3.1.13, created on 2013-05-01 00:22:22
         compiled from "./templates/client_main.js" */ ?>
<?php /*%%SmartyHeaderCode:1655713865517698d44e2e70-26263651%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05d661b1e2e0d5456fb922d93fac76aa26d9e73d' => 
    array (
      0 => './templates/client_main.js',
      1 => 1367331604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1655713865517698d44e2e70-26263651',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517698d451d999_63017807',
  'variables' => 
  array (
    'command_json_key' => 0,
    'command_json_command_key' => 0,
    'command_json_parameters_key' => 0,
    'html_id_container_main' => 0,
    'first_command' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517698d451d999_63017807')) {function content_517698d451d999_63017807($_smarty_tpl) {?>var command_json_key            = '<?php echo $_smarty_tpl->tpl_vars['command_json_key']->value;?>
';
var command_json_command_key    = '<?php echo $_smarty_tpl->tpl_vars['command_json_command_key']->value;?>
';
var command_json_parameters_key = '<?php echo $_smarty_tpl->tpl_vars['command_json_parameters_key']->value;?>
';
var container_main = null;

var view_status =
[ 'main'
, 'show_schedules'
, 'show_courses'
, 'add_course'
, 'add_course'
, 'add_schedule'
, 'add_or_modify_schedule'
]

var change_view = function(content, history)
{
  $('body > header').fadeOut(2000)
  container_main.slideUp(2000, function()
  {
    container_main.html(content)
    if(typeof history === typeof '')
    {
      console.log('change_view, pushState: ' + history)
      window.history.pushState(null,null,history)
    }
    $('body > header').fadeIn(2000)
    container_main.slideDown(2000)
  })
}

var command = function(c, ps, f)
{ container_main = $('#<?php echo $_smarty_tpl->tpl_vars['html_id_container_main']->value;?>
')
  
  var command_json = {}
  command_json[command_json_command_key] = c
  if(ps !== void 0)
    command_json[command_json_parameters_key] = ps
  
  var q = {};
  try
  {
    q[command_json_key] = JSON.stringify(command_json)
  }
  catch(e)
  {
    console.log('Exception on JSON.parse: ', e)
    return;
  }

  var f_default = function(r)
  {
    r = JSON.parse(r)
    
    if(r['has_error'])
      console.log('command error:', r['error'])
    
    if(r['require_auth'])
    {
      location.href = r['auth_url']
      return
    }
    
    if(typeof f === typeof(function(){}))
      if(f(r) === false)
        return;
    
    if(r['require_change_view'])
      change_view(r['view'], c);
  }
  
  $.post('/', q, f_default)
}

$(function(){
  window.addEventListener
  ( 'popstate'
  , function(e)
    {
      var s = location.pathname.substr(1)
      if(view_status.some(function(a){ return a === s }))
      {
        console.log('popstate, status go back to : ' + s)
        command(s)
      }
      else
        console.log('popstate, undefined status: ' + s)
      e.preventDefault();
    }
  )
  command('<?php echo $_smarty_tpl->tpl_vars['first_command']->value;?>
')
})
<?php }} ?>