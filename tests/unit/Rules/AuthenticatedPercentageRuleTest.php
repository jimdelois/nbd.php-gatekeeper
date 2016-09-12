<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class AuthenticatedPercentageRuleTest extends BaseTest {

  /**
   * @var \Behance\NBD\Gatekeeper\Rules\RuleInterface
   */
  private $_rule;

  /**
   * @test
   */
  public function canAccessTrue() {

    $this->_getRule( 60, 'feature' );

    $this->assertTrue( $this->_rule->canAccess( [ 'authenticated' => '1' ] ) );
    $this->assertTrue( $this->_rule->canAccess( [ 'authenticated' => '1', 'anonymous' => '0' ] ) );

  } // canAccessTrue

  /**
* @test
*/
  public function canAccessFalse() {

    $this->_getRule( 60, 'feature' );

    $this->assertFalse( $this->_rule->canAccess( [ 'authenticated' => '4' ] ) );
    $this->assertFalse( $this->_rule->canAccess( [ 'authenticated' => '4', 'anonymous' => '1' ] ) );

  } // canAccessFalse

  /**
   * @test
   */
  public function canAccessFalseNoIdentifier() {

    $this->_getRule( 100, 'feature' );

    $this->assertFalse( $this->_rule->canAccess( [] ) );

  } // canAccessFalseNoIdentifier

  /**
   * @test
   */
  public function canAccessBadIdentifier() {

    $this->_getRule( 60, 'feature' );

    $this->assertFalse( $this->_rule->canAccess( [ 'balhblah' => '4' ] ) );

  } // canAccessBadIdentifier

  /**
   * @test
   */
  public function invalidPercentage() {

    $this->expectException( \InvalidArgumentException::class );

    new AuthenticatedPercentageRule( 'invalid', 'feature' );

  } // invalidPercentage

  /**
   * @test
   */
  public function invalidPercentageRange() {

    $this->expectException( \InvalidArgumentException::class );

    new AuthenticatedPercentageRule( 101, 'feature' );

  } // invalidPercentageRange

  /**
   * @test
   */
  public function invalidPercentageNull() {

    $this->expectException( \InvalidArgumentException::class );

    new AuthenticatedPercentageRule( null, 'feature' );

  } // invalidPercentageNull

  /**
   * @param int    $percentage
   * @param string $feature
   */
  private function _getRule( $percentage, $feature ) {

    $this->_rule = new AuthenticatedPercentageRule( $percentage, $feature );

  } // _getRule

} // AuthenticatedPercentageRuleTest
