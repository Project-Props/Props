<?php

/**
 * Require all files in folder.
 *
 * @param string $dir the folder to look into for files.
 */
function require_all_in($dir) {
  $files = glob($dir . '/*.php');

  foreach ($files as $file) {
    require_once $file;
  }
}
