<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service;

use Gustavguez\MezzioCms\Domain\Core\Entity\MultimediaEntity;
use Gustavguez\MezzioCms\Domain\Api\Common\BaseService;
use Doctrine\ORM\EntityManager;
use Zend\Diactoros\UploadedFile;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class MultimediaService extends BaseService {

    protected $config;
    protected $class = MultimediaEntity::class;

    public function __construct(EntityManager $entityManager = null, $config = null) {
        parent::__construct($entityManager);

        $this->config = $config;
    }

    public function addMultimedia($file, $folder) {
        try {
            if ($file instanceof UploadedFile) {
				$path = $this->config['multimedia_path'] . $folder . DIRECTORY_SEPARATOR;
                $name = $this->getUniqueFilename($path, $file->getClientFilename());

                if (!empty($name)) {
                    
                    $filename = $path . $name;
                    $file->moveTo($filename);


                    $multimedia = new MultimediaEntity();
                    $multimedia->setType(1); //Pictures
                    $multimedia->setFolder($folder);
					$multimedia->setSource($name);
					
					//Persist
					$this->entityManager->persist($multimedia);
					$this->entityManager->flush();

                    $this->generateThumbs($path, $name);
                    return $multimedia;
                } else {
                    return false;
                }
            }
        } catch (Exception $ex) {
            
        }
    }

    private function generateThumbs($fullPath, $fileName) {
		try {
			$imagine = new Imagine();
			$size = new Box(400, 300);
			$mode = ImageInterface::THUMBNAIL_OUTBOUND;

			$imagine->open($fullPath . $fileName)
					->thumbnail($size, $mode)
					->save($fullPath . 'thumbs' . DIRECTORY_SEPARATOR . $fileName);
		} catch (\Exception $e) {
			//throw $th;
		}
	}
	
	private function getUniqueFilename($fullPath, $fileName) {
			$version = 0;
			$result = $fileName;

			while(file_exists($fullPath.$result)){
				$result = $version . "_" . $fileName;
				$version++;
			}

			return $result;
    }

}
