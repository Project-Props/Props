<?php

class View {
  private $file_path;
  private $env;

  public function __construct($file_path, $env = []) {
    $this->env = $env;
    $this->file_path = $file_path;
  }

  public function render() {
    include("views/layout.php");
  }

  private function include_template() {
    foreach ($this->env as $key => $value) {
      ${$key} = $value;
    }

    include($this->file_path);
  }
}

?>
