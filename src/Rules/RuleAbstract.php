<?php

namespace Behance\NBD\Gatekeeper\Rules;

abstract class RuleAbstract implements RuleInterface {

  /**
   * @return string
   */
  public function getType() {

    return static::RULE_NAME;

  } // getType

} // RuleAbstract
