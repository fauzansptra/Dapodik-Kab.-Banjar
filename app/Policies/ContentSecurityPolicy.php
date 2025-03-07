<?php

namespace App\Policies;

use Spatie\Csp\Policies\Basic;

class ContentSecurityPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this
            ->addDirective('script-src', ["'self'", "'unsafe-eval'"]);
    }
}
