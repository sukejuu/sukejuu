<?php

require_once('command_i.php');
require_once('command_return_t.php');

final class c_add_schedule_t
  implements command_i
{ public function __construct($parameters)
  { 
  }
  public function __invoke()
  {
    $r = new command_return_t;
    $r->return = true;
    return $r;
  }
}

