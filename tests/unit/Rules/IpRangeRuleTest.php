<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Test\BaseTest;

class IpRangeRuleTest extends BaseTest {

  /**
   * @test
   *
   * @dataProvider canAccessProvider
   *
   * @param bool   $can_access
   * @param string $ip_start
   * @param string $ip_end
   */
  public function canAccess( $can_access, $ip_start, $ip_end, $ip ) {

    $rule = new IpRangeRule( $ip_start, $ip_end );

    $this->assertEquals( $can_access, $rule->canAccess( [ RuleAbstract::IDENTIFIER_IP => $ip ] ) );

  } // canAccess

  /**
   * @return array
   */
  public function canAccessProvider() {

    return [
        [ true,  '173.194.66.101', '173.194.66.201', '173.194.66.200' ],
        [ true,  '173.194.66.101', '173.194.66.201', '173.194.66.201' ],
        [ true,  '54.239.25.200',  '54.239.26.200',  '54.239.25.250' ],
        [ false, '173.194.66.101', '173.194.66.201', '173.194.66.202' ],
        [ false, '173.194.66.101', '173.194.66.201', '173.194.66.201000' ],
        [ false, '173.194.66.101', '173.194.66.201', '173.194.66.201000' ],
    ];

  } // canAccessProvider

  /**
   * @test
   */
  public function canAccessNoIpIdentifier() {

    $rule = new IpRangeRule( '173.194.66.101', '173.194.66.201' );

    $this->assertFalse( $rule->canAccess() );
    $this->assertFalse( $rule->canAccess( [] ) );
    $this->assertFalse( $rule->canAccess( [ RuleAbstract::IDENTIFIER_AUTHENTICATED => 1 ] ) );

  } // canAccessNoIpIdentifier

  /**
   * @test
   *
   * @dataProvider badStartEndParamsProvider
   *
   * @param string $ip_start
   * @param string $ip_end
   */
  public function badStartEndParams( $ip_start, $ip_end ) {

    $this->expectException( \InvalidArgumentException::class );

    new IpRangeRule( $ip_start, $ip_end );

  } // badStartEndParams

  /**
   * @return array
   */
  public function badStartEndParamsProvider() {

    return [
        [ '173.194.66.101000', '173.194.66.201' ],
        [ '173.194.66.101',    '' ],
        [ null,                '' ],
    ];

  } // badStartEndParamsProvider

} // IpRangeRuleTest
