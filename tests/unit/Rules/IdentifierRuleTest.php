<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Test\BaseTest;

class IdentifierRuleTest extends BaseTest {

  const TEST_IDENTIFIERS = [
      1234,
      0,
      '1234',
      'David',
      '_',
      1
  ];

  /**
   * @test
   */
  public function canAccess() {

    $rule = new IdentifierRule( self::TEST_IDENTIFIERS );

    foreach ( self::TEST_IDENTIFIERS as $identifier ) {
      $this->assertTrue( $rule->canAccess( $identifier ) );
    }

  } // canAccess

  /**
   * @test
   */
  public function noAccess() {

    $rule = new IdentifierRule();

    foreach ( self::TEST_IDENTIFIERS as $identifier ) {
      $this->assertFalse( $rule->canAccess( $identifier ) );
    }

  } // noAccess

} // IdentifierRuleTest
