$(function(){
  change_subtitle('トップページ', 'gozaru')
  multiple_bind_audio_with_command
  ( [ [ '#show_schedules' , 'show_schedules' , 'show_schedules' ]
    , [ '#show_courses'   , 'show_courses'   , 'show_courses'   ]
    , [ '#regist_schedule', 'regist_schedule', 'regist_schedule']
    , [ '.gozaru'         , 'gozaru'         , null             ]
    , [ '.title'          , 'gozaru'         , null             ]
    ]
  )
  $('#top_img').click(function(){
    if(typeof this.counter !== typeof 0)
      this.counter = 0
    if(this.counter < 8)
    {
      ++this.counter
      console.log(this.counter + '連鎖！')
      audio_play_function('rensa_' + this.counter)()
    }
    if(this.counter > 7)
    {
      console.log('隠し機能を見破るとはお主なかなかやるでござる！')
      $('#top_img').addClass('dream')
      $('#top_img').damuro({
        sandbox:    '/deviantart/deviantart_muro_sandbox.html',
        background: '/img/sukejuu.png'
      });
      $('#top_img').width(710)
      $('#top_img .damuro-container').width(710)
    }
  })
})
