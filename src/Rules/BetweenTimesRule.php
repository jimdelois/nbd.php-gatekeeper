<?php

namespace Behance\NBD\Gatekeeper\Rules;

class BetweenTimesRule extends TimeRuleAbstract {

  const RULE_NAME = 'between_time';

  /**
   * @var \DateTimeImmutable
   */
  private $_from_time;

  /**
   * @var \DateTimeImmutable
   */
  private $_to_time;

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
  public function canAccess( $identifier = null ) {

    $current_time = $this->_getCurrentTime();

    return ( $current_time >= $this->_from_time && $current_time <= $this->_to_time );

  } // canAccess

} // BetweenTimesRule
