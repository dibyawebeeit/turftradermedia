#!/usr/local/bin/php83.cli
<?php
chdir(__DIR__);
passthru('/usr/local/bin/php83.cli artisan schedule:run');