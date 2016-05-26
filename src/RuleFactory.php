<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Exceptions\MissingRuleParameterException;
use Behance\NBD\Gatekeeper\Exceptions\UnknownRuleTypeException;
use Behance\NBD\Gatekeeper\Rules\BetweenTimesRule;
use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\EndTimeRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\Rules\StartTimeRule;

class RuleFactory {

  /**
   * @param  string $type
   * @param  array $params
   *
   * @return \Behance\NBD\Gatekeeper\Rules\RuleInterface
   *
   * @throws \Behance\NBD\Gatekeeper\Exceptions\MissingRuleParameterException
   * @throws \Behance\NBD\Gatekeeper\Exceptions\UnknownRuleTypeException
   */
  public static function create( $type, array $params = [] ) {

    switch ( $type ) {

      case BinaryRule::RULE_NAME:
        return new BinaryRule( self::_getRuleParam( 'on', $type, $params ) );

      case IdentifierRule::RULE_NAME:
        return new IdentifierRule( self::_getRuleParam( 'valid_identifiers', $type, $params ) );

      case BetweenTimesRule::RULE_NAME:
        return new BetweenTimesRule(
            self::_getRuleParam( 'from', $type, $params ),
            self::_getRuleParam( 'to', $type, $params )
        );

      case StartTimeRule::RULE_NAME:
        return new StartTimeRule( self::_getRuleParam( 'start', $type, $params ) );

      case EndTimeRule::RULE_NAME:
        return new EndTimeRule( self::_getRuleParam( 'end', $type, $params ) );
   
      default:
        throw new UnknownRuleTypeException( 'Couldn\'t find rule of type "' . $type . '"' );

    } // switch type

  } // create

  /**
   * @param  string $param_name
   * @param  string $rule_type
   * @param  array $params
   *
   * @return mixed
   *
   * @throws \Behance\NBD\Gatekeeper\Exceptions\MissingRuleParameterException
   */
  private static function _getRuleParam( $param_name, $rule_type, array $params ) {

    if ( !array_key_exists( $param_name, $params ) ) {
      throw new MissingRuleParameterException( 'Missing required rule parameter "' . $param_name . '" for "' . $rule_type . '" rule' );
    }

    return $params[$param_name];

  } // getRuleParam

} // RuleFactory
