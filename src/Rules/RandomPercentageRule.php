<?php

namespace Behance\NBD\Gatekeeper\Rules;

class RandomPercentageRule extends PercentageRuleAbstract {

  const RULE_NAME       = 'random_percentage';
  const IDENTIFIER_TYPE = RuleAbstract::IDENTIFIER_ANONYMOUS;

  /**
   * {@inheritdoc}
   */
  public function canAccess( array $identifiers = [] ) {

    $identifiers[ self::IDENTIFIER_TYPE ] = $this->_getRandomIdentifier();

    return parent::canAccess( $identifiers );

  } // canAccess

  /**
   * @return int
   */
  protected function _getRandomIdentifier() {

      return mt_rand( 1, 1000 );

  } // _getRandomIdentifier

} // RandomPercentageRule
