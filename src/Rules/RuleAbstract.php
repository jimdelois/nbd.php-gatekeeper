<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException;

abstract class RuleAbstract implements RuleInterface {

  const IDENTIFIER_AUTHENTICATED = 'authenticated';
  const IDENTIFIER_ANONYMOUS     = 'anonymous';
  const IDENTIFIER_TIME          = 'time';
  const IDENTIFIER_IP            = 'ip';

  const IDENTIFIER_TYPES = [
      self::IDENTIFIER_AUTHENTICATED,
      self::IDENTIFIER_ANONYMOUS,
      self::IDENTIFIER_TIME,
      self::IDENTIFIER_IP,
  ];

  /**
   * @return string
   */
  public function getType() {

    return static::RULE_NAME;

  } // getType

  /**
   * @param  array $identifiers
   * @throws \Behance\NBD\Gatekeeper\Exceptions\InvalidIdentifierException
   */
  protected function _validateIdentifiers( array $identifiers ) {

    foreach ( $identifiers as $identifier_type => $identifier_value ) {
      if ( !in_array( $identifier_type, self::IDENTIFIER_TYPES ) ) {
        throw new InvalidIdentifierException( 'Identifier with invalid type "' . $identifier_type . '" supplied.' );
      }
    }

  } // _validateIdentifiers

} // RuleAbstract
