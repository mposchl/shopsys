<?php

declare(strict_types=1);

namespace App\Model\Payment;

use Shopsys\FrameworkBundle\Component\Domain\Domain;
use Shopsys\FrameworkBundle\Component\Image\ImageFacade;
use Shopsys\FrameworkBundle\Model\Payment\Payment as BasePayment;
use Shopsys\FrameworkBundle\Model\Payment\PaymentData as BasePaymentData;
use Shopsys\FrameworkBundle\Model\Payment\PaymentDataFactory as BasePaymentDataFactory;
use Shopsys\FrameworkBundle\Model\Payment\PaymentFacade;
use Shopsys\FrameworkBundle\Model\Pricing\Vat\VatFacade;

class PaymentDataFactory extends BasePaymentDataFactory
{
    /**
     * @param \Shopsys\FrameworkBundle\Model\Payment\PaymentFacade $paymentFacade
     * @param \Shopsys\FrameworkBundle\Model\Pricing\Vat\VatFacade $vatFacade
     * @param \Shopsys\FrameworkBundle\Component\Domain\Domain $domain
     * @param \Shopsys\FrameworkBundle\Component\Image\ImageFacade $imageFacade
     */
    public function __construct(
        PaymentFacade $paymentFacade,
        VatFacade $vatFacade,
        Domain $domain,
        ImageFacade $imageFacade
    ) {
        parent::__construct($paymentFacade, $vatFacade, $domain, $imageFacade);
    }

    /**
     * @return \App\Model\Payment\PaymentData
     */
    public function create(): BasePaymentData
    {
        $paymentData = $this->createInstance();
        $this->fillNew($paymentData);

        return $paymentData;
    }

    /**
     * @param \App\Model\Payment\Payment $payment
     * @return \App\Model\Payment\PaymentData
     */
    public function createFromPayment(BasePayment $payment): BasePaymentData
    {
        $paymentData = $this->createInstance();
        $this->fillFromPayment($paymentData, $payment);

        return $paymentData;
    }

    /**
     * @return \App\Model\Payment\PaymentData
     */
    protected function createInstance(): BasePaymentData
    {
        return new PaymentData();
    }
}
