<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Exceptions\DateTimeImmutableException;
use Behance\NBD\Gatekeeper\Exceptions\MissingRuleParameterException;
use Behance\NBD\Gatekeeper\Exceptions\UnknownRuleTypeException;
use Behance\NBD\Gatekeeper\Rules\AnonymousPercentageRule;
use Behance\NBD\Gatekeeper\Rules\AuthenticatedPercentageRule;
use Behance\NBD\Gatekeeper\Rules\BetweenTimesIdentifierRule;
use Behance\NBD\Gatekeeper\Rules\BetweenTimesRule;
use Behance\NBD\Gatekeeper\Rules\BinaryRule;
use Behance\NBD\Gatekeeper\Rules\EndTimeIdentifierRule;
use Behance\NBD\Gatekeeper\Rules\EndTimeRule;
use Behance\NBD\Gatekeeper\Rules\IdentifierRule;
use Behance\NBD\Gatekeeper\Rules\PercentageRule;
use Behance\NBD\Gatekeeper\Rules\RandomPercentageRule;
use Behance\NBD\Gatekeeper\Rules\StartTimeIdentifierRule;
use Behance\NBD\Gatekeeper\Rules\StartTimeRule;

class RuleFactory {

  /**
   * @param  string $type
   * @param  array $params
   * @param  string|null $feature
   *
   * @return \Behance\NBD\Gatekeeper\Rules\RuleInterface
   *
   * @throws \Behance\NBD\Gatekeeper\Exceptions\MissingRuleParameterException
   * @throws \Behance\NBD\Gatekeeper\Exceptions\UnknownRuleTypeException
   */
  public static function create( $type, array $params = [], $feature = null ) {

    switch ( $type ) {

      case BinaryRule::RULE_NAME:
        return new BinaryRule(
            self::_getRuleParam( 'on', $type, $params )
        );

      case IdentifierRule::RULE_NAME:
        return new IdentifierRule(
            self::_getRuleParam( 'valid_identifiers', $type, $params )
        );

      case BetweenTimesRule::RULE_NAME:
      case BetweenTimesIdentifierRule::RULE_NAME:

        return new BetweenTimesRule(
            self::_getDateImmutableObject( self::_getRuleParam( 'from', $type, $params ) ),
            self::_getDateImmutableObject( self::_getRuleParam( 'to', $type, $params ) )
        );

      case StartTimeRule::RULE_NAME:
      case StartTimeIdentifierRule::RULE_NAME:
        return new StartTimeRule(
            self::_getDateImmutableObject( self::_getRuleParam( 'start', $type, $params ) )
        );

      case EndTimeRule::RULE_NAME:
      case EndTimeIdentifierRule::RULE_NAME:
        return new EndTimeRule(
            self::_getDateImmutableObject( self::_getRuleParam( 'end', $type, $params ) )
        );

      case AuthenticatedPercentageRule::RULE_NAME:

        if ( $feature == null ) {
          throw new MissingRuleParameterException( "Missing required {$feature} parameter for AuthenticatedPercentageRule" );
        }

        return new AuthenticatedPercentageRule(
            self::_getRuleParam( 'percentage', $type, $params ),
            $feature
        );

      case AnonymousPercentageRule::RULE_NAME:

        if ( $feature == null ) {
          throw new MissingRuleParameterException( "Missing required {$feature} parameter for AnonymousPercentageRule" );
        }

        return new AnonymousPercentageRule(
            self::_getRuleParam( 'percentage', $type, $params ),
            $feature
        );

      case RandomPercentageRule::RULE_NAME:

        if ( $feature == null ) {
          throw new MissingRuleParameterException( "Missing required {$feature} parameter for RandomPercentageRule" );
        }

        return new RandomPercentageRule(
            self::_getRuleParam( 'percentage', $type, $params ),
            $feature
        );

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

    return $params[ $param_name ];

  } // _getRuleParam

  /**
   * @param mixed $date_time
   *
   * @return \DateTimeImmutable
   *
   * @throws \Behance\NBD\Gatekeeper\Exceptions\DateTimeImmutableException
   */
  private static function _getDateImmutableObject( $date_time ) {

    if ( $date_time instanceof \DateTimeImmutable ) {
      return $date_time;
    }

    try {

      if ( ctype_digit( (string) $date_time ) ) {
        return new \DateTimeImmutable( "@{$date_time}" );
      }

      if ( is_string( $date_time ) ) {
        return new \DateTimeImmutable( "{$date_time}" );
      }

    } // try date time format

    // @codingStandardsIgnoreStart
    catch( \Exception $e ) {
    // @codingStandardsIgnoreEnd

      throw new DateTimeImmutableException( "Invalid date_time format. {$date_time} given." );

    } // catch date time excpetion

  } // _getDateImmutableObject

} // RuleFactory
