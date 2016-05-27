<?php

namespace Behance\NBD\Gatekeeper\RulesetProviders;

use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\Ruleset;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class ConfigProviderTest extends BaseTest {

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
   * @var \Behance\NBD\Gatekeeper\RulesetProviderInterface
   */
  private $_ruleset_provider;

  public function setUp() {

    $this->_ruleset_provider = new ConfigProvider(self::CONFIG);

  } // setUp

  /**
   * @test
   */
  public function getRulesetExistingFeature() {

    $ruleset_1 = $this->_ruleset_provider->getRuleset( 'test_feature' );

    $this->assertInstanceOf( Ruleset::class, $ruleset_1 );
    $this->assertSame( $ruleset_1, $this->_ruleset_provider->getRuleset( 'test_feature' ) );

    $rules = $ruleset_1->getRules();

    $this->assertInstanceOf( BinaryRule::class, $rules[0] );

    $ruleset_2 = $this->_ruleset_provider->getRuleset( 'per_user_feature' );

    $this->assertInstanceOf( Ruleset::class, $ruleset_2 );
    $this->assertSame( $ruleset_2, $this->_ruleset_provider->getRuleset( 'per_user_feature' ) );

  } // getRulesetExistingFeature

  /**
   * @test
   */
  public function getRulesetNonExistentFeature() {

    $ruleset = $this->_ruleset_provider->getRuleset( 'idontexist' );

    $this->assertInstanceOf( Ruleset::class, $ruleset );
    $this->assertEmpty( $ruleset->getRules() );

  } // getRulesetNonExistentFeature

} // ConfigProviderTest
