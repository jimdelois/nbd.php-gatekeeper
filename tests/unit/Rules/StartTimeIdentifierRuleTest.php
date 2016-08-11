<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException;
use Behance\NBD\Gatekeeper\Test\BaseTest;

class StartTimeIdentifierRuleTest extends BaseTest {

  /**
   * @test
   *
   * @param \DateTimeImmutable $start_time
   * @param array              $identifiers
   * @param bool               $expected
   *
   * @dataProvider timeIdentifierProvider
   */
  public function canAccessWithValidTimeIdentifier( \DateTimeImmutable $start_time, array $identifiers, $expected ) {

    $rule = new StartTimeIdentifierRule( $start_time );

    $this->assertEquals( $expected, $rule->canAccess( $identifiers ) );

  } // canAccessWithValidTimeIdentifier

  /**
   * @return array
   */
  public function timeIdentifierProvider() {

    return [
        [
            new \DateTimeImmutable( 'May 15, 2016 20:15:15' ),
            [ RuleAbstract::IDENTIFIER_TIME => new \DateTimeImmutable( 'May 21, 2016 14:15:15' ) ],
            true
        ],
        [
            new \DateTimeImmutable( 'May 15, 2016 20:15:15' ),
            [ RuleAbstract::IDENTIFIER_TIME => new \DateTimeImmutable( 'May 15, 2016 20:15:15' ) ],
            true
        ],
        [
            new \DateTimeImmutable( 'May 15, 2016 20:15:15' ),
            [ RuleAbstract::IDENTIFIER_TIME => new \DateTimeImmutable( 'May 25, 2016 20:15:15' ) ],
            true
        ],
        [
            new \DateTimeImmutable( 'May 15, 2016 20:15:15' ),
            [],
            false
        ],
        [
            new \DateTimeImmutable( 'May 15, 2016 20:15:15' ),
            [ RuleAbstract::IDENTIFIER_TIME => new \DateTimeImmutable( 'May 15, 2016 20:15:14' ) ],
            false
        ],
        [
            new \DateTimeImmutable( 'May 15, 2016 20:15:15' ),
            [ RuleAbstract::IDENTIFIER_TIME => new \DateTimeImmutable( 'May 14, 2016 2:15:14' ) ],
            false
        ],
    ];

  } // timeIdentifierProvider

  /**
   * @test
   */
  public function canAccessWithInvalidIdentifier() {

    $rule = new StartTimeIdentifierRule( new \DateTimeImmutable( 'May 15, 2016 20:15:15' ) );

    $this->expectException( InvalidIdentifierException::class );

    $rule->canAccess( [ RuleAbstract::IDENTIFIER_TIME => 12345 ] );

  } // canAccessWithInvalidIdentifier

} // StartTimeIdentifierRuleTest
