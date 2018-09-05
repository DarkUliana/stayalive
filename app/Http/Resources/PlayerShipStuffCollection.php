<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 05.09.2018
 * Time: 11:31
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlayerShipStuffCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data['playerID'] = $request->playerID;
        $data['shipFloors'] = [];

        foreach ($this->collection as $item) {

            $data['shipFloors'][$item->floorIndex]['floorIndex'] = $item->floorIndex;

            $floorCell['cellIndex'] = $item->cellIndex;
            $floorCell['cellType'] = $item->cellType;
            $floorCell['technologyType'] = $item->technologyType;
            $floorCell['techLevel'] = $item->techLevel;

            $data['shipFloors'][$item->floorIndex]['floorCells'][] = $floorCell;
        }

        return $data;
    }
}