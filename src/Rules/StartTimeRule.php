<?php

namespace Behance\NBD\Gatekeeper\Rules;

class StartTimeRule extends TimeRuleAbstract {

  const RULE_NAME = 'start_time';

  /**
   * @var \DateTimeImmutable
   */
  private $_start_time;

  /**
   * @param \DateTimeImmutable $start_time
   */
  public function __construct( \DateTimeImmutable $start_time ) {

    $this->_start_time = $start_time;

  } // __construct

  /**
   * {@inheritdoc}
   */
  public function canAccess( $check_time = null ) {

    return $this->_getCurrentTime() >= $this->_start_time;

  } // canAccess

} // StartTimeRule
