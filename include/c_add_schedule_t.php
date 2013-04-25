<?php

require_once('command_i.php');
require_once('command_return_t.php');
require_once('c_modify_schedule_t.php');

final class c_add_schedule_t
  implements command_i
{
  use schedule_validator_trait;
  
  private $ps;
  
  public function __construct($parameters)
  {
    global $log;
    $log->info(get_class($this).'::__construct');
    
    if(!is_null($parameters))
    {
      to_array($parameters);
      $this->ps = $parameters;
    }
  }
  
  public function __invoke()
  {
    global $log;
    $log->info(get_class($this).'::__invoke');
    $log->info($this->ps);
    
    $r = new command_return_t;
    
    if($this->validate($this->ps))
    {
      $s = main_t::$database->prepare
      ( 'insert into schedules'
      . ' ( category_id'
      . ' , grade'
      . ' , course_id'
      . ' , invoke_time'
      . ' , time_span'
      . ' , title'
      . ' , content'
      . ' , register_user_id'
      . ' , assigned_user_id'
      . ' ) values(?,?,?,?,?,?,?,?,?)'
      );
      
      $x = $s->execute
      ( [ $this->ps['category_id']
        , $this->ps['grade']
        , $this->ps['course_id']
        , $this->ps['invoke_time']
        , $this->ps['time_span']
        , $this->ps['title']
        , $this->ps['content']
        , 1 // ToDo: impl with auth
        , 1 // ToDo: impl with auth
        ]
      );
      $log->info('execute result: '.$x);
      $r->return = true;
    }
    else
      $r->return = false;
      
    return $r;
  }
}
