<?php

namespace Behance\NBD\Gatekeeper\Rules;

class BinaryRule extends RuleAbstract {

  const RULE_NAME = 'binary';

  /**
   * @var bool
   */
  private $_value;

  /**
   * @param bool $value
   */
  public function __construct( $value ) {

    $this->_value = $value;

  } // __construct

  /**
   * {@inheritdoc}
   */
  public function canAccess( array $identifiers = [] ) {

    return $this->_value;

  } // canAccess

} // BinaryRule
