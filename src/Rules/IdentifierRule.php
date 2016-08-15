<?php

namespace Behance\NBD\Gatekeeper\Rules;

class IdentifierRule extends RuleAbstract {

  const RULE_NAME      = 'identifier';
  const USE_IDENTIFIER = self::IDENTIFIER_AUTHENTICATED;

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
  public function canAccess( array $identifiers = [] ) {

    $this->_validateIdentifiers( $identifiers );

    $valid_identifiers = $this->_getIdentifierMap();

    return
        isset( $identifiers[ static::USE_IDENTIFIER ] )
        && array_key_exists( $identifiers[ static::USE_IDENTIFIER ], $valid_identifiers );

  } // canAccess

} // IdentifierRule
