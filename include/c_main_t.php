<?php

require_once('command_i.php');
require_once('command_return_t.php');

final class c_main_t
  implements command_i
{ public function __construct($parameters)
  { 
  }
  public function __invoke()
  { $s = new Smarty();
    $s->assign(conf::$default_template_params);
    $v = $s->fetch('main.html');
    
    $r = new command_return_t;
    $r->require_change_view = true;
    $r->view                = $v;
    return $r;
  }
}

