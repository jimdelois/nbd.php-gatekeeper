<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Test\BaseTest;

class RandomPercentageRuleTest extends BaseTest {

  /**
   * @var \Behance\NBD\Gatekeeper\Rules\RuleInterface
   */
  private $_rule;

  /**
   * @test
   */
  public function canAccessTrue() {

    $this->_getRule( 60, 'feature' );

    // 2 calls to confirm a new random identifier is used each time
    $this->_rule->expects( $this->exactly( 2 ) )
      ->method( '_getRandomIdentifier' )
      ->willReturnOnConsecutiveCalls( 50, 1 );

    $this->assertTrue( $this->_rule->canAccess() );
    $this->assertTrue( $this->_rule->canAccess() );

  } // canAccessTrue

  /**
* @test
*/
  public function canAccessFalse() {

    $this->_getRule( 60, 'feature' );

    $this->_rule->expects( $this->once() )
      ->method( '_getRandomIdentifier' )
      ->willReturn( 4 );

    $this->assertFalse( $this->_rule->canAccess() );

  } // canAccessFalse

  /**
   * @test
   */
  public function invalidPercentage() {

    $this->expectException( \InvalidArgumentException::class );

    new RandomPercentageRule( 'invalid', 'feature' );

  } // invalidPercentage

  /**
   * @test
   */
  public function invalidPercentageRange() {

    $this->expectException( \InvalidArgumentException::class );

    new RandomPercentageRule( 101, 'feature' );

  } // invalidPercentageRange

  /**
   * @test
   */
  public function invalidPercentageNull() {

    $this->expectException( \InvalidArgumentException::class );

    new RandomPercentageRule( null, 'feature' );

  } // invalidPercentageNull

  /**
   * @param int    $percentage
   * @param string $feature
   */
  private function _getRule( $percentage, $feature ) {

    $this->_rule = new RandomPercentageRule( $percentage, $feature );

    $this->_rule = $this->getMock( RandomPercentageRule::class, [ '_getRandomIdentifier' ], [ $percentage, $feature ] );

  } // _getRule

} // RandomPercentageRuleTest
