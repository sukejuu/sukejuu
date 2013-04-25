<?php

require_once('command_i.php');
require_once('command_return_t.php');
require_once('c_show_schedules_t.php');

final class c_add_or_modify_schedule_t
  implements command_i
{
  use show_schedules_trait;
  
  private $ps;
  
  public function __construct($parameters)
  {
    if(is_integer($parameters))
      $this->ps = $parameters;
  }
  
  public function __invoke()
  {
    global $log;
    $log->info(get_class($this).'::__invoke');
    
    $s = new Smarty();
    $s->assign(conf::$default_template_params);
    
    $data = $this->smarty_params();
    
    $s->assign($data);
    
    $is_modify = ! is_null($this->ps);
    
    $s->assign('is_modify', var_export($is_modify, true) );
    
    if( $is_modify )
    {
      $ds = main_t::$database->prepare('select * from schedules where id = ?');
      $log->debug($this->ps);
      $ds->execute([$this->ps]);
      if($ds === false)
        throw new RuntimeException('database query failed');
      $schedule = $ds->fetch(PDO::FETCH_ASSOC);
      $log->debug($schedule);
      $s->assign('schedule', json_encode($schedule) );
    }
    
    $d = date('c');
    $s->assign('datetime_now', substr($d,0,strlen($d)-6));
    
    $v = $s->fetch('regist_schedule_new.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
}

