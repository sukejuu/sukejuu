<?php

final class conf
{
  const system_name       = '助十';
  const copyright_year    = 2013;
  const copyright_author  = 'Suke-Juu Development Committee';
  const license           = <<<'EOT'
<a
  rel="license"
  href="http://creativecommons.org/licenses/by/3.0/deed.ja"
  ><img
    alt="クリエイティブ・コモンズ・ライセンス"
    style="border-width:0"
    src="http://i.creativecommons.org/l/by/3.0/80x15.png"
    ></a>
EOT;

  public static $default_template_params =
  [ 'system_name'      => self::system_name
  , 'copyright_year'   => self::copyright_year
  , 'copyright_author' => self::copyright_author
  , 'license'          => self::license
  , 'first_command'    => 'main'
  ];
  
  const command_json_key            = 'c';
  const command_json_command_key    = 'c';
  const command_json_parameters_key = 'p';
  const html_id_container_main      = 'container_main';
  
  const database_dsn = 'sqlite:database.sqlite3/main';
  
  public static function session_name()
  { return 'session_'.self::system_name; }
  public static function session_save_path()
  { return getcwd().'/sessions'; }
}
