<?php

namespace App\Notifications\Purchase;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseSuccess extends Notification
{
    use Queueable;

    /** @var \App\Models\Purchase */
    public $purchase;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Purchase  $purchase
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $purchase = $this->purchase;
        $method = $purchase->method;
        $deliveryLineOne = '';
        $deliveryLineTwo = '';
        if ($method === 'shipped') {
            $deliveryLineOne = "Your tshirt(s) will be shipped to the following address:";
            $deliveryLineTwo = "{$purchase->address}, {$purchase->city}, {$purchase->state} {$purchase->zip}";
        } else {
            $location = ucfirst($purchase->pickup_location);

            $deliveryLineOne= "Your tshirt(s) will be hand delivered to you in the {$location} area.";
            $deliveryLineTwo = "We will contact you to setup the details of your delivery.";
        }

        return (new MailMessage)
            ->subject('#TeamKimberlyn')
            ->markdown('mail.purchase.successful', [
                'method' => $purchase->method,
                'deliveryLineOne' => $deliveryLineOne,
                'deliveryLineTwo' => $deliveryLineTwo,
                'total' => $purchase->readable_total,
                'lineItems' => $purchase->lineItems,
            ]);
    }
}
