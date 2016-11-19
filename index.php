<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

/**
 * translator:昌维 <867597730@qq.com>
 * repository:https://github.com/cw1997/CodeIgniter-Simplified-Chinese
 * Translated at 2016-11-19 17:44:18
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 * 应用环境
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 * 你可以根据你的当前环境载入不同的配置。
 * 设置这些环境变量也会影响一些事情比如日志和错误报告。
 *
 * This can be set to anything, but default usage is:
 * 这里可以设置为任何值，默认用法有：
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 * 注意：如果你修改了这些值。那么下面的 error_reporting() 也会被同时修改。
 */
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 * 错误报告
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * 不同的环境需要不同的错误报告等级。
 * By default development will show errors but testing and live will hide them.
 * 默认开发环境下将显示所有错误报告，但是在测试和线上环境将会隐藏错误报告。
 */
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		// echo 'The application environment is not set correctly.';
		echo '应用环境设置错误。';
		exit(1); // EXIT_ERROR 退出码
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 * 系统目录名
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * 这个变量必须为你的“system”目录名称。
 * Set the path if it is not in the same directory as this file.
 * 如果没有这个相同的文件在同一目录下，那么请设置该路径。
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 * 应用目录名
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 * 如果你希望该前端控制器使用一个和默认的"application"不一样的目录，
 * 那么你可以在这里设置它的名字。这个目录当然可以重命名，
 * 也可以放在你服务器上的任何位置。
 * 如果你这样做，请使用它在服务器上的绝对（完整）路径。
 * For more info please see the user guide:
 * 如需获取更多信息请参阅用户指南：
 *
 * https://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 * 请不要加上斜杠！
 */
	$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * VIEW DIRECTORY NAME
 * 视图目录名
 *---------------------------------------------------------------
 *
 * If you want to move the view directory out of the application
 * directory, set the path to it here. The directory can be renamed
 * and relocated anywhere on your server. If blank, it will default
 * to the standard location inside your application directory.
 * If you do move this, use an absolute (full) server path.
 * 如果你想移动视图目录到Application目录以外，请在这里设置该目录。
 * 这个目录当然可以重命名，也可以放在你服务器上的任何位置。
 * 如果留空，框架将默认使用你Application目录中的标准路径。
 * 如果你移动了该目录，请使用它在服务器上的绝对（完整）路径。
 *
 * NO TRAILING SLASH!
 * 请不要加上斜杠！
 */
	$view_folder = '';


/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * 默认控制器
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here. For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 * 正常情况下你可以在routes.php文件中设置默认的控制器。
 * 然而你也可以通过在这里硬编码一个特殊的控制器（类/函数）实现自定义路由。
 * 对于大多数应用来说，你最好不要在这里设置路由，除非有特殊情况，
 * 比如说当你需要共享一个公共的CI安装程序在一个特殊的前端控制器中，
 * 这种情况下你需要通过这种方式覆盖标准的路由。
 *
 * IMPORTANT: If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller. Leave the function name blank if you need
 * to call functions dynamically via the URI.
 * 注意：如果你在这里设置了一个路由，那么其他控制器将无法被调用。
 * 实际上，这种优先级限制了你的应用只能访问一个特殊的控制器。
 * 如果你想要通过URL动态调用函数，那么请保留该函数名为空。
 *
 * Un-comment the $routing array below to use this feature
 * 你可以去掉下面$routing数组的注释用于开启这个特性
 */
	// The directory name, relative to the "controllers" directory.  Leave blank
	// if your controller is not in a sub-directory within the "controllers" one
	// 这个目录名和"controllers"目录相关联，
	// 如果你的控制器不在"controllers"中的子目录下，请保留该项为空。
	// $routing['directory'] = '';

	// The controller class file name.  Example:  mycontroller
	// 控制器类文件名。例如：mycontroller
	// $routing['controller'] = '';

	// The controller function you wish to be called.
	// 你希望被调用的控制器函数
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 *  自定义配置项
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 * 下列的$assign_to_config数组将在初始化的时候被动态传递到配置类里面。
 * 这允许你自动一配置项或者覆盖config.php文件里面的任何默认值。
 * 这可以方便的允许你在多个前端控制器文件中包含不同的配置项，
 * 并且共享同一个应用。
 *
 *
 * Un-comment the $assign_to_config array below to use this feature
 * 你可以去掉下面$assign_to_config数组的注释用于开启这个特性
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';
	// $assign_to_config['配置键'] = '配置值';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// 用户配置结束。请不要修改此行以后的部分。
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 *  分解系统路径用于提高程序可靠性
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	// 为CLI（命令行）请求设置正确的目录
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (($_temp = realpath($system_path)) !== FALSE)
	{
		$system_path = $_temp.DIRECTORY_SEPARATOR;
	}
	else
	{
		// Ensure there's a trailing slash
		// 去除末尾的斜杠
		$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
	}

	// Is the system path correct?
	// 判断系统路径是否正确
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		// echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		echo '您的系统文件夹路径似乎没有正确设置。请打开以下文件并将它修改正确: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG 退出码
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 *  我们得知了这些路径，现在设置主要路径的常量。
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	// 本文件的文件名
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// Path to the system directory
	// system系统目录
	define('BASEPATH', $system_path);

	// Path to the front controller (this file) directory
	// 前端控制器（本文件）所在目录
	define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

	// Name of the "system" directory
	// "system"目录
	define('SYSDIR', basename(BASEPATH));

	// The path to the "application" directory
	// "application"目录
	if (is_dir($application_folder))
	{
		if (($_temp = realpath($application_folder)) !== FALSE)
		{
			$application_folder = $_temp;
		}
		else
		{
			$application_folder = strtr(
				rtrim($application_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
	{
		$application_folder = BASEPATH.strtr(
			trim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		// echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		echo '您的应用程序文件夹路径似乎没有正确设置。请打开以下文件并将它修改正确: '.SELF;
		exit(3); // EXIT_CONFIG 退出码
	}

	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

	// The path to the "views" directory
	// "views"视图目录
	if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.'views';
	}
	elseif (is_dir($view_folder))
	{
		if (($_temp = realpath($view_folder)) !== FALSE)
		{
			$view_folder = $_temp;
		}
		else
		{
			$view_folder = strtr(
				rtrim($view_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.strtr(
			trim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG 退出码
	}

	define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * 载入引导文件
 * --------------------------------------------------------------------
 *
 * And away we go...
 * 和我们一起走吧...
 */
require_once BASEPATH.'core/CodeIgniter.php';
