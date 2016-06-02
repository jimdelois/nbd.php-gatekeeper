<?php

namespace Behance\NBD\Gatekeeper;

class Gatekeeper {

  /**
   * @var \Behance\NBD\Gatekeeper\RulesetProviderInterface
   */
  private $_ruleset_provider;

  /**
   * @param \Behance\NBD\Gatekeeper\RulesetProviderInterface $ruleset_provider
   */
  public function __construct( RulesetProviderInterface $ruleset_provider ) {

    $this->_ruleset_provider = $ruleset_provider;

  } // __construct

  /**
   * @param  string $feature
   * @param  string|array|null $identifier
   * @return bool
   */
  public function canAccess( $feature, $identifier = null ) {

    $identifier = ( is_array( $identifier ) )
                  ? $identifier
                  : [ $identifier ];

    foreach ( $identifier as $single_identifier ) {
      if ( $this->_ruleset_provider->getRuleset( $feature )->canAccess( $single_identifier ) ) {
        return true;
      }
    }

    return false;

  } // canAccess

  /**
   * @param  string|array|null $identifier
   * @return array
   */
  public function getActiveFeatures( $identifier = null ) {

    return array_filter( $this->_ruleset_provider->getFeatures(), function( $feature_name ) use ( $identifier ) {
      return $this->canAccess( $feature_name, $identifier );
    } );

  } // getActiveFeatures

} // Gatekeeper
