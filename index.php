<?php

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('City.php');
require_once('TourManager.php');
require_once('Tour.php');
require_once('Population.php');
require_once('GA.php');
require_once('TSP_GA.php');
require_once('Helper.php');

TSP_GA::solve(200);