<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\RulesetProviders\ConfigRulesetProvider;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class GatekeeperTest extends BaseTest {

  const TEST_FEATURE     = 'test_feature';
  const PER_USER_FEATURE = 'per_user_feature';

  /**
   * @var \Behance\NBD\Gatekeeper\Gatekeeper
   */
  private $_gatekeeper;

  public function setUp() {

    $config = [
        self::TEST_FEATURE => [
            [
                'type'   => BinaryRule::RULE_NAME,
                'params' => [
                    'on' => true
                ]
            ]
        ],
        self::PER_USER_FEATURE => [
            [
                'type'   => IdentifierRule::RULE_NAME,
                'params' => [
                    'valid_identifiers' => [ 123, 456 ]
                ]
            ]
        ]
    ];

    $this->_gatekeeper = new Gatekeeper( new ConfigRulesetProvider( $config ) );

  } // setUp

  /**
   * @test
   */
  public function canAccessSingleIdentifier() {

    $this->assertTrue( $this->_gatekeeper->canAccess( self::TEST_FEATURE ) );
    $this->assertTrue( $this->_gatekeeper->canAccess( self::PER_USER_FEATURE, 456 ) );
    $this->assertFalse( $this->_gatekeeper->canAccess( self::PER_USER_FEATURE ) );
    $this->assertFalse( $this->_gatekeeper->canAccess( self::PER_USER_FEATURE, 789 ) );

  } // canAccessSingleIdentifier

  /**
   * @test
   */
  public function canAccessMultipleIdentifiers() {

    $this->assertTrue( $this->_gatekeeper->canAccess( self::TEST_FEATURE, [ 123, 456 ] ) );
    $this->assertTrue( $this->_gatekeeper->canAccess( self::PER_USER_FEATURE, [ 123, 456 ] ) );
    $this->assertFalse( $this->_gatekeeper->canAccess( self::PER_USER_FEATURE, [ 897, 111 ] ) );
    $this->assertTrue( $this->_gatekeeper->canAccess( self::PER_USER_FEATURE, [ 111, 123 ] ) );

  } // canAccessMultipleIdentifiers

  /**
   * @test
   */
  public function getActiveFeatures() {

    $this->assertEquals( [ self::TEST_FEATURE ],                         $this->_gatekeeper->getActiveFeatures() );
    $this->assertEquals( [ self::TEST_FEATURE ],                         $this->_gatekeeper->getActiveFeatures( 4567 ) );
    $this->assertEquals( [ self::TEST_FEATURE, self::PER_USER_FEATURE ], $this->_gatekeeper->getActiveFeatures( 123 ) );
    $this->assertEquals( [ self::TEST_FEATURE, self::PER_USER_FEATURE ], $this->_gatekeeper->getActiveFeatures( [ 123 ] ) );
    $this->assertEquals( [ self::TEST_FEATURE, self::PER_USER_FEATURE ], $this->_gatekeeper->getActiveFeatures( [ 111, 456 ] ) );

  } // getActiveFeatures

} // GatekeeperTest
