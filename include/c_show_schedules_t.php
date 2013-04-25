<?php

require_once('command_i.php');
require_once('command_return_t.php');

trait show_schedules_trait
{
  public function smarty_params()
  {
    $f = function($columns, $table = 'schedules', $opt = '')
    {
      $q = 'select '
         . ( is_array($columns)
             ? implode(',',$columns)
             : $columns
           )
         .' from '.$table.' '.$opt;
      global $log; $log->debug($q);
      return main_t::$database
        ->query($q)
        ->fetchAll(PDO::FETCH_ASSOC);
    };

    $c = ['id','name'];

    $data =
    [ 'categories'  => $f($c, 'categories')
    , 'departments' => $f($c, 'departments')
    , 'courses'     => $f
      ( array_merge($c, ['attached_department_id'])
      , 'courses'
      )
    , 'schedules'   => $f
        ( [ 'id'
          , 'category_id'
          , 'title'
          , 'invoke_time'
          , 'time_span'
          , 'content'
          , '(select name from users'
           .' where id = schedules.register_user_id'
           .') as author'
          , '(select name from users'
           .' where id = schedules.assigned_user_id'
           .') as assiend'
          , 'course_id,grade'
          ]
        , 'schedules'
        , 'order by invoke_time'
        )
    , 'date_min'   => date( 'Y-m-d'
                          , $f('min(invoke_time) as t')[0]['t'] / 1000
                          )
    , 'date_max'   => date( 'Y-m-d'
                          , $f('max(invoke_time) as t')[0]['t'] / 1000
                          )
    , 'date_today' => date('Y-m-d')
    ];
    
    return $data;
  }
  
}

final class c_show_schedules_t
  implements command_i
{
  use show_schedules_trait;
  
  public function __construct($parameters)
  {
  }

  public function __invoke()
  {
    global $log;
    $log->info(get_class($this).'::invoke');
    
    $s = new Smarty();
    $s->assign(conf::$default_template_params);
    
    $data = $this->smarty_params();
    
    $s->assign($data);
    
    $v = $s->fetch('show_schedule.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
}

