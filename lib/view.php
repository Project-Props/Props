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
}

?>
