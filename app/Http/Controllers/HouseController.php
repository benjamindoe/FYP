<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\House;
use App\Model\HousePoint;

class HouseController extends Controller
{
    public function showHouses (Request $request)
    {
        return view('houses.houses', ['houses' => House::all()]);
    }

    public function showPointsForm (Request $request)
    {
        return view('houses.points', ['houses' => House::all()]);
    }

    public function alterPoints(Request $request)
    {
        $house = House::findOrFail($request->house);
        $housePoint = new HousePoint;
        $housePoint->points = $request->points;
        $housePoint->reason = $request->reason;
        $housePoint->house_id = $request->house;
        $housePoint->teacher_id = auth()->user()->staff->id;
        $house->points += $request->points;
        $house->save();
        $housePoint->save();
        return redirect('houses/points');
    }
}
