<?php

namespace App\Observers\Admin\Market;



use App\Models\Market\Copan;

class CopanObserver
{
    /**
     * Handle the Copan "creating" event.
     */
    public function creating(Copan $copan): void
    {
        $copan->code ??= $copan->generateCopanCode();
    }
}
