<?php

namespace Shemi\Laradmin\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Shemi\Laradmin\Models\Type;

interface TransformTypeModelDataRepository
{

    public function transform(Type $type, Model $model = null);

}