<?php

require_once('command_i.php');
require_once('command_return_t.php');

final class c_show_courses_t
  implements command_i
{ public function __construct($parameters)
  { 
  }
  public function __invoke()
  { $s = new Smarty();
    $s->assign(conf::$default_template_params);
    
    $this->assign_conf_list($s);
    
    $v = $s->fetch('show_courses.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
  private function assign_conf_list(&$s)
  { global $log;
    
    $log->info(get_class($this).'::assign_conf_list');
    
    $cs = main_t::$database->query
      ( 'select id'
      .       ',name'
      .       ',(select name'
      .       ' from departments'
      .       ' where id = courses.attached_department_id'
      .       ')'
      . ' from courses'
      );
    
    $fetched = $cs->fetchAll(PDO::FETCH_NUM);
    
    $f = function($v)
         {
           $r = [ 'course_id'       => $v[0]
                , 'course_name'     => $v[1]
                , 'department_name' => $v[2]
                ];
           return $r;
         };
    
    $conf_list = array_map($f, $fetched);
    //$log->debug($conf_list);
    $s->assign('conf_list', $conf_list);
  }
}

