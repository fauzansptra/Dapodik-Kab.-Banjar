<?php
use Spatie\Csp\Directive; // ✅ Correct import

return [

    /*
     * A policy will determine which CSP headers will be set. A valid CSP policy is
     * any class that extends `Spatie\Csp\Policies\Policy`
     */
    'policy' => App\Policies\CspPolicy::class, // Reference the class, NOT an array

    /*
     * This policy which will be put in report only mode. This is great for testing out
     * a new policy or changes to existing csp policy without breaking anything.
     */
    'report_only_policy' => '',

    /*
     * All violations against the policy will be reported to this URL.
     */
    'report_uri' => env('CSP_REPORT_URI', ''),

    /*
     * Headers will only be added if this setting is set to true.
     */
    'enabled' => env('CSP_ENABLED', true),

    /*
     * The class responsible for generating the nonces used in inline tags and headers.
     */
    'nonce_generator' => Spatie\Csp\Nonce\RandomString::class,

    /*
     * Set to false to disable automatic nonce generation and handling.
     */
    'nonce_enabled' => env('CSP_NONCE_ENABLED', true),
];
