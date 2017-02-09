<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

define('FILE_READ_MODE', 0644);

define('FILE_WRITE_MODE', 0666);

define('DIR_READ_MODE', 0755);

define('DIR_WRITE_MODE', 0777);



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/



define('FOPEN_READ',							'rb');

define('FOPEN_READ_WRITE',						'r+b');

define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care

define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care

define('FOPEN_WRITE_CREATE',					'ab');

define('FOPEN_READ_WRITE_CREATE',				'a+b');

define('FOPEN_WRITE_CREATE_STRICT',				'xb');

define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



//define('THEME_URL', 							'https://shirtscore/assets/theme/');



// define('THEME_URL', 							'http://www.shirtscore.com/assets/theme/');



define('THEME_URL', 							'http://205.134.251.196/~examin8/CI/shirtscore/assets/theme/');



// define('FB_APP_ID',	'651995074849950');

// define('FB_APP_SECRET',	'2ce3c7721c99c2dc4e59fbbcd92381eb');

// define('SECURE_SITE_URL','https://www.shirtscore.com/');//

define('FB_APP_ID',	'578966452159790');//651995074849950
define('FB_APP_SECRET',	'2f2672fc6c90e45dde1447ba92a5d3bc');//2ce3c7721c99c2dc4e59fbbcd92381eb
//define('SECURE_SITE_URL','https://www.shirtscore.com/');//
define('SECURE_SITE_URL','http://205.134.251.196/~examin8/CI/shirtscore/');//
/* End of file constants.php */

/* Location: ./application/config/constants.php */