nbd.php-gatekeeper: rule-based access control
=======================

[![Build Status](https://secure.travis-ci.org/behance/nbd.php-gatekeeper.svg?branch=master)](http://travis-ci.org/behance/nbd.php-gatekeeper)

Gatekeeper provides a set of rules that are used to control access to defined features. Dependancies have been kept minimal for easy setup and use, requiring no database storage while still making it easy to configure from a database, json file, etc. if you'd like to.

Right now it comes with the following rules (though it's easy to add your own too):
<table>
<tr><td>BinaryRule</td><td>Can be set to on/off and grants access if set to on.</td></tr>
<tr><td>IdentifierRule</td><td>Identifiers (ex. user ids) that are in the given list provided by config are granted access.</td></tr>
<tr><td>AuthenticatedPercentageRule</td><td>Primarily for a/b testing, allows a feature to be turned on for x percentage of users, which is consistently determined automatically by the given user identifier. For this rule, "authenticated" is meant to represent that the rule should only be applied to an identifier that is marked as "authenticated" (see "Basic Usage" example below.)</td></tr>
<tr><td>AnonymousPercentageRule</td><td>Exactly the same as AuthenticatedPercentageRule, except this rule type only applies to identifiers that are marked as "anonymous."</td></tr>
<tr><td>BetweenTimesRule</td><td>grants access if the current date/time is between two specified date/times</td></tr>
<tr><td>StartTimeRule</td><td>grants access beginning at a specified date/time</td></tr>
<tr><td>EndTimeRule</td><td>grants access up until a specified end date/time</td></tr>
</table>
## Basic Usage

```php
$rule_config = [
    'website_overhaul' => [
        // turn the site overhaul on for a few specific users
        [
            'type'   => \Behance\NBD\Gatekeeper\Rules\IdentifierRule::RULE_NAME,
            'params' => [
                'valid_identifiers' => [
                    123, // admin 1 user id
                    456, // admin 2 user id
                ]
            ]
        ],
        // roll out the new site to 10% of users (users who see it will remain consistent)
        [
            'type'   => \Behance\NBD\Gatekeeper\Rules\AuthenticatedPercentageRule::RULE_NAME,
            'params' => [
                'percentage' => 10
            ]
        ],
    ],
    'welcome_text' => [
        // allow everyone to see this feature
        [
            'type'   => \Behance\NBD\Gatekeeper\Rules\BinaryRule::RULE_NAME,
            'params' => [
                'on' => true
            ]
        ],
    ]
];

$ruleset_provider = new \Behance\NBD\Gatekeeper\RulesetProviders\ConfigRulesetProvider( $rule_config );

$gatekeeper       = new \Behance\NBD\Gatekeeper\Gatekeeper( $ruleset_provider );

// This can be any kind of identifier. the percentage rule hashes it consistently
// so the same user identifiers are always allowed/disallowed into the test.
// Here we use an "authenticated" identifier because we're dealing with a user id.
$identifier = [
    'authenticated' => 456
];

if ( $gatekeeper->canAccess( 'welcome_text', $identifier ) ) {

   echo "<p>Welcome to the website.</p>";

}

if ( $gatekeeper->canAccess( 'website_overhaul', $identifier ) ) {

   echo "<p>Congrats! You get to see the awesome new site!</p>";

}
else {

   echo "<p>Looks like you're stuck with the old stuff...</p>";

}
```
## License
nbd.php-gatekeeper is licensed under the MIT license. See [License File](LICENSE) for more information.
