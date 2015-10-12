<?php

namespace SS6\ShopBundle\Component\EntityFile\Config\Exception;

use Exception;

class FilesConfigurationParseException extends Exception implements FileConfigException {

	/**
	 * @var string
	 */
	private $entityClass;

	/**
	 * @param string $entityClass
	 * @param \Exception $previous
	 */
	public function __construct($entityClass, Exception $previous = null) {
		$this->entityClass = $entityClass;

		$message = sprintf('Parsing of config entity class "%s" failed.', $this->entityClass);
		parent::__construct($message, 0, $previous);
	}

	/**
	 * @return string
	 */
	public function getEntityClass() {
		return $this->entityClass;
	}
}
