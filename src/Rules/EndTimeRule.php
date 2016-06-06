<?php

namespace Behance\NBD\Gatekeeper\Rules;

class EndTimeRule extends TimeRuleAbstract {

  const RULE_NAME = 'end_time';

  /**
   * @var \DateTimeImmutable
   */
  private $_end_time;

  /**
   * @param \DateTimeImmutable $end_time
   */
  public function __construct( \DateTimeImmutable $end_time ) {

    $this->_end_time = $end_time;

  } // __construct

  /**
   * {@inheritdoc}
   */
  public function canAccess( $check_time = null ) {

    if ( $check_time === null ) {
      $check_time = $this->_getCurrentTime();
    }

    return $check_time <= $this->_end_time;

  } // canAccess

} // EndTimeRule
