<?php

namespace Behance\NBD\Gatekeeper;

class IdentifierHashBucket {

  const DEFAULT_NUM_BUCKETS = 100;

  /**
   * @var string
   */
  private $_salt;

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
   * @param string $salt - right now the callers of this class all use feature name as salt
   * @param mixed  $identifier
   * @param int $num_buckets
   */
  public function __construct( $salt, $identifier, $num_buckets = self::DEFAULT_NUM_BUCKETS ) {

    $this->_salt        = $salt;
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

    $hash          = abs( crc32( $this->_salt . $this->_identifier ) );
    $this->_bucket = ( $hash % $this->_num_buckets ) + 1;

  } // _calculateBucket

} // IdentifierHashBucket
