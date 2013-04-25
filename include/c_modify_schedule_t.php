<?php

require_once('command_i.php');
require_once('command_return_t.php');

trait schedule_validator_trait
{
  private function validate($s, $force_escape = true)
  {
    global $log;
    $log->info(get_class($this).'::validate');
    
    $p = main_t::$database->query('select count(*) from categories where id = '.$s['category_id']);
    if($p->fetch(PDO::FETCH_NUM)[0] < 1)
      return false;
      
    $p = main_t::$database->query('select count(*) from courses where id = '.$s['course_id']);
    if($p->fetch(PDO::FETCH_NUM)[0] < 1)
      return false;
      
    $p = main_t::$database->query('select count(*) from users where id = '.$s['register_user_id']);
    if($p->fetch(PDO::FETCH_NUM)[0] < 1)
      return false;
      
    $p = main_t::$database->query('select count(*) from users where id = '.$s['assigned_user_id']);
    if($p->fetch(PDO::FETCH_NUM)[0] < 1)
      return false;
      
    if($s['grade'] < 0 || $s['grade'] > 4)
      return false;
    
    if($force_escape)
    {
      $parameters['title']   = htmlspecialchars($parameters['title']);
      $parameters['content'] = htmlspecialchars($parameters['content']);
    }
    else if(strpbrk($s['title'], '<'))
        return false;
    
    return true;
  }
}

final class c_modify_schedule_t
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
      ( 'update schedules'
      . ' set category_id = ?'
      .   ' , grade = ?'
      .   ' , course_id = ?'
      .   ' , invoke_time = ?'
      .   ' , time_span = ?'
      .   ' , title = ?'
      .   ' , content = ?'
      .   ' , register_user_id = ?'
      .   ' , assigned_user_id = ?'
      . ' where id = ?'
      );
      
      $x = $s->execute
      ( [ $this->ps['category_id']
        , $this->ps['grade']
        , $this->ps['course_id']
        , $this->ps['invoke_time']
        , $this->ps['time_span']
        , $this->ps['title']
        , $this->ps['content']
        , $this->ps['register_user_id']
        , $this->ps['assigned_user_id']
        , $this->ps['id']
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
