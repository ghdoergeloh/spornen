<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RunParticipation extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $runpart = parent::toArray($request);
        $runpart['sum'] = number_format($this->calculateDonationSum(),2,',','.');
        return $runpart;
    }
}
