<?php

/**
 * This script enforces several style constraints:
 *  - Converts tabs to spaces
 *  - Remove trailing spaces
 *  - Ensure newline at end of file
 */

function style_check($dir) {
    foreach (glob("$dir/*") as $node) {
        if (is_file($node)) style_correct($node);
        elseif (is_dir($node)) style_check("$node");
    }
}

function style_correct($file) {
    $exclude_prefixes = array(
        './tests/HTML5Lib/Tests/testdata/',
    );
    $exclude_extensions = array();
    foreach ($exclude_prefixes as $p) {
        if (strncmp($p, $file, strlen($p)) === 0) return;
    }
    foreach ($exclude_extensions as $e) {
        if (strlen($file) > strlen($e) && substr($file, -strlen($e)) === $e) {
            return;
        }
    }
    $orig = $contents = file_get_contents($file);

    // tab2space
    $contents = str_replace("\t", '    ', $contents);

    // Trailing whitespace
    $contents = preg_replace('/ +$/m', '', $contents);

    // Ensure newline at end of file
    $contents = preg_replace('/\s+$/', "\n", $contents);

    if ($orig !== $contents) {
        echo "$file\n";
        file_put_contents($file, $contents);
    }
}

style_check(dirname(__DIR__));