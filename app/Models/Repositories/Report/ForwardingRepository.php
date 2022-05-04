<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\ForwardingReport;
use App\Models\Repositories\PhotoRepository;

class ForwardingRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data)
    {
        ForwardingReport::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update($id, $data)
    {
        $model = ForwardingReport::findOrFail($id);
        $model->warming = $data['warming'];

        $model->styrofoam_count = $data['styrofoam_count'];
        $model->hardboard_count = $data['hardboard_count'];
        $model->osb_count = $data['osb_count'];
        $model->cardboard_count = $data['cardboard_count'];

        $model->plastic_film = $data['plastic_film'];
        $model->styrofoam = $data['styrofoam'];
        $model->hardboard = $data['hardboard'];
        $model->osb = $data['osb'];
        $model->cardboard = $data['cardboard'];
        $model->streych_film = $data['streych_film'];

        $model->places_recalculation = $data['places_recalculation'];
        $model->internal_investments_recalculation = $data['internal_investments_recalculation'];


        $model->crate_enabled = isset($data['crate_enabled']) ? 1 : 0;
        $model->evr_pallet_enabled = isset($data['evr_pallet_enabled']) ? 1 : 0;


        $model->stickering_enabled = isset($data['stickering_enabled']) ? 1 : 0;
        $model->seat_filling_enabled = isset($data['seat_filling_enabled']) ? 1 : 0;
        $model->pallet_formation_enabled = isset($data['pallet_formation_enabled']) ? 1 : 0;
        $model->parameters_formation_enabled = isset($data['parameters_formation_enabled']) ? 1 : 0;
        $model->knitting_wire_fixation_enabled = isset($data['knitting_wire_fixation_enabled']) ? 1 : 0;
        $model->sealing_van_enabled = isset($data['sealing_van_enabled']) ? 1 : 0;
        $model->photofix_enabled = isset($data['photofix_enabled']) ? 1 : 0;

        if(!empty($data['crate_photo_file'])){
            $model->crate_photo = $this->photoRepository->updateFile($data['crate_photo_file']);
            unset($data['crate_photo_file']);
        }else{
            $model->crate_photo = $data['crate_photo'];
        }

        if(!empty($data['internal_investments_recalculation_photo_file'])){
            $model->internal_investments_recalculation_photo = $this->photoRepository->updateFile($data['internal_investments_recalculation_photo_file']);
            unset($data['internal_investments_recalculation_photo_file']);
        }else{
            $model->internal_investments_recalculation_photo = $data['internal_investments_recalculation_photo'];
        }

        if(!empty($data['stickering_photo_file'])){
            $model->stickering_photo = $this->photoRepository->updateFile($data['stickering_photo_file']);
            unset($data['stickering_photo_file']);
        }else{
            $model->stickering_photo = $data['stickering_photo'];
        }

        if(!empty($data['seat_filling_photo_file'])){
            $model->seat_filling_photo = $this->photoRepository->updateFile($data['seat_filling_photo_file']);
            unset($data['seat_filling_photo_file']);
        }else{
            $model->seat_filling_photo = $data['seat_filling_photo'];
        }

        if(!empty($data['pallet_formation_photo_file'])){
            $model->pallet_formation_photo = $this->photoRepository->updateFile($data['pallet_formation_photo_file']);
            unset($data['pallet_formation_photo_file']);
        }else{
            $model->pallet_formation_photo = $data['pallet_formation_photo'];
        }

        if(!empty($data['parameters_formation_photo_file'])){
            $model->parameters_formation_photo = $this->photoRepository->updateFile($data['parameters_formation_photo_file']);
            unset($data['parameters_formation_photo_file']);
        }else{
            $model->parameters_formation_photo = $data['parameters_formation_photo'];
        }

        if(!empty($data['knitting_wire_fixation_photo_file'])){
            $model->knitting_wire_fixation_photo = $this->photoRepository->updateFile($data['knitting_wire_fixation_photo_file']);
            unset($data['knitting_wire_fixation_photo_file']);
        }else{
            $model->knitting_wire_fixation_photo = $data['knitting_wire_fixation_photo'];
        }

        if(!empty($data['sealing_van_photo_file'])){
            $model->sealing_van_photo = $this->photoRepository->updateFile($data['sealing_van_photo_file']);
            unset($data['sealing_van_photo_file']);
        }else{
            $model->sealing_van_photo = $data['sealing_van_photo'];
        }

        if(!empty($data['photofix_photo_file'])){
            $model->photofix_photo = $this->photoRepository->updateFile($data['photofix_photo_file']);
            unset($data['photofix_photo_file']);
        }else{
            $model->photofix_photo = $data['photofix_photo'];
        }

        $model->status = EntityStatus::DONE_STATUS;

        $model->save();
    }
}
