<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('DB_DATE_FORMAT', 'Y-m-d');
define('DB_TIME_FORMAT', 'H:i:s');
define('DEFAULT_TIMEZONE', 'UTC');
define('DB_DATETIME_FORMAT', DB_DATE_FORMAT.' '.DB_TIME_FORMAT);

define('DATA_LIMIT', 6);

define('TBL_PREFIX', 'tbl_');
define('TBL_LANGUAGE_TRANSLATION', TBL_PREFIX.'language_translation');
define('TBL_ACTIVITY_LOGS', TBL_PREFIX.'activity_logs');
define('TBL_EMAIL_TEMPLATE', TBL_PREFIX.'email_template');
define('TBL_RECRUITERS', TBL_PREFIX.'recruiters');
define('TBL_FACILITIES', TBL_PREFIX.'facilities');
define('TBL_SETTINGS', TBL_PREFIX.'settings');
define('TBL_LANGUAGE', TBL_PREFIX.'language');
define('TBL_CATEGORY', TBL_PREFIX.'category');
define('TBL_GALLERY', TBL_PREFIX.'gallery');
define('TBL_SLIDER', TBL_PREFIX.'slider');
define('TBL_ANNOUNCEMENTS', TBL_PREFIX.'announcements');
define('TBL_EVENT', TBL_PREFIX.'event');
define('TBL_ADMIN', TBL_PREFIX.'admin');
define('TBL_PAGES', TBL_PREFIX.'pages');
define('TBL_ROLE', TBL_PREFIX.'role');
define('TBL_FACULTY', TBL_PREFIX.'faculty');
define('TBL_TESTIMONIAL', TBL_PREFIX.'testimonial');
define('TBL_DOCUMENTS', TBL_PREFIX.'documents');
define('TBL_BLOG', TBL_PREFIX.'blog');
define('TBL_SPECIALISATION', TBL_PREFIX.'specialisation');
define('TBL_COURSE', TBL_PREFIX.'course');
define('TBL_CONTACT', TBL_PREFIX.'contact');
define('TBL_INQUIRY',TBL_PREFIX.'inquiry');
define('TBL_COURSE_ENQUIRY',TBL_PREFIX.'course_enquiry');
define('TBL_EXAM_REGISTRATION',TBL_PREFIX.'exam_registration');