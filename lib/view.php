<?php

class View {
  private $file_path;
  private $env;
  private $title;

  const VIEW_DIR = "views";

  public function __construct($file_path, $env = []) {
    $this->env = $env;
    $this->file_path = static::VIEW_DIR . "/" . $file_path;
  }

  public function render() {
    include(static::VIEW_DIR . "/layout.php");
  }

  private function include_template() {
    foreach ($this->env as $key => $value) {
      ${$key} = $value;
    }

    include($this->file_path);
  }

  private function title() {
    if ($this->title) {
      return $this->title . " | Props 2.0";
    } else {
      return "Props 2.0";
    }
  }

  public function set_title($title) {
    $this->title = $title;
  } 
}

?>
