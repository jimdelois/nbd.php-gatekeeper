<?php

namespace Behance\NBD\Gatekeeper\Rules;

class StartTimeIdentifierRule extends StartTimeRule {

  const RULE_NAME = 'start_time_identifier';

  /**
   * {@inheritdoc}
   */
  public function canAccess( array $identifiers = [] ) {

    $use_time = $this->_getTimeFromIdentifiers( $identifiers );

    if ( $use_time === false ) {
      return false;
    }

    return $this->_isInTimeRange( $use_time );

  } // canAccess

} // StartTimeIdentifierRule
