<?php

require_once('command_i.php');
require_once('command_return_t.php');

final class c_remove_schedules_t
  implements command_i
{
  private $ps;

  public function __construct($parameters)
  {
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
