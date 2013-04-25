var update_schedules_removable = function()
{
  var vs = filtered_schedules();
  
  var r = '<tr>'
        + '<th><input type="checkbox" data-delegate>'
        + '<th>日付<th>件<th>記入者'
  for(var vk in vs)
  {
    var v = vs[vk]
    var d = new Date(parseInt(v.invoke_time))
    r += '<tr data-schedule_id="' + v.id + '">'
      +  '<td><input type="checkbox">'
      +  '<td>'
        + wareki(d.getFullYear()) + '年'
        + (d.getMonth() + 1)      + '月'
        + d.getDate()             + '日'
      +  '<td>' + v.title
      +  '<td>' + v.author
  }
  
  replace_schedules(r)
  set_delegate()
}

var set_delegate = function()
{
  var delegate = $('#schedules input[data-delegate]')
  delegate.change
  ( function()
    {
      var f = delegate.attr('checked') === 'checked'
      $('#schedules input[type=checkbox]')
        .attr('checked', f)
    }
  )
}

var selected_schedule_id = function()
{
  var cs
    = $('#schedules input')
      .not('[data-delegate]')
      .filter
      ( function(k,v)
        { return $(v).attr('checked') === 'checked' }
      )
  
  var targets = []
  cs.parent()
    .parent()
    .each
    ( function()
      { targets.push(parseInt($(this).attr('data-schedule_id'))) }
    )
  
  return targets
}

var remove_schedule = function()
{
  var ts = selected_schedule_id()

  if(ts.length === 0)
  {
    audio_play_function('remove_error_no_selected')()
    return
  }
  
  console.log('remove_schedules', ts)
  command('remove_schedules', ts)
}

var modify_schedule = function()
{
  var ts = selected_schedule_id()

  switch(ts.length)
  {
    case 0:
      audio_play_function('modify_error_no_selected')()
      return
    case 1:
      break;
    default:
      audio_play_function('error_no_one_selected')()
      return;
  }
  
  console.log('add_or_modify_schedule', ts[0])
  command('add_or_modify_schedule', ts[0])
}

var add_schedule = function()
{
  console.log('add_or_modify_schedule')
  command('add_or_modify_schedule')
}

$(function(){
  change_subtitle('予定登記', 'regist_schedule')
  /*
  multiple_bind_audio_with_command
  ( [ [ '#remove_schedule', 'remove_schedule', null ]
    , [ '#modify_schedule', 'modify_schedule', null ]
    , [ '#add_schedule'   , 'add_schedule'   , null ]
    ]
  )
  */
  
  $('#remove_schedule').click(remove_schedule)
  $('#modify_schedule').click(modify_schedule)
  $('#add_schedule'   ).click(add_schedule   )
  
  update_schedules = update_schedules_removable
  update_schedules()
})
