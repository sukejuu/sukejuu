<?php

require_once('command_i.php');
require_once('command_return_t.php');
require_once('c_modify_schedule_t.php');
require_once('c_auth_t.php');

final class c_add_schedule_t
  extends c_auth_t
{
  use schedule_validator_trait;
  
  private $ps;
  
  public function construct($parameters)
  {
    global $log;
    $log->info(get_class($this).'::__construct');
    
    if(!is_null($parameters))
    {
      to_array($parameters);
      $this->ps = $parameters;
    }
  }
  
  public function invoke()
  {
    global $log;
    $log->info(get_class($this).'::__invoke');
    
    if(!$this->is_wheel)
      throw new RuntimeException('permission denided');
    
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
        , $_SESSION['user_id']
        , $_SESSION['user_id']
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
