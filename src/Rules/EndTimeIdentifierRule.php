<?php

namespace Behance\NBD\Gatekeeper\Rules;

class EndTimeIdentifierRule extends EndTimeRule {

  const RULE_NAME = 'end_time_identifier';

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

} // EndTimeIdentifierRule
