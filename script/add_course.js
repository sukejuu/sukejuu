$(function(){
  change_subtitle('学科とコースの追加', 'add_course')
  
  multiple_bind_audio_with_command
  ( [ [ '.to_main'        , 'to_back'   , 'main'        ]
    , [ '.to_show_courses', 'to_back'   , 'show_courses']
    , [ '#add_course'     , 'add_course', null          ]
    ]
  )
  
  $('#add_course').click(function(){
    var is_text = $('#is_text').is(':checked')
    var params = 
    { department: $('#department_' + (is_text ? 'text' : 'select')).val()
    , course    : $('#course_text').val()
    }
    console.log('add_course', params)
    command('add_course', params, function(r)
    {
      if(r.return)
        command('show_courses')
      else
      {
        audio_play_function('failed')()
        console.log(r.return)
      }
    })
  })
  
  $('#is_text').bind('change',function()
  {
    $('#department_select').toggle()
    $('#department_text'  ).toggle()
  })
})
