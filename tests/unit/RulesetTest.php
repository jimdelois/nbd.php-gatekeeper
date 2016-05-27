<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\Rules\StartTimeRule;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class RulesetTest extends BaseTest {

  /**
   * @test
   */
  public function addRule() {

    $binary_rule = new BinaryRule( true );

    $ruleset     = new Ruleset();

    $this->assertEmpty( $ruleset->getRules() );

    $ruleset->addRule( $binary_rule );

    $this->assertEquals( 1, count( $ruleset->getRules() ) );

  } // addRule

  /**
   * @test
   */
  public function getRules() {

    $rule_1  = new BinaryRule( true );
    $rule_2  = new StartTimeRule( new \DateTimeImmutable() );
    $rule_3  = new IdentifierRule( [ 123 ] );

    $ruleset = new Ruleset();
    $ruleset->addRule( $rule_1 );

    $this->assertSame( $rule_1, $ruleset->getRules()[0] );

    $ruleset->addRule( $rule_3 );
    $ruleset->addRule( $rule_2 );

    $rules = $ruleset->getRules();

    // confirms check order is as expected (first added, first checked)
    $this->assertSame( $rule_1, $rules[0] );
    $this->assertSame( $rule_3, $rules[1] );
    $this->assertSame( $rule_2, $rules[2] );

  } // getRules

  /**
   * @test
   */
  public function canAccess() {

    $rule_1  = new BinaryRule( false );
    $rule_2  = new IdentifierRule( [ 123 ] );

    $ruleset = new Ruleset();
    $ruleset->addRule( $rule_1 );
    $ruleset->addRule( $rule_2 );

    $this->assertFalse( $ruleset->canAccess() );
    $this->assertTrue( $ruleset->canAccess( 123 ) );

    // to test that order doesn't matter
    $ruleset = new Ruleset();
    $ruleset->addRule( $rule_2 );
    $ruleset->addRule( $rule_1 );

    $this->assertFalse( $ruleset->canAccess() );
    $this->assertTrue( $ruleset->canAccess( 123 ) );

  } // canAccess

} // RulesetTest
