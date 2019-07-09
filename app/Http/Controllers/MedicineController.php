<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{

    /**
     * @param Request $request
     * nehalk
     */
    public function store(Request $request)
    {
        Medicine::create($this->validateRequest($request));
    }

    /**
     * @param Request $request
     * @param         $id
     * nehalk
     */
    public function update(Request $request, $id)
    {
        Medicine::where(['id' => $id])->update($this->validateRequest($request));
    }

    /**
     * @param Request $request
     * @return mixed
     * nehalk
     */
    public function validateRequest($request)
    {
        $data = $request->validate([
            'title'           => 'required',
            'expiration_date' => 'required'
        ]);

        return $data;
    }
}
