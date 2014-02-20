<?php

pm_Context::init('syslog-watch');

$application = new pm_Application();
$application->run();
