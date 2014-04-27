<?php

require_once("lib/route.php");

class RouteTests extends PHPUnit_Framework_TestCase {
  public function tearDown() {
    Mockery::close();
  }

  public function test_runs_a_callback() {
    global $thing;
    $thing = "";
    $after_value = "called";

    $route = new Route("/props", function() use ($after_value) {
      global $thing;

      $thing = $after_value;
    });
    $route->run();

    $this->assertEquals($after_value, $thing);
  }

  public function test_matches() {
    $path = "/props";
    $request = Mockery::mock('Request');
    $request->shouldReceive('url')->andReturn($path);

    $route = new Route($path, function() {});

    $this->assertEquals(true, $route->matches($request));
  }

  public function test_not_matches() {
    $request = Mockery::mock('Request');
    $request->shouldReceive('url')->andReturn("/props");

    $route = new Route("/productions", function() {});

    $this->assertEquals(false, $route->matches($request));
  }
}
