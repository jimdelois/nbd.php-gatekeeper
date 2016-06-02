<?php

namespace Behance\NBD\Gatekeeper;

use Behance\NBD\Gatekeeper\Test\BaseTest;

class IdentifierHashBucketTest extends BaseTest {

  /**
   * @test
   * @dataProvider getBucketDefaultProvider
   */
  public function getBucketDefault( $identifier, $expected_feature_1_bucket, $expected_feature_2_bucket ) {

    $salt_1 = 'my_test_feature';
    $salt_2 = 'another_feature';

    $identifier_hash_bucket = new IdentifierHashBucket( $salt_1, $identifier );

    $this->assertEquals( $expected_feature_1_bucket, $identifier_hash_bucket->getBucket() );
    $this->assertEquals( $expected_feature_1_bucket, $identifier_hash_bucket->getBucket() );

    $identifier_hash_bucket = new IdentifierHashBucket( $salt_2, $identifier );

    $this->assertEquals( $expected_feature_2_bucket, $identifier_hash_bucket->getBucket() );
    $this->assertEquals( $expected_feature_2_bucket, $identifier_hash_bucket->getBucket() );

  } // getBucketDefault

  /**
   * @return array
   */
  public function getBucketDefaultProvider() {

    return [
        [ '234234788485',    43, 36 ],
        [ 234234788485,      43, 36 ],
        [ '7676322',         46, 50 ],
        [ 'someone@AdobeID', 32, 88 ],
        [ 'another@AdobeID', 12, 76 ],
    ];

  } // getBucketDefaultProvider

  /**
   * @test
   * @dataProvider getBucketWithNumProvider
   */
  public function getBucketWithNum( $identifier, $expected_feature_1_bucket, $expected_feature_2_bucket ) {

    $salt_1   = 'my_test_feature';
    $salt_2   = 'banother_feature';
    $num_buckets = 10;

    $identifier_hash_bucket = new IdentifierHashBucket( $salt_1, $identifier, $num_buckets );

    $this->assertEquals( $expected_feature_1_bucket, $identifier_hash_bucket->getBucket() );
    $this->assertEquals( $expected_feature_1_bucket, $identifier_hash_bucket->getBucket() );

    $identifier_hash_bucket = new IdentifierHashBucket( $salt_2, $identifier, $num_buckets );

    $this->assertEquals( $expected_feature_2_bucket, $identifier_hash_bucket->getBucket() );
    $this->assertEquals( $expected_feature_2_bucket, $identifier_hash_bucket->getBucket() );

  } // getBucketWithNum

  /**
   * @return array
   */
  public function getBucketWithNumProvider() {

    return [
        [ 12345,             4,  10 ],
        [ 234234788485,      3,  2 ],
        [ '7676322',         6,  7 ],
        [ 'someone@AdobeID', 2, 8 ],
        [ 'another@AdobeID', 2, 6 ],
    ];

  } // getBucketWithNumProvider

} // IdentifierHashBucketTest
