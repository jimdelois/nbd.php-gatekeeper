<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Exceptions\DateTimeImmutableException;
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
  public function createBetweenTimeRuleObjectSuccess() {

    $rule = RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => new \DateTimeImmutable(),
        'to'   => new \DateTimeImmutable(),
    ] );

    $this->assertInstanceOf( BetweenTimesRule::class, $rule );

  } // createBetweenTimeRuleObjectSuccess


  /**
   * @test
   */
  public function createBetweenTimeRuleEpochStringSuccess() {

    $rule = RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => '1465238714',
        'to'   => '1465238715',
    ] );

    $this->assertInstanceOf( BetweenTimesRule::class, $rule );

  } // createBetweenTimeRuleEpochStringSuccess

  /**
   * @test
   */
  public function createBetweenTimeRuleEpochIntSuccess() {

    $rule = RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => 1465238714,
        'to'   => 1465238714,
    ] );

    $this->assertInstanceOf( BetweenTimesRule::class, $rule );

  } // createBetweenTimeRuleEpochIntSuccess

  /**
   * @test
   */
  public function createBetweenTimeRuleStringSuccess() {

    $rule = RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => 'Mon, 06 Jun 2016 18:45:13 GMT',
        'to'   => 'Mon, 06 Jun 2016 18:45:13 GMT',
    ] );

    $this->assertInstanceOf( BetweenTimesRule::class, $rule );

  } // createBetweenTimeRuleStringSuccess

  /**
   * @test
   */
  public function createBetweenTimeRuleStringFormatFail() {

    $this->expectException( DateTimeImmutableException::class );

    RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => 'gibberish',
        'to'   => 'gibberish',
    ] );

  } // createBetweenTimeRuleStringFormatFail

  /**
   * @test
   */
  public function createBetweenTimeRuleParamFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( BetweenTimesRule::RULE_NAME, [
        'from' => new \DateTimeImmutable()
    ] );

  } // createBetweenTimeRuleParamFail

  /**
   * @test
   */
  public function createStartTimeRuleObjectSuccess() {

    $rule = RuleFactory::create( StartTimeRule::RULE_NAME, [
        'start' => new \DateTimeImmutable()
    ] );

    $this->assertInstanceOf( StartTimeRule::class, $rule );

  } // createStartTimeRuleObjectSuccess

  /**
   * @test
   */
  public function createStartTimeRuleEpochStringSuccess() {

    $rule = RuleFactory::create( StartTimeRule::RULE_NAME, [
        'start' => '1465238714'
    ] );

    $this->assertInstanceOf( StartTimeRule::class, $rule );

  } // createStartTimeRuleEpochStringSuccess

  /**
   * @test
   */
  public function createStartTimeRuleEpochIntSuccess() {

    $rule = RuleFactory::create( StartTimeRule::RULE_NAME, [
        'start' => 1465238714
    ] );

    $this->assertInstanceOf( StartTimeRule::class, $rule );

  } // createStartTimeRuleEpochIntSuccess

  /**
   * @test
   */
  public function createStartTimeRuleStringSuccess() {

    $rule = RuleFactory::create( StartTimeRule::RULE_NAME, [
        'start' => 'Mon, 06 Jun 2016 18:45:13 GMT'
    ] );

    $this->assertInstanceOf( StartTimeRule::class, $rule );

  } // createStartTimeRuleStringSuccess

  /**
   * @test
   */
  public function createStartTimeRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( StartTimeRule::RULE_NAME );

  } // createStartTimeRuleFail

  public function createStartTimeRuleStringFormatFail() {

    $this->expectException( DateTimeImmutableException::class );

    RuleFactory::create( StartTimeRule::RULE_NAME, [
        'start' => 'gibberish'
    ] );

  } // createStartTimeRuleStringFormatFail

  /**
   * @test
   */
  public function createEndTimeRuleObjectSuccess() {

    $rule = RuleFactory::create( EndTimeRule::RULE_NAME, [
        'end' => new \DateTimeImmutable()
    ] );

    $this->assertInstanceOf( EndTimeRule::class, $rule );

  } // createEndTimeRuleObjectSuccess

  public function createEndTimeRuleEpochStringSuccess() {

    $rule = RuleFactory::create( EndTimeRule::RULE_NAME, [
        'end' => '1465238714'
    ] );

    $this->assertInstanceOf( EndTimeRule::class, $rule );

  } // createEndTimeRuleEpochStringSuccess


  public function createEndTimeRuleEpochIntSuccess() {

    $rule = RuleFactory::create( EndTimeRule::RULE_NAME, [
        'end' => 1465238714
    ] );

    $this->assertInstanceOf( EndTimeRule::class, $rule );

  } // createEndTimeRuleEpochIntSuccess

  public function createEndTimeRuleStringSuccess() {

    $rule = RuleFactory::create( EndTimeRule::RULE_NAME, [
        'end' => 'Mon, 06 Jun 2016 18:45:13 GMT'
    ] );

    $this->assertInstanceOf( EndTimeRule::class, $rule );

  } // createEndTimeRuleStringSuccess

  /**
   * @test
   */
  public function createEndTimeRuleFail() {

    $this->expectException( MissingRuleParameterException::class );

    RuleFactory::create( EndTimeRule::RULE_NAME );

  } // createEndTimeRuleFail

  public function createEndTimeRuleStringFormatFail() {

    $this->expectException( DateTimeImmutableException::class );

    RuleFactory::create( EndTimeRule::RULE_NAME, [
        'end' => 'gibberish'
    ] );

  } // createEndTimeRuleStringFormatFail

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
