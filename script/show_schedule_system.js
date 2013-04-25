var wareki = function(y)
{
  var table =
  { 平成: 1988
  , 昭和: 1925
  , 大正: 1911
  , 明治: 1867
  }
  
  for(var k in table)
  {
    var w = table[k]
    if(y > w)
      return k + (y - w)
  }
  
  return '皇紀' + (y + 660)
};

var update_courses = function()
{
  console.log('update_courses')
  var r = '<option value="null" selected>[全てのコース]</option>'
  var d = $('#department').val()
  var vs = (eval(d) === null)
    ? courses
    : courses.filter(function(v)
      { return v.attached_department_id === d }
      )
    ;
  for(var vk in vs)
  {
    var v = vs[vk]
    r += '<option value="'
      +  v.id
      +  '">'
      +  v.name
      + '</option>'
  }
  $('#course').html(r)
  update_schedules()
};

var filtered_schedules = function()
{
  var f = function(v)
  {
    // test category
    console.log(
          $('#category input[type=checkbox][value='
          + parseInt(v.category_id)
          + ']').attr('checked')
    )
    if( ! $('#category input[type=checkbox][value='
          + parseInt(v.category_id)
          + ']').prop('checked')
    )
      return false;
    
    // test grade
    var grade = eval($('#grade').val());
    if( typeof grade !== typeof null 
     && grade !== parseInt(v.grade)
    )
      return false;
    
    // test department
    var department_id = eval($('#department').val())
    if( department_id !== null
     && department_id !== attached_department_id(v.course_id)
    )
      return false
    
    // test course
    var course_id = eval($('#course').val())
    if( course_id !== null
     && course_id !== parseInt(v.course_id)
    )
      return false;
    
    // test time
    var t_begin = new Date($('#date_begin').val()).getTime()
    var t_end   = new Date($('#date_end'  ).val()).getTime()
    var v_invoke_time = parseInt(v.invoke_time);
    if( v_invoke_time < t_begin
     || v_invoke_time > (t_end + 86399999)
    )
      return false;
    
    return true;
  }
  
  return schedules.filter(f)
}

var replace_schedules = function(replacement)
{
  $('#schedules').html(replacement)
  $('#schedules tr').slice(1).click(function()
    { schedule_detail($(this).attr('data-schedule_id')) }
  )
}

var update_schedules = function()
{
  var vs = filtered_schedules();
  
  var r = '<tr><th>日付<th>件<th>記入者'
  for(var vk in vs)
  {
    var v = vs[vk]
    var d = new Date(parseInt(v.invoke_time))
    r += '<tr data-schedule_id="' + v.id + '">'
      +  '<td>'
        + wareki(d.getFullYear()) + '年'
        + (d.getMonth() + 1)      + '月'
        + d.getDate()             + '日'
      +  '<td>' + v.title
      +  '<td>' + v.author
  }
  
  replace_schedules(r)
}

var schedule_detail = function(schedule_id)
{
  //console.log(schedule_id)
  schedule_id = parseInt(schedule_id)
  var s = schedules.filter(function(v)
    { return parseInt(v.id) === schedule_id }
  )[0]
  console.log(s)
  $('#schedule_detail .schedule_title').html(s.title)
  $('#schedule_detail .schedule_category')
    .html(category(s.category_id).name)
  $('#schedule_detail .schedule_department')
    .html
    ( parseInt(s.course_id)
        ? department(attached_department_id(s.course_id)).name
        : ' - '
    )
  $('#schedule_detail .schedule_course')
    .html
    ( parseInt(s.course_id)
        ? course(s.course_id).name
        : ' - '
    )
  $('#schedule_detail .schedule_grade')
    .html(parseInt(s.grade) ? s.grade : ' - ')
  $('#schedule_detail .schedule_content').html(s.content)
  $('#schedule_detail .schedule_author').html(s.author)
  $('#schedules tr').removeClass('schedule_selected')
  $('#schedules tr[data-schedule_id='+schedule_id+']')
    .addClass('schedule_selected')
}

var category = function(id)
{
  id = parseInt(id)
  var r = categories.filter(function(v)
    { return parseInt(v.id) === id }
  )
  return r.length === 0 ? null : r[0]
}

var department = function(id)
{
  id = parseInt(id)
  var r = departments.filter(function(v)
    { return parseInt(v.id) === id }
  )
  return r.length === 0 ? null : r[0]
}

var course = function(id)
{
  id = parseInt(id)
  var r = courses.filter(function(v)
    { return parseInt(v.id) === id }
  )
  return r.length === 0 ? null : r[0]
}

var attached_department_id = function(id)
{
  var c = course(id)
  return c === null ? null : parseInt(c.attached_department_id)
}

$(function() {
  
  multiple_bind_audio_with_command
  ( [ [ '.to_back'   , 'to_back'   , 'main'      ]
    , [ '#category'  , 'filter_category'  , null ]
    , [ '#grade'     , 'filter_grade'     , null ]
    , [ '#department', 'filter_department', null ]
    , [ '#course'    , 'filter_course'    , null ]
    , [ '#date_begin', 'filter_date_begin', null ]
    , [ '#date_end'  , 'filter_date_end'  , null ]
    , [ '#schedules' , 'click_to_detail'  , null ]
    ]
  )
  
  var change_params =
  [ [ '#category input[type=checkbox]', update_schedules ]
  , [ '#grade'     , update_schedules ]
  , [ '#department', update_courses   ]
  , [ '#course'    , update_schedules ]
  , [ '#date_begin', update_schedules ]
  , [ '#date_end'  , update_schedules ]
  ]
  
  var changes = function(p)
  {
    var x = $(p[0]).each(function() {$(this).change(p[1]) } )
  }

  for(var k in change_params)
    changes(change_params[k])

} )
