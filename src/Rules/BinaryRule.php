<?php

namespace Behance\NBD\Gatekeeper\Rules;

class BinaryRule implements RuleInterface {

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
  public function canAccess( $identifier = null ) {

    return $this->_value;

  } // canAccess

} // BinaryRule
