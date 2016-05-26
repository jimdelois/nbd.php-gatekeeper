<?php

namespace Behance\NBD\Gatekeeper\Test;

abstract class BaseTest extends \PHPUnit_Framework_TestCase {

  /**
   * Creats a mock of the given Class
   *
   * @param  string $class_name
   * @param  string[] $methods
   *
   * @return \PHPUnit_Framework_MockObject_MockObject
   */
  protected function _getDisabledMock( $class_name, array $methods = [] ) {

    return $this->getMockBuilder( $class_name )
        ->disableOriginalConstructor()
        ->setMethods( $methods )
        ->getMock();

  } // _getDisabledMock

} // BaseTest
