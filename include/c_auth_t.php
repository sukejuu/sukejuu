<?php

require_once('include.external/lightopenid/openid.php');
require_once('command_i.php');
require_once('command_return_t.php');

abstract class c_auth_t
  implements command_i
{ 
  protected $is_authorized = false;
  protected $is_wheel      = false;
  
  protected function construct()
  { /* override this in derivered class */ }

  protected function invoke()
  { /* override this in derivered class */ }
  
  final protected function test_authorized()
  {
    if(array_key_exists('user_credentials', $_SESSION))
    {
      $this->is_authorized = true;
      $this->is_wheel      = $_SESSION['is_wheel'];
    }
    return $this->is_authorized;
  }
  
  final public function __construct($parameters)
  { global $log;
    
    $this->test_authorized();
    
    $log->info
      ( 'is_authorized: '
      . var_export($this->is_authorized, true)
      . ' (session-id: '
      . session_id()
      . ' )'
      );
    
    $this->construct($parameters);
  }
  
  final public function __invoke()
  { global $log;
    $log->info(get_class($this).'::__invoke');
    if( $this->is_authorized )
    {
      conf::$default_template_params['is_wheel'] = $_SESSION['is_wheel'];
      $log->info('to invoke');
      return $this->invoke();
    }
    else
    {
      $log->info('to auth');
      return $this->auth();
    }
  }
  
  final protected function auth()
  { global $log;
    
    $log->info(get_class($this).'::auth');
    
    $o = new LightOpenID($_SERVER['HTTP_HOST']);
    
    if($o->mode !== null)
      throw new RuntimeException
        ( 'unkown auth state (session-id: '
        . session_id()
        . ' )'
        );
    
    $log->info('to OpenID auth (session-id: '.session_id().')');
    $_SESSION['auth_suspended_command'] = serialize($this);
    $o->identity = 'https://www.google.com/accounts/o8/id';
    $o->required = ['contact/email'];
    
    //header('Location: '. $o->authUrl());
    
    $r = new command_return_t;
    $r->require_auth = true;
    $r->auth_url     = $o->authUrl();
    $log->debug($r);
    return $r;
    
  }
  
  final public function auth_resume()
  { global $log;
    
    $log->info(get_class($this).'::auth_resume');
    
    $o = new LightOpenID($_SERVER['HTTP_HOST']);
    
    if($o->mode === null)
      throw new RuntimeException
        ( 'openID auth broken (session-id: '
        . session_id()
        . ' )'
        );
    
    if($o->mode === 'cancel')
    {
      $log->warn('openID cancel (session-id: '.session_id().')');
      throw new RuntimeException('openID cancel');
    }
    
    $log->info('OpenID auth succeeded (session-id: '.session_id().')');
    
    $a = $o->getAttributes();
    $_SESSION['user_credentials'] = $a['contact/email'];
    
    $q = 'select count(*) from users where credentials=\''
       . $_SESSION['user_credentials']
       . '\''
       ;
    //$log->debug($q);
    $t = main_t::$database->query($q);
    $_SESSION['is_wheel'] = (bool)($t->fetch()[0]);
    $log->info('is_wheel: '.var_export($_SESSION['is_wheel'],true));
    conf::$default_template_params['is_wheel'] = $_SESSION['is_wheel'];
    if($_SESSION['is_wheel'])
    {
      $_SESSION['user_id'] = main_t::$database->query
      ( 'select id from users where credentials = \''
      . $_SESSION['user_credentials']
      . '\''
      )->fetch(PDO::FETCH_NUM)[0];
      $log->info('wheel user id: '.$_SESSION['user_id']);
    }
    
    //$_SESSION['auth_suspended_command'] = serialize($this);
    unset($_SESSION['auth_suspended_command']);
    $c = get_class($this);
    $c = substr($c, 2, strlen($c) - 4);
    $_SESSION['first_command'] = $c;
  }
  
}
