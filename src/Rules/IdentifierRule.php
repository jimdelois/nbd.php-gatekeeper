<?php

namespace Behance\NBD\Gatekeeper\Rules;

class IdentifierRule implements RuleInterface {

  const RULE_NAME = 'identifier';

  /**
   * @var array
   */
  private $_valid_identifiers;

  /**
   * @var array
   */
  private $_valid_identifier_map = null;

  /**
   * @param array $valid_identifiers
   */
  public function __construct( array $valid_identifiers = [] ) {

    $this->_valid_identifiers = $valid_identifiers;

  } // __construct

  /**
   * @return array
   */
  protected function _getIdentifierMap() {

    if ( $this->_valid_identifier_map === null ) {
      $this->_valid_identifier_map = array_flip( $this->_valid_identifiers );
    }

    return $this->_valid_identifier_map;

  } // _getIdentifierMap

  /**
   * {@inheritdoc}
   */
  public function canAccess( $identifier = null ) {

    if ( $identifier === null ) {
      return false;
    }

    return array_key_exists( $identifier, $this->_getIdentifierMap() );

  } // canAccess

} // IdentifierRule
