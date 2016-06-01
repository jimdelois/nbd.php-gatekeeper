<?php

namespace Behance\NBD\Gatekeeper;

class IdentifierHashBucket {

  const DEFAULT_NUM_BUCKETS = 100;

  /**
   * @var string
   */
  private $_feature;

  /**
   * @var mixed
   */
  private $_identifier;

  /**
   * @var int
   */
  private $_num_buckets;

  /**
   * @var int
   */
  private $_bucket = null;

  /**
   * @param string $feature
   * @param mixed  $identifier
   * @param int $num_buckets
   */
  public function __construct( $feature, $identifier, $num_buckets = self::DEFAULT_NUM_BUCKETS ) {

    $this->_feature     = $feature;
    $this->_identifier  = $identifier;
    $this->_num_buckets = $num_buckets;

  } // __construct

  /**
   * @return int
   */
  public function getBucket() {

    if ( $this->_bucket === null ) {
      $this->_calculateBucket();
    }

    return $this->_bucket;

  } // getBucket

  protected function _calculateBucket() {

    $hash          = crc32( $this->_feature . $this->_identifier );
    $this->_bucket = ( $hash % $this->_num_buckets ) + 1;

  } // _calculateBucket

} // IdentifierHashBucket
