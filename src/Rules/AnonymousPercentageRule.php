<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\ParameterValidationException;

class AnonymousPercentageRule extends PercentageRuleAbstract {

  const RULE_NAME       = 'anonymous_percentage';
  const IDENTIFIER_TYPE = RuleAbstract::IDENTIFIER_ANONYMOUS;

} // AnonymousPercentageRule
