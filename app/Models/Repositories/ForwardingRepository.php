<?php


namespace App\Models\Repositories;


use App\Models\Entities\Forwarding;

class ForwardingRepository
{
    public function create(array $request)
    {
        if(!empty($request['id'])){
            $model = Forwarding::where('id', '=', $request['id'])->first();
        }else{
            $model = new Forwarding();
        }
        $model->plastic_film = $request['plastic_film'];
        $model->styrofoam = $request['styrofoam'];
        $model->hardboard = $request['hardboard'];
        $model->osb = $request['osb'];
        $model->cardboard = $request['cardboard'];
        $model->streych_film = !empty($request['streych_film']) && $request['streych_film'] == 'on' ? 1 : null;
        $model->crate = !empty($request['crate']) && $request['crate'] == 'on' ? 1 : null;
        $model->evr_pallet = !empty($request['evr_pallet']) && $request['evr_pallet'] == 'on' ? 1 : null;
        $model->places_recalc = !empty($request['places_recalc']) && $request['places_recalc'] == 'on' ? 1 : null;
       // $model->forwarder_task = $request['forwarder_task'];
       // $model->pallet_size = $request['pallet_size'];
        $model->warming = $request['warming'];
      //  $model->naval_downloading = !empty($request['naval_downloading']) && $request['naval_downloading'] == 'on' ? 1 : null;
      //  $model->downloading_on_pallet = !empty($request['downloading_on_pallet']) && $request['downloading_on_pallet'] == 'on' ? 1 : null;
      //  $model->oversize_downloading = !empty($request['oversize_downloading']) && $request['oversize_downloading'] == 'on' ? 1 : null;
        $model->knitting_wire_fixation = !empty($request['knitting_wire_fixation']) && $request['knitting_wire_fixation'] == 'on' ? 1 : null;
        $model->inside_recalc = !empty($request['inside_recalc']) && $request['inside_recalc'] == 'on' ? 1 : null;
        $model->stickering = !empty($request['stickering']) && $request['stickering'] == 'on' ? 1 : null;
        $model->place_filling = !empty($request['place_filling']) && $request['place_filling'] == 'on' ? 1 : null;
        $model->van_filling = !empty($request['van_filling']) && $request['van_filling'] == 'on' ? 1 : null;
        $model->pallet_formation = !empty($request['pallet_formation']) && $request['pallet_formation'] == 'on' ? 1 : null;
        $model->parameters_formation = !empty($request['parameters_formation']) && $request['parameters_formation'] == 'on' ? 1 : null;
      //  $model->consolidation = $request['consolidation'];
        $model->photofix_enabled = !empty($request['photofix_enabled']) && $request['photofix_enabled'] == 'on' ? 1 : null;
        //$model->photofix_date = $request['photofix_date'];
        $model->more = $request['more'];


        $model->styrofoam_fact = !empty($request['styrofoam_fact']) && $request['styrofoam_fact'] == 'on' ? 1 : null;
        $model->hardboard_fact = !empty($request['hardboard_fact']) && $request['hardboard_fact'] == 'on' ? 1 : null;
        $model->osb_fact = !empty($request['osb_fact']) && $request['osb_fact'] == 'on' ? 1 : null;
        $model->cardboard_fact = !empty($request['cardboard_fact']) && $request['cardboard_fact'] == 'on' ? 1 : null;
        $model->save();
        return $model->id;
    }

    public function updateModel($class, $id, $forwardingId)
    {
        $model = $class::find($id);
        $model->forwarding_id = $forwardingId;
        $model->save();
    }

    public function delete($class, $id, $forId = null)
    {
        if(!$forId){
            $model = $class::where('id', '=', $id)->first();
            $this->removeById($model->forwarding_id);
        }
    }

    public function removeById(?int $forwarding_id)
    {
        if(!empty($forwarding_id)){
            Forwarding::where('id', '=', $forwarding_id)->delete();
        }
    }
}
