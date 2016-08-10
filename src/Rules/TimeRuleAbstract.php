<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException;

abstract class TimeRuleAbstract extends RuleAbstract {

  const IDENTIFIER_TYPE = RuleAbstract::IDENTIFIER_TIME;

  /**
   * @return \DateTimeImmutable
   */
  protected function _getCurrentTime() {

    return new \DateTimeImmutable();

  } // _getCurrentTime

  /**
   * @param array $identifiers
   *
   * @return \DateTimeImmutable|false
   *
   * @throws \Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException
   */
  protected function _getTimeFromIdentifiers( array $identifiers = [] ) {

    if ( !isset( $identifiers[ self::IDENTIFIER_TYPE ] ) ) {
      return false;
    }

    $identifier = $identifiers[ self::IDENTIFIER_TYPE ];

    if ( !( $identifier instanceof \DateTimeImmutable ) ) {
      throw new InvalidIdentifierException( '"time" identifier must be a DateTimeImmutable object.' );
    }

    return $identifier;

  } // _getTimeFromIdentifiers

  /**
   * @param \DateTimeImmutable $time
   *
   * @return bool
   */
  abstract protected function _isInTimeRange( \DateTimeImmutable $time );

} // TimeRuleAbstract
