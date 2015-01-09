<?php

namespace SS6\ShopBundle\Model\Image;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use SS6\ShopBundle\Model\FileUpload\FileUpload;
use SS6\ShopBundle\Model\Image\Config\Exception\ImageEntityConfigNotFoundException;
use SS6\ShopBundle\Model\Image\Config\ImageConfig;
use SS6\ShopBundle\Model\Image\Image;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

class ImageDeleteDoctrineListener {

	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * @var Filesystem
	 */
	private $filesystem;

	/**
	 * @var ImageConfig
	 */
	private $imageConfig;

	/**
	 * @var FileUpload
	 */
	private $fileUpload;

	public function __construct(
		ContainerInterface $container,
		Filesystem $filesystem,
		ImageConfig $imageConfig,
		FileUpload $fileUpload
	) {
		$this->container = $container;
		$this->filesystem = $filesystem;
		$this->imageConfig = $imageConfig;
		$this->fileUpload = $fileUpload;
	}

	/**
	 * @param LifecycleEventArgs $args
	 */
	public function preRemove(LifecycleEventArgs $args) {
		$entity = $args->getEntity();
		$em = $args->getEntityManager();

		$this->deleteEntityImages($entity, $em);

		if ($entity instanceof Image) {
			$this->deleteImagesFromDisk($entity);
		}
	}

	/**
	 * @param mixed $entity
	 * @param EntityManager $em
	 */
	private function deleteEntityImages($entity, EntityManager $em) {
		try {
			$imageFacade = $this->container->get('ss6.shop.image.image_facade');
			/* @var $imageFacade \SS6\ShopBundle\Model\Image\ImageFacade */

			$images = $imageFacade->getImagesByEntity($entity, null);
			if (count($images) > 0) {
				foreach ($images as $entity) {
					$em->remove($entity);
				}
			}
		} catch(ImageEntityConfigNotFoundException $e) {
		}
	}

	/**
	 * @param Image $image
	 */
	private function deleteImagesFromDisk(Image $image) {
		$entityName = $image->getEntityName();
		$imageConfig = $this->imageConfig->getEntityConfigByEntityName($entityName);
		foreach ($imageConfig->getSizes() as $size) {
			$basePath = $this->fileUpload->getUploadDirectory(true, $entityName, $size->getName());
			$filePath = $basePath . DIRECTORY_SEPARATOR . $image->getId() . '.' . $image->getExtension();
			if ($this->filesystem->exists($filePath)) {
				$this->filesystem->remove($filePath);
			}
		}
	}

}
