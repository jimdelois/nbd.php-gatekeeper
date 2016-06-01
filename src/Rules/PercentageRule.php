<?php

namespace Behance\NBD\Gatekeeper\Rules;

use Behance\NBD\Gatekeeper\Exceptions\ParameterValidationException;
use Behance\NBD\Gatekeeper\IdentifierHashBucket;

class PercentageRule implements RuleInterface {

  const RULE_NAME = 'percentage';

  /**
   * @var int
   */
  private $_percentage;

  /**
   * @var string
   */
  private $_feature;

  /**
   * @param int $percentage
   * @param string $feature
   */
  public function __construct( $percentage, $feature ) {

    if ( !is_int( $percentage ) ) {
      throw new \InvalidArgumentException( "Invalid percentage value. $percentage given. Must be an int between 0 and 100 inclusive." );
    }

    if ( $percentage > 100 || $percentage < 0 ) {
      throw new \InvalidArgumentException( "Invalid int for percentage rule. $percentage given. Must be between 0 and 100 inclusive." );
    }

    $this->_percentage = $percentage;
    $this->_feature    = $feature;

  } // __construct

  /**
   * {@inheritdoc}
   */
  public function canAccess( $identifier = null ) {

    return ( $this->_getBucket( $identifier ) <= $this->_percentage );

  } // canAccess

  /**
   * @param string $identifier
   *
   * @return int
   */
  protected function _getBucket( $identifier ) {

    $bucket = new IdentifierHashBucket( $this->_feature, $identifier );

    return $bucket->getBucket();

  } // _getBucket

} // PercentageRule
