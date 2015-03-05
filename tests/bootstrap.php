<?php
/**
 * Bootstrapping for PHPUnit-Tests
 *
 * @copyright Copyright (c), final gene (http://www.final-gene.de)
 */

/**
 * Report all errors
 */
error_reporting(-1);

/**
 * Set up default timezone for this application
 */
date_default_timezone_set('Europe/Berlin');

/**
 * Files will be created as -rw-rw-r--
 * Directories will be creates as drwxrwxr-x
 */
umask(0002);

/**
 * Make everything relative to the application root
 */
chdir(dirname(__DIR__));

/**
 * Initialize autoloader
 */
require 'vendor/autoload.php';
