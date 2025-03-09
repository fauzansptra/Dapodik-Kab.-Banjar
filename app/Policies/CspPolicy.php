<?php
namespace App\Policies;

use Spatie\Csp\Policies\Policy;
use Spatie\Csp\Directive;

class CspPolicy extends Policy
{
    public function configure()
    {
        $this
            ->addDirective(Directive::SCRIPT, [
                "'self'",
                "https://cdn.jsdelivr.net",
                "https://unpkg.com",
                "https://cdnjs.cloudflare.com",
                "'sha256-randomhash'", // Replace with actual SHA hash
            ]);
    }
}
