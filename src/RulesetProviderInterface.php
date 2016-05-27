<?php

namespace Behance\NBD\Gatekeeper;

interface RulesetProviderInterface {

  /**
   * @param  string $feature
   *
   * @return \Behance\NBD\Gatekeeper\Ruleset
   */
  public function getRuleset( $feature );

} // RulesetProviderInterface
