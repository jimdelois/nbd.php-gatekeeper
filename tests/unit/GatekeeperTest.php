<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\RulesetProviders\ConfigProvider;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class GatekeeperTest extends BaseTest {

  const CONFIG = [
      'test_feature' => [
          [
              'type'   => BinaryRule::RULE_NAME,
              'params' => [
                  'on' => true
              ]
          ]
      ],
      'per_user_feature' => [
          [
              'type'   => IdentifierRule::RULE_NAME,
              'params' => [
                  'valid_identifiers' => [ 123, 456 ]
              ]
          ]
      ]
  ];

  /**
   * @var \Behance\NBD\Gatekeeper\Gatekeeper
   */
  private $_gatekeeper;

  public function setUp() {
    $this->_gatekeeper = new Gatekeeper( new ConfigProvider(self::CONFIG) );
  }

  /**
   * @test
   */
  public function canAccessSingleIdentifier() {

    $this->assertTrue( $this->_gatekeeper->canAccess( 'test_feature' ) );
    $this->assertTrue( $this->_gatekeeper->canAccess( 'per_user_feature', 456 ) );
    $this->assertFalse( $this->_gatekeeper->canAccess( 'per_user_feature' ) );
    $this->assertFalse( $this->_gatekeeper->canAccess( 'per_user_feature', 789 ) );

  } // canAccessSingleIdentifier

  /**
   * @test
   */
  public function canAccessMultipleIdentifiers() {

    $this->assertTrue( $this->_gatekeeper->canAccess( 'test_feature', [ 123, 456 ] ) );
    $this->assertTrue( $this->_gatekeeper->canAccess( 'per_user_feature', [ 123, 456 ] ) );
    $this->assertFalse( $this->_gatekeeper->canAccess( 'per_user_feature', [ 897, 111 ] ) );
    $this->assertTrue( $this->_gatekeeper->canAccess( 'per_user_feature', [ 111, 123 ] ) );

  } // canAccessMultipleIdentifiers

}
