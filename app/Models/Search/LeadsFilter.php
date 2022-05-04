<?php


namespace App\Models\Search;


class LeadsFilter extends AFilter
{
    public function client($value)
    {
        $this->entity->where('client_id', '=', $value);
    }

    public function created_at($value)
    {
        $this->entity->where('created_at', '=', $value);
    }

    public function ktk_prefix($value)
    {
        $this->entity->join('client_requests', 'client_requests.lead_id', '=', 'leads.id')
            ->join('client_request_ftlwh_from', 'client_request_ftlwh_from.client_request_id', '=', 'client_requests.id');
        $this->entity->where('client_request_ftlwh_from.unl_cont_ktk_prefix', '=', $value);
    }

    public function ktk_num($value)
    {
        $this->entity->join('client_requests', 'client_requests.lead_id', '=', 'leads.id')
            ->join('client_request_ftlwh_from', 'client_request_ftlwh_from.client_request_id', '=', 'client_requests.id');
            $this->entity->where('client_request_ftlwh_from.unl_cont_ktk_number', '=', $value);
    }
}
