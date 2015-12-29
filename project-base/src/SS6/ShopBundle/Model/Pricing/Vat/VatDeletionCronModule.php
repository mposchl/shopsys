<?php

namespace SS6\ShopBundle\Model\Pricing\Vat;

use SS6\ShopBundle\Component\Cron\IteratedCronModuleInterface;
use SS6\ShopBundle\Model\Pricing\Vat\VatFacade;
use SS6\ShopBundle\Model\Product\Pricing\ProductInputPriceFacade;
use Symfony\Bridge\Monolog\Logger;

class VatDeletionCronModule implements IteratedCronModuleInterface {

	/**
	 * @var \Symfony\Bridge\Monolog\Logger
	 */
	private $logger;

	/**
	 * @var \SS6\ShopBundle\Model\Pricing\Vat\VatFacade
	 */
	private $vatFacade;

	/**
	 * @var ProductInputPriceFacade
	 */
	private $productInputPriceFacade;

	public function __construct(VatFacade $vatFacade, ProductInputPriceFacade $productInputPriceFacade) {
		$this->vatFacade = $vatFacade;
		$this->productInputPriceFacade = $productInputPriceFacade;
	}

	/**
	 * @inheritdoc
	 */
	public function initialize(Logger $logger) {
		$this->logger = $logger;
	}

	/**
	 * @inheritdoc
	 */
	public function iterate() {
		$batchResult = $this->productInputPriceFacade->replaceBatchVatAndRecalculateInputPrices();
		$deletedVatsCount = $this->vatFacade->deleteAllReplacedVats();

		if ($batchResult) {
			$this->logger->debug('Batch is done');
		} else {
			$this->logger->debug('All vats are replaced');
		}
		$this->logger->addInfo('Deleted ' . $deletedVatsCount . ' vats');

		return $batchResult;
	}
}
