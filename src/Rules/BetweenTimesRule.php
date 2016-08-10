<?php

namespace Behance\NBD\Gatekeeper\Rules;

class BetweenTimesRule extends TimeRuleAbstract {

  const RULE_NAME = 'between_time';

  /**
   * @var \DateTimeImmutable
   */
  protected $_from_time;

  /**
   * @var \DateTimeImmutable
   */
  protected $_to_time;

  /**
   * @param \DateTimeImmutable $from
   * @param \DateTimeImmutable $to
   */
  public function __construct( \DateTimeImmutable $from, \DateTimeImmutable $to ) {

    $this->_from_time = $from;
    $this->_to_time   = $to;

  } // __construct

  /**
   * {@inheritdoc}
   */
  public function canAccess( array $identifiers = [] ) {

    return $this->_isInTimeRange( $this->_getCurrentTime() );

  } // canAccess

  /**
   * {@inheritdoc}
   */
  protected function _isInTimeRange( \DateTimeImmutable $time ) {

    return ( $time >= $this->_from_time && $time <= $this->_to_time );

  } // _isInTimeRange

} // BetweenTimesRule
