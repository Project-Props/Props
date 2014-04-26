<?php

require_once("lib/router.php");
require_once("lib/route.php");

class RouterTests extends PHPUnit_Framework_TestCase {
  public function tearDown() {
    Mockery::close();
  }

  public function test_can_redirect_to_a_url() {
    $redirecter = Mockery::mock('Redirecter');
    $redirecter->shouldReceive('redirect_to')->once();

    $router = Router::instance();
    $router->redirect_to("/props", $redirecter);
  }

  public function test_throws_exception_when_route_not_defined() {
    $this->setExpectedException("NoRouteMatches", "No route matches '/props'");

    $request = fake_request_with_uri("/props");

    $router = Router::instance();
    $router->process_request($request);
  }

  public function test_processes_request() {
    $request = fake_request_with_uri("/props");

    $after = "after";
    global $thing_changed_by_callback;
    $thing_changed_by_callback = "";

    $request = fake_request_with_uri("/props");

    $router = Router::instance();
    $router->define_route("/props", function() use ($after) {
      global $thing_changed_by_callback;
      $thing_changed_by_callback = $after;
    });

    $router->define_route("/fail", function() {
      throw new Exception();
    });

    $router->process_request($request);

    $this->assertEquals($thing_changed_by_callback, $after);
  }

  public function test_overrides_routes() {
    $request = fake_request_with_uri("/props");

    $after = "after";
    global $thing_changed_by_callback;
    $thing_changed_by_callback = "";

    $request = fake_request_with_uri("/props");

    $router = Router::instance();

    $router->define_route("/props", function() {
      throw new Exception();
    });

    $router->define_route("/props", function() use ($after) {
      global $thing_changed_by_callback;
      $thing_changed_by_callback = $after;
    });

    $router->process_request($request);

    $this->assertEquals($thing_changed_by_callback, $after);
  }
}

function fake_request_with_uri($uri) {
  $request = Mockery::mock("request");
  $request->shouldReceive("uri")->andReturn($uri);
  return $request;
}
