var command_json_key            = '{$command_json_key}';
var command_json_command_key    = '{$command_json_command_key}';
var command_json_parameters_key = '{$command_json_parameters_key}';
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
{ container_main = $('#{$html_id_container_main}')
  
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
  command('{$first_command}')
})
