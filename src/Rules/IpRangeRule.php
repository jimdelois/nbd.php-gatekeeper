<?php

namespace Behance\NBD\Gatekeeper\Rules;

class IpRangeRule extends RuleAbstract {

  const RULE_NAME = 'ip_range';

  /**
   * @var int
   */
  private $_start_ip_range;

  /**
   * @var int
   */
  private $_end_ip_range;

  /**
   * @param string $start_ip
   * @param string $end_ip
   */
  public function __construct( $start_ip, $end_ip ) {

    $this->_start_ip_range = ip2long( $start_ip );

    if ( $this->_start_ip_range === false ) {
      throw new \InvalidArgumentException( "Invalid start ip for range. {$start_ip} given. Must be a valid IP." );
    }

    $this->_end_ip_range = ip2long( $end_ip );

    if ( $this->_end_ip_range === false ) {
      throw new \InvalidArgumentException( "Invalid end ip for range. {$end_ip} given. Must be a valid IP." );
    }

  } // __construct

  /**
   * {@inheritdoc}
   */
  public function canAccess( array $identifiers = [] ) {

    if ( !isset( $identifiers[ RuleAbstract::IDENTIFIER_IP ] ) ) {
      return false;
    }

    $ip_long = ip2long( $identifiers[ RuleAbstract::IDENTIFIER_IP ] );

    if ( $ip_long === false ) {
      return false;
    }

    return ( ( $ip_long >= $this->_start_ip_range ) && ( $ip_long <= $this->_end_ip_range ) );

  } // canAccess

} // IpRangeRule
