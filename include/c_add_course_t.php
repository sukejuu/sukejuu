<?php

require_once('command_i.php');
require_once('command_return_t.php');
require_once('c_auth_t.php');

final class c_add_course_t
  extends c_auth_t
{ 
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
    $log->info($this->ps);
  }

  public function invoke()
  {
    global $log;
    $log->info(get_class($this).'::__invoke');
    
    if(!$this->is_wheel)
      throw new RuntimeException('permission denided');
    
    return (is_null($this->ps))
      ? $this->invoke_show()
      : $this->invoke_add()
      ;
  }

  private function invoke_add()
  {
    global $log;
    $log->info(get_class($this).'::invoke_add');
    
    $r = new command_return_t;
    
    $log->debug($this->ps);
    
    try
    {
      if(  strlen($this->ps['department']) === 0
        || strlen($this->ps['course']) === 0
        )
        throw new RuntimeException('department or course is empty');
      
      $this->add_department();
      $this->add_course();
      
      $r->return = true;
    }
    catch(Exception $e)
    {
      $r->has_error = true;
      $r->error = new command_error_t;
      $r->error->what       = $e->getMessage();
      $r->error->command    = get_class($this);
      $r->error->parameters = $this->ps;
      $r->error->time       = date('c'); 
      $log->debug($r);
      $r->return = false;
    }
    return $r;
  }

  private function add_course()
  {
    global $log;
    $log->info(get_class($this).'::add_course');
    
    $s = main_t::$database->prepare
      ( 'insert into courses(name,attached_department_id)'
      . ' values(?,(select id from departments where name = ?))'
      );
    if($s->execute([$this->ps['course'],$this->ps['department']]) === false)
      throw new RuntimeException('database; cannot insert the new course');
  }

  private function add_department()
  {
    global $log;
    $log->info(get_class($this).'::add_department');
    
    $s = main_t::$database->prepare('select count(*) from departments where name = ?');
    $t = $s->execute([ $this->ps['department'].'z' ]);
    
    if($t === false)
      throw new RuntimeException('database failed');
    
    if( ! (bool) $s->fetch(PDO::FETCH_NUM)[0] )
      $s = main_t::$database->query
        ( 'insert into departments(name) values('
        . $this->ps['department']
        . ')'
        );
  }

  private function invoke_show()
  { 
    global $log;
    $log->info(get_class($this).'::invoke_show');
    $s = new Smarty();
    $s->assign(conf::$default_template_params);
    $f = function($a){ return $a[0]; };
    $ds = main_t::$database
      ->query('select name from departments')
      ->fetchAll(PDO::FETCH_NUM);
    $params =
    [ 'departments' => array_map($f, $ds)
    ];
    $s->assign($params);
    $v = $s->fetch('add_course.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
}
