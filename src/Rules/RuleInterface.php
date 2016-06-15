<?php

namespace Behance\NBD\Gatekeeper\Rules;

interface RuleInterface {

  /**
   * @param  array $identifiers
   *
   * @return bool
   */
  public function canAccess( array $identifiers = [] );

} // RuleInterface
