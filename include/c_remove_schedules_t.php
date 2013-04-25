<?php

require_once('command_i.php');
require_once('command_return_t.php');
require_once('c_auth_t.php');

final class c_remove_schedules_t
  extends c_auth_t
{
  private $ps;

  public function construct($parameters)
  {
    if(!$this->is_wheel)
      throw new RuntimeException('permission denided');
    
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
    
    $log->info($this->ps);
    
    $r = new command_return_t;
    
    try
    {
      main_t::$database->beginTransaction();
      
      $s = main_t::$database->prepare('delete from schedules where id = ?');
      
      foreach($this->ps as $v)
        $s->execute([$v]);
      
      main_t::$database->commit();
      
      $r->return = true;
    }
    catch(Exception $e)
    {
      $log->warn($e->getMessage());
      $r->return = false;
    }
    
    return $r;
  }
}
