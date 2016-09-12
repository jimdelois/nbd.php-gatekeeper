<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException;

abstract class RuleAbstract implements RuleInterface {

  const IDENTIFIER_AUTHENTICATED = 'authenticated';
  const IDENTIFIER_ANONYMOUS     = 'anonymous';
  const IDENTIFIER_TIME          = 'time';
  const IDENTIFIER_IP            = 'ip';

  /**
   * @return string
   */
  public function getType() {

    return static::RULE_NAME;

  } // getType

} // RuleAbstract
