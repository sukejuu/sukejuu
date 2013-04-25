<?php

require_once('command_i.php');
require_once('command_return_t.php');
require_once('c_show_schedules_t.php');
require_once('c_auth_t.php');

final class c_regist_schedule_t
  extends c_auth_t
{
  use show_schedules_trait;
  
  public function construct($parameters)
  {
    if(!$this->is_wheel)
      throw new RuntimeException('permission denided');
  }

  public function invoke()
  {
    global $log;
    $log->info(get_class($this).'::invoke');
    
    $s = new Smarty();
    $s->assign(conf::$default_template_params);
    
    $data = $this->smarty_params();
    
    $s->assign($data);
    
    $v = $s->fetch('regist_schedule.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
}

