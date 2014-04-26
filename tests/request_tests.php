<?php

require_once("lib/request.php");

class RequestTests extends PHPUnit_Framework_TestCase {
  public function test_that_it_is_a_singleton() {
    $one = Request::instance();
    $two = Request::instance();

    $this->assertEquals(spl_object_hash($one), spl_object_hash($two));
  }

  public function test_that_it_knows_the_requested_uri() {
    $url = "http://some-url.com";
    $_SERVER["REQUEST_URI"] = $url;

    $this->assertEquals($url, Request::instance()->uri());
  }

  public function test_it_ignore_get_params_in_the_url() {
    $request = Request::instance();
    $url = "http://some-url.com";
    $params = "?id=10";
    $_SERVER["REQUEST_URI"] = $url . $params;

    $this->assertEquals($url, $request->uri());
  }

  public function test_it_knows_the_params_in_both_get_and_post() {
    $id = 10;
    $name = "name";
    $request = Request::instance();
    $_GET = ["id" => $id];
    $_POST = ["name" => $name];

    $this->assertEquals($id, $request->param("id"));
    $this->assertEquals($name, $request->param("name"));
  }

  public function test_it_knows_if_it_has_a_certain_param() {
    $request = Request::instance();
    $name = "name";
    $_GET = ["name" => $name];

    $this->assertEquals(true, $request->has_param("name"));
  }

  public function test_it_knows_if_it_doesnt_have_a_certain_param() {
    $request = Request::instance();

    $this->assertEquals(false, $request->has_param("missing_param"));
  }
}
