<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\ParameterValidationException;

class AuthenticatedPercentageRule extends PercentageRuleAbstract {

  const RULE_NAME       = 'authenticated_percentage';
  const IDENTIFIER_TYPE = RuleAbstract::IDENTIFIER_AUTHENTICATED;

} // AuthenticatedPercentageRule
