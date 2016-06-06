<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Exceptions\MissingRuleParameterException;
use Behance\NBD\Gatekeeper\Exceptions\UnknownRuleTypeException;
use Behance\NBD\Gatekeeper\IdentifierHashBucket;
use Behance\NBD\Gatekeeper\Rules\BetweenTimesRule;
use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\EndTimeRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\Rules\PercentageRule;
use Behance\NBD\Gatekeeper\Rules\StartTimeRule;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class RuleFactoryTest extends BaseTest {

  /**
   * @test
   */
  public function invalidRuleType() {

    $this->expectException( UnknownRuleTypeException::class );

    RuleFactory::create( 'imnotarule', [
        'on' => true
    ] );

  } // invalidRuleType

  /**
   * @test
   */
  public function createBinaryRuleSuccess() {

    $rule = RuleFactory::create( BinaryRule::RULE_NAME, [
        'on' => true
    ] );

    $this->assertInstanceOf( BinaryRule::class, $rule );

  } // createBinaryRuleSuccess

  /**
   * @test
   */
  public function createBinaryRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( BinaryRule::RULE_NAME, [
        'blah' => 2
    ] );

  } // createBinaryRuleFail

  /**
   * @test
   */
  public function createIdentifierRuleSuccess() {

    $rule = RuleFactory::create( IdentifierRule::RULE_NAME, [
        'valid_identifiers' => [ 40, 50 ]
    ] );

    $this->assertInstanceOf( IdentifierRule::class, $rule );

  } // createIdentifierRuleSuccess

  /**
   * @test
   */
  public function createIdentifierRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( IdentifierRule::RULE_NAME, [] );

  } // createIdentifierRuleFail

  /**
   * @test
   */
  public function createBetweenTimeRuleSuccess() {

    $rule = RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => new \DateTimeImmutable(),
        'to'   => new \DateTimeImmutable(),
    ] );

    $this->assertInstanceOf( BetweenTimesRule::class, $rule );

  } // createBetweenTimeRuleSuccess

  /**
   * @test
   */
  public function createBetweenTimeRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => new \DateTimeImmutable()
    ] );

  } // createBetweenTimeRuleFail

  /**
   * @test
   */
  public function createStartTimeRuleSuccess() {

    $rule = RuleFactory::create( StartTimeRule::RULE_NAME, [
        'start' => new \DateTimeImmutable()
    ] );

    $this->assertInstanceOf( StartTimeRule::class, $rule );

  } // createStartTimeRuleSuccess

  /**
   * @test
   */
  public function createStartTimeRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( StartTimeRule::RULE_NAME );

  } // createStartTimeRuleFail

  /**
   * @test
   */
  public function createEndTimeRuleSuccess() {

    $rule = RuleFactory::create( EndTimeRule::RULE_NAME, [
        'end' => new \DateTimeImmutable()
    ] );

    $this->assertInstanceOf( EndTimeRule::class, $rule );

  } // createEndTimeRuleSuccess

  /**
   * @test
   */
  public function createEndTimeRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( EndTimeRule::RULE_NAME );

  } // createEndTimeRuleFail

  /**
   * @test
   */
  public function createPercentageRuleSuccess() {

    $rule = RuleFactory::create(
        PercentageRule::RULE_NAME,
        [
            'percentage' => 10,
        ],
        'feature'
    );

    $this->assertInstanceOf( PercentageRule::class, $rule );

  } // createPercentageRuleSuccess

  /**
   * @test
   */
  public function createPercentageRuleFeatureMissingFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create(
        PercentageRule::RULE_NAME,
        [ 'percentage' => 10 ]
    );

  } // createPercentageRuleFeatureMissingFail

  /**
   * @test
   */
  public function createPercentageRulePercentageMissingFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create(
        PercentageRule::RULE_NAME,
        [ 'feature' => 'feature' ]
    );

  } // createPercentageRulePercentageMissingFail

  /**
   * @test
   */
  public function createPercentageRuleParamMissingFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create(
        PercentageRule::RULE_NAME
    );

  } // createPercentageRuleParamMissingFail

} // RuleFactoryTest
