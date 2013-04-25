var audio_play_function = function(voice_id_postfix)
{
  return function()
  {
    var id = '#voice_' + voice_id_postfix
    $('audio').not(id).each(function()
      {
        if(this.ended === false)
          this.load()
      }
    )
    var _ = $(id)[0]
    if(_.ended === true)
      _.load()
    _.play()
  }
}

var bind_audio = function(target, voice_id_postfix)
{
  var es =
  [ 'mouseover'
  , 'focus'
  ]
  var t = $(target)
  var a = audio_play_function(voice_id_postfix)
  for(var ek in es)
    t.bind(es[ek], a)
}

var bind_command = function(target, command_)
{
  $(target).click( function(){ command(command_) } )
}

var bind_audio_with_command
  = function(target, voice_id_postfix, command_)
{
  if(typeof voice_id_postfix === typeof '')
    bind_audio  (target, voice_id_postfix)
  if(typeof command_ === typeof '')
    bind_command(target, command_)
}

var multiple_bind_audio_with_command
  = function(a)
{ for(var k in a)
    bind_audio_with_command(a[k][0], a[k][1], a[k][2])
}

var change_subtitle = function(subtitle, voice_id_postfix)
{
  $('.title').html(system_name + " - " + subtitle)
  if(typeof voice_id_postfix === typeof '')
    audio_play_function(voice_id_postfix)()
}

var append_voices = function()
{
  var extensions =
  [ 'opus'
  , 'ogg'
  , 'aac'
  , 'mp3'
  , 'flac'
  , 'wav'
  ]
  
  var voices =
  [ [ 'gozaru'   , 'すけじゅうにござる']
  , [ 'failed'   , '失敗にござる']
  , [ 'to_back'  , '戻るでござる']
  , [ 'copyright', 'コピーライト、二千十三、すけじゅう・でべろっぷめんと・こみってぃー']
  , [ 'license'  , 'このソフトウェアはCC-BYでライセンスされているでござる']
  , [ 'show_schedules' , '予定を見るでござる']
  , [ 'show_courses'   , '学科とコースを確認・追加するでござる']
  , [ 'regist_schedule', '予定を追加・編集・削除するでござる']
  , [ 'add_course'     , 'コースを追加するでござる']
  , [ 'filter_category'  , '分類で絞り込むでござる']
  , [ 'filter_grade'     , '学年で絞り込むでござる' ]
  , [ 'filter_department', '学科で絞り込むでござる' ]
  , [ 'filter_course'    , 'コースで絞り込むでござる' ]
  , [ 'filter_date_begin', '表示期間の始端で絞り込むでござる' ]
  , [ 'filter_date_end'  , '表示期間の終端で絞り込むでござる' ]
  , [ 'click_to_detail', '予定をクリックして詳細を確認するでござる']
  , [ 'remove_error_no_selected', '削除したい予定を選択してから出直すでござる']
  , [ 'modify_error_no_selected', '変更したい予定を選択してから出直すでござる']
  , [ 'error_no_one_selected'   , '選択している予定を一つに絞ってから出直すでござる']
  , [ 'modify_schedule', '予定を変更するでござる']
  , [ 'add_schedule'   , '予定を追加するでござる']
  , [ 'rensa_1', 'おこにござる' ]
  , [ 'rensa_2', '激おこにござる' ]
  , [ 'rensa_3', '激おこぷんぷん丸にござる' ]
  , [ 'rensa_4', 'ムカ着火ファイアーにござる' ]
  , [ 'rensa_5', 'カム着火インフェルノォォォオオオウにござる' ]
  , [ 'rensa_6', '激オコスティックファイナリアリティーぷんぷんドリームにござるうううううううう' ]
  , [ 'rensa_7', 'じゅげむじゅげむごこうのすりきれかいじゃりすいぎょのすいぎょうまつうんらいまつふうらいまつ中略ううううにござるううううううううう' ]
  , [ 'rensa_8', 'ばよえーんばよえーんばよえーんばよえーんにござるううううう' ]
  ]
  
  for(var vk in voices)
  {
    var a = '<audio id="voice_'
          + voices[vk][0]
          + '">'
    for(var ek in extensions)
      a += '<source src="/voice/'
        +  voices[vk][1]
        +  '.'
        +  extensions[ek]
        +  '">'
    a += '</audio>'
    $('#voices').append(a)
  }
}

$(function(){
  append_voices()
  bind_audio('#copyright', 'copyright')
  bind_audio('#license'  , 'license'  )
  $('body').fadeIn(3000)
})
