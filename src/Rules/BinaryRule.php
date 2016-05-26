<?php

namespace Behance\NBD\Gatekeeper\Rules;

class BinaryRule implements RuleInterface {

  /**
   * @var bool
   */
  private $_value;

  /**
   * @param bool $value
   */
  public function __construct( $value ) {

    $this->_value = $value;

  } // __contruct

  /**
   * {@inheritdoc}
   */
  public function canAccess( $identifier = null ) {

    return $this->_value;

  } // canAccess

} // BinaryRule
