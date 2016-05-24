<?php

namespace Behance\NBD\Gatekeeper\Rules;

interface RuleInterface {

  /**
   * @param  mixed $identifier
   *
   * @return bool
   */
  public function canAccess( $identifier = null );

} // RuleInterface
