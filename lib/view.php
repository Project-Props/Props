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

  /**
   * The folder containing the view templates.
   */
  const VIEW_DIR = "views";

  /**
   * Construct a new view.
   *
   * This accepts a path to the template file and an environment of variables that the template
   * should have access to
   *
   * Here is an example:
   *
   * Assume we have file in "views/users/show.php".
   *
   * First we build a view and tell it to render.
   *
   * <pre>
   * $view = new View("props/new.php", ["name" => "Bob"]);
   * $view->render();
   * </pre>
   *
   * Within the template we would now have access to the variable "name" and it would equal "Bob".
   *
   * @param string $file_path the path of the template.
   * @param array $env the environment of variables that the template should know about.
   */
  public function __construct($file_path, $env = []) {
    $this->env = $env;
    $this->file_path = static::VIEW_DIR . "/" . $file_path;
  }

  /**
   * Render the view.
   *
   * This method accepts and optional array of options. It can be used to not render the layout
   * when rendering the view.
   *
   * Example:
   *
   * <pre>
   * $view->render(["layout" => false]);
   * </pre>
   *
   * @param array $options.
   */
  public function render($options = ["layout" => true]) {
    if ($options["layout"]) {
      Flash::prepare();

      include(static::VIEW_DIR . "/layout.php");
    } else {
      $this->include_template();
    }
  }

  /**
   * Set the title of the view.
   *
   * @param string $title.
   */
  public function set_title($title) {
    $this->title = $title;
  }

  /**
   * Render a partial view.
   *
   * This method is used for rendering views from within other views.
   * This is useful to break complex views apart into multiple files
   * or for not duplicating view code thats used in multiple places.
   *
   * This works very much the same way as making a new view and then
   * rendering it right away. However the layout will not be rendered when using
   * this method.
   *
   * @param string $file_path the path of the template.
   * @param array $env the environment of variables that the template should know about.
   */
  public function render_partial($file_path, $env = []) {
    $new_view = new static($file_path, $env);
    $new_view->render(["layout" => false]);
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
