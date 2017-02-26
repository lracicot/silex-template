#!/usr/bin/env php

<?php

$projectName = basename(getcwd());

exec('vendor/bin/phpunit', $output, $returnCode);

if ($returnCode !== 0) {
    $minimalTestSummary = array_pop($output);
    printf("Test suite for %s failed: ", $projectName);
    printf("( %s ) %s%2\$s", $minimalTestSummary, PHP_EOL);
    printf("ABORTING COMMIT!\n");
    exit(1);
}

exit(0);
