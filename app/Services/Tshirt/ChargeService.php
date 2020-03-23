<?php

namespace App\Services\Tshirt;

use App\Models\LineItem;
use App\Models\Purchase;
use App\Models\Size;
use Cartalyst\Stripe\Stripe;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class ChargeService extends Service
{
    use SelfCallingService;

    /** @var \App\Models\Sizes */
    private $sizes;

    /** @var \App\Models\Purchase */
    private $purchases;

    /** @var \App\Models\LineItem */
    private $lineItems;

    /** @var \Cartalyst\Stripe\Stripe */
    private $stripe;

    /**
     * Construct a new ChargeService.
     *
     * @param  \App\Models\Sizes  $sizes
     * @param  \App\Models\Purchase  $purchases
     * @param  \App\Models\LineItem  $lineItems
     * @param  \Cartalyst\Stripe\Stripe  $stripe
     */
    public function __construct(Size $sizes, Purchase $purchases, LineItem $lineItems, Stripe $stripe)
    {
        $this->sizes = $sizes;
        $this->purchases = $purchases;
        $this->lineItems = $lineItems;
        $this->stripe = $stripe;
    }

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function run(array $parameters = [])
    {
        $customer = $this->customer;
        $tshirts = $this->sizes->available()->get();
        $choices = collect($parameters['sizes'])->reject(function($quantity, $size) {
            return $quantity == 0;
        });

        $lineItems = [];

        $purchase = $this->purchases->create([
            'customer_id' => $customer->id,
            'method' => $parameters['deliveryType'],
            'pickup_location' => $parameters['pickupLocation'],
            'address' => $parameters['address'],
            'city' => $parameters['city'],
            'state' => $parameters['state'],
            'zip' => $parameters['zip'],
        ]);

        foreach($choices as $size => $quantity) {
            $tshirt = $tshirts->where('slug', $size)->first();
            $lineItems[] = $this->lineItems->create([
                'size_id' => $tshirt->id,
                'purchase_id' => $purchase->id,
                'quantity' => $quantity,
                'total' => $tshirt->price * $quantity
            ]);
        }

        $purchaseTotal = collect($lineItems)->sum('total');
        $purchase->total = $parameters['deliveryType'] === 'shipped' ? $purchaseTotal + 500 : $purchaseTotal;
        $purchase->save();

        $this->stripe->charges()->create([
            'card' => $parameters['token'],
            'currency' => 'USD',
            'amount'   => $purchase->total/100,
            'description' => 'Team Kimberlyn T-shirt',
        ]);
    }

    /**
     * Calculate the total cost to charge customer.
     *
     * @param array $request
     */
    public function calculateTotalCost(array $parameters, Collection $choices, EloquentCollection $tshirts): int
    {
        $total = 0;

        foreach($choices as $size => $quantity) {
            $total += $tshirts->where('slug', $size)->first()->price * $quantity;
        }

        if ($parameters['deliveryType'] == 'shipped') {
            $total += 500;
        }

        return $total/100;
    }
}
