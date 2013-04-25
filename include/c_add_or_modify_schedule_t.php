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
    if($parameters !== null)
    {
      to_array($parameters);
      $this->ps = $parameters;
    }
  }
  public function __invoke()
  {
    global $log;
    $log->info(get_class($this).'::__invoke');
    
    $s = new Smarty();
    $s->assign(conf::$default_template_params);
    
    $data = $this->smarty_params();
    
    $s->assign($data);
    $s->assign('is_modify', $this->ps !== null ? 'true' : 'false');
    
    $v = $s->fetch('regist_schedule_new.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
}

