<?php

namespace Shemi\Laradmin\Policies;

class AdminPolicy extends Policy
{

    protected function browse($user)
    {
        return false;
    }

}