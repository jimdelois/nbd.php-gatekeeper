<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Test\BaseTest;

class IpRuleTest extends BaseTest {

  const TEST_IDENTIFIERS = [
      '173.194.66.101',
      '54.239.25.200',
      '192.150.16.117'
  ];

  /**
   * @test
   */
  public function canAccess() {

    $rule = new IpRule( self::TEST_IDENTIFIERS );

    foreach ( self::TEST_IDENTIFIERS as $identifier ) {
      $this->assertTrue( $rule->canAccess( [ RuleAbstract::IDENTIFIER_IP => $identifier ] ) );
    }

  } // canAccess

  /**
   * @test
   */
  public function noAccess() {

    $rule = new IpRule();

    foreach ( self::TEST_IDENTIFIERS as $identifier ) {
      $this->assertFalse( $rule->canAccess( [ RuleAbstract::IDENTIFIER_IP => $identifier ] ) );
    }

  } // noAccess

} // IpRuleTest
