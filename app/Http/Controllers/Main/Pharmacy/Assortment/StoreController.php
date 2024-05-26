<?php

namespace App\Http\Controllers\Main\Pharmacy\Assortment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\Assortment\StoreRequest;
use App\Models\MedecinePharmacy;
use App\Models\Pharmacy;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $result = $this->service->addAssortment($data);

        if ($result['status'] === 'error') {
            return redirect()->back()->withErrors(['medicine_id' => $result['message']])->withInput();
        }

        return redirect()->route('pharmacy.assortment.index', $result['pharmacy']);
    }
}

