<?php

namespace Behance\NBD\Gatekeeper\Rules;

abstract class TimeRuleAbstract {

  /**
   * @return \DateTimeImmutable
   */
  protected function _getCurrentTime() {

    return new \DateTimeImmutable();

  } // _getCurrentTime

} // TimeRuleAbstract