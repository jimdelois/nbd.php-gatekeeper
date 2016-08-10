<?php

namespace Behance\NBD\Gatekeeper\Rules;

class StartTimeRule extends TimeRuleAbstract {

  const RULE_NAME = 'start_time';

  /**
   * @var \DateTimeImmutable
   */
  protected $_start_time;

  /**
   * @param \DateTimeImmutable $start_time
   */
  public function __construct( \DateTimeImmutable $start_time ) {

    $this->_start_time = $start_time;

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

    return $time >= $this->_start_time;

  } // _isInTimeRange

} // StartTimeRule
