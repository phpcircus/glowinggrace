<?php

namespace App\Http\Actions\Tshirt;

use App\Services\Customer\CreateCustomerService;
use App\Services\Tshirt\ChargeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Purchase extends Action
{
    /**
     * Execute the action.
     */
    public function __invoke(Request $request)
    {
        $customer = CreateCustomerService::call($request->only([
            'name',
            'phone',
            'email',
            'address',
            'city',
            'state',
            'zip',
            'deliveryType',
            'pickupLocation',
            'token',
        ]));

        if ($customer) {
            try {
                ChargeService::call($request->only([
                    'token',
                    'sizes',
                    'deliveryType',
                    'pickupLocation',
                    'address',
                    'city',
                    'state',
                    'zip',
                ]), [
                    'customer' => $customer,
                ]);
                $purchase = $customer->purchases()->latest()->first();
                $purchase->purchase_success = 1;
                $purchase->save();

                return response()->json(['success' => "Thanks so much for your purchase. Your total is {$purchase->readable_total}. We will contact you soon regarding delivery."], 201);
            } catch (Exception $e) {
                $purchase = $customer->purchases()->latest()->first();
                $purchase->purchase_success = 0;
                $purchase->save();

                return response()->json(['card_error' => $e->getMessage()], 401);
            }
        } else {
            return response()->json(['customer_error' => 'Error creating customer record. Please try again.'], 401);
        }

        return $this->responder->respond();
    }
}
