<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Test\BaseTest;

class BinaryRuleTest extends BaseTest {

  /**
   * @test
   */
  public function canAccessYes() {

    $rule = new BinaryRule( true );
    $this->assertTrue( $rule->canAccess() );

  } // canAccessYes

  /**
   * @test
   */
  public function canAccessNo() {

    $rule = new BinaryRule( false );
    $this->assertFalse( $rule->canAccess() );

  } // canAccessNo

}
