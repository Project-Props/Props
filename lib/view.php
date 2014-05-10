<?php

/**
 * A view class that knows how to render HTML files (possibly containing embedded PHP).
 *
 * This class would normally be used within controllers.
 *
 * Here is an example of how to build a view and then render it:
 *
 * <pre>
 * // first write a template (html file with php) and save it somewhere
 *
 * // make new view instance
 * $view = new View("props/new.php");
 *
 * // tell that view to render itself
 * $view->render();
 * </pre>
 */
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

  public function set_title($title) {
    $this->title = $title;
  }

  public function render_partial($file_path, $env = []) {
    $new_view = new static($file_path, $env);
    $new_view->render();
  }

  private function include_template() {
    foreach ($this->env as $key => $value) {
      ${$key} = $value;
    }

    include($this->file_path);
  }

  private function title() {
    $default_title = "Props 2.0";

    if ($this->title) {
      return $this->title . " | " . $default_title;
    } else {
      return $default_title;
    }
  }
}

?>
