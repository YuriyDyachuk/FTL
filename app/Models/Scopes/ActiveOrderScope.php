<?php


namespace App\Models\Scopes;


use App\Models\Entities\EntityStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveOrderScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->leftJoin('leads as l', $model->getTable().'.lead_id', '=', 'l.id')
            ->leftJoin('client_requests as cl', 'cl.lead_id', '=', 'l.id')
            ->where('cl.status', '=',strval(EntityStatus::DONE_STATUS));
    }
}
