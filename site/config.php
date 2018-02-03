<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
define('HTTP_SERVER', $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/');
define('HTTP_RDWALA', $protocol . $_SERVER['HTTP_HOST'] . rtrim(rtrim(dirname($_SERVER['SCRIPT_NAME']), 'app'), '/.\\') . '/');
define('DIR_APP', str_replace('\\', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SYSTEM', str_replace('\\', '/', realpath(dirname(__FILE__) . '/../')) . '/system/');
define('DIR_RDWALA', str_replace('\\', '/', realpath(DIR_APP . '../')) . '/');
define('DIR_LANGUAGE', DIR_APP . 'language/');
define('DIR_TEMPLATE', DIR_APP . 'view/template/');
//define('MESSAGE_SERVICE_URL','http://203.92.40.186:8443/Sun3/Send_SMS2x?'); 
define('MESSAGE_SERVICE_URL','http://www.smsjust.com/blank/sms/user/urlsms.php?');
//define('USER','testuser');
//define('PASSWORD','testuser');
//define('SENDERID','MCALRT');

define('USER','buybye');
define('PASSWORD','buybye@admin');
define('SENDERID','BBPAPR');

// DB

define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'applmind');
define('DB_PASSWORD', 'manishkl');
define('DB_DATABASE', 'applmind_rdw');

/*define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'applmind_rdw');
define('DB_PASSWORD', 'kmanishl');
define('DB_DATABASE', 'applmind_rdw');*/
define('DB_PREFIX', 'rdw_');