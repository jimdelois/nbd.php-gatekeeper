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
  public function canAccess( array $identifiers = [] ) {

    return $this->_getCurrentTime() <= $this->_end_time;

  } // canAccess

} // EndTimeRule
