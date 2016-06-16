<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Rules\AuthenticatedPercentageRule;

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
   * @param  array  $identifiers
   *
   * @return bool
   */
  public function canAccess( $feature, array $identifiers = [] ) {

    return $this->_ruleset_provider->getRuleset( $feature )->canAccess( $identifiers );

  } // canAccess

  /**
   * @param  array $identifiers
   *
   * @return array
   */
  public function getActiveFeatures( array $identifiers = [] ) {

    return array_filter( $this->_ruleset_provider->getFeatures(), function( $feature_name ) use ( $identifiers ) {
      return $this->canAccess( $feature_name, $identifiers );
    } );

  } // getActiveFeatures

  /**
   * @param array $identifiers
   *
   * @return array
   */
  public function getPercentageFeaturesByActiveState( array $identifiers = [] ) {

    $feature_state_map = [];
    $features          = $this->_ruleset_provider->getFeatures();

    foreach ( $features as $feature ) {

      $ruleset = $this->_ruleset_provider->getRuleset( $feature );

      if ( $ruleset->hasRuleOfType( AuthenticatedPercentageRule::RULE_NAME ) ) {
        $feature_state_map[ $feature ] = $this->canAccess( $feature, $identifiers );
      }

    } // foreach features

    return $feature_state_map;

  } // getPercentageFeaturesByActiveState

} // Gatekeeper
