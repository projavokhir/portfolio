<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."view_classes");
spl_autoload_extensions("_class.php");
spl_autoload_register();


/* Site settings */

define("SITE_NAME", "PY PRODUCTION");
define("SITE_ADMIN", "PY");
define("SITE_ADDRESS", "http://pyproduction.uz/");
define("ADMIN_NAME", "PY");

/*  DB Settings */
define("DB_HOST", "localhost");
define("DB_USER", "yakhyayev_py");
define("DB_PASS", "Mr.javo99");
define("DB", "yakhyayev_production");

/* Register settings */
define("USER_HASH", "19992508_javo8484");

/* Templates dir */
define("DIR_TMPL", "tmpl/");

/* Main layout of the site */
define("MAIN_LAYOUT", "index");

/* Main design of the site */
define("MAIN_DIR", "view/");
define("MAIN_TITLE", SITE_NAME);

/* Social */
define("PY_FB", "pyproduction.uz");
define("PY_IG", "py_production");
define("PY_VK", "pyproduction");
define("PY_YT", "pyproduction");
define("PY_TG", "pyproduction");

?>