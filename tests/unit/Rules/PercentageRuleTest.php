<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Rules\PercentageRule;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class PercentageRuleTest extends BaseTest {

  private $_rule;

  private function _getRule( $percentage, $feature ) {

    $this->_rule = new PercentageRule( $percentage, $feature );

  } // _getRule

  /**
   * @test
   */
  public function canAccessTrue() {

    $this->_getRule( 60, 'feature' );

    $this->assertTrue( $this->_rule->canAccess( '1' ) );

  } // canAccessTrue

  /**
   * @test
   */
  public function canAccessFalse() {

    $this->_getRule( 20, 'feature' );

    $this->assertFalse( $this->_rule->canAccess( '2' ) );

  } // canAccessFalse

  /**
   * @test
   */
  public function canAccessFalseNullIdentifier() {

    $this->_getRule( 100, 'feature' );

    $this->assertFalse( $this->_rule->canAccess( null ) );

  } // canAccessFalseNullIdentifier

  /**
   * @test
   */
  public function invalidPercentage() {

    $this->expectException( \InvalidArgumentException::class );

    new PercentageRule( 'invalid', 'feature' );

  } // invalidPercentage

  /**
   * @test
   */
  public function invalidPercentageRange() {

    $this->expectException( \InvalidArgumentException::class );

    new PercentageRule( 101, 'feature' );

  } // invalidPercentageRange

  /**
   * @test
   */
  public function invalidPercentageNull() {

    $this->expectException( \InvalidArgumentException::class );

    new PercentageRule( null, 'feature' );

  } // invalidPercentageNull

} // PercentageRuleTest
