<?php

namespace App\Policies;

use Spatie\Csp\Policies\Basic;

class ContentSecurityPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this
            ->addDirective('default-src', ["*"])
            ->addDirective('script-src', ["*","'unsafe-inline'","'unsafe-eval'"])
            ->addDirective('style-src', ["*","self","'unsafe-inline'"])
            ->addDirective('img-src', ["*","data:","blob:"])
            ->addDirective('connect-src', ["*"])
            ->addDirective('frame-src', ["*"])
            ->addDirective('media-src', ["*"])
            ->addDirective('object-src', ["*"])
            ->addDirective('font-src', ["*","data:"])
            ->addDirective('worker-src', ["*","blob:"])
            ->reportOnly();
    }
}
