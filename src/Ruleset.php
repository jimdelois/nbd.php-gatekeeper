<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Rules\RuleInterface;

class Ruleset {

  /**
   * @var \Behance\NBD\Gatekeeper\Rules\RuleInterface[]
   */
  private $_rules = [];

  /**
   * @param \Behance\NBD\Gatekeeper\Rules\RuleInterface $rule
   */
  public function addRule( RuleInterface $rule ) {

    $this->_rules[] = $rule;

  } // addRule

  /**
   * @return array
   */
  public function getRules() {

    return $this->_rules;

  } // getRules

  /**
   * @param  mixed $identifier
   * @return bool
   */
  public function canAccess( $identifier = null ) {

    foreach ( $this->_rules as $rule ) {

      if ( $rule->canAccess( $identifier ) ) {
        return true;
      }

    }

    return false;

  } // canAccess

} // Ruleset
