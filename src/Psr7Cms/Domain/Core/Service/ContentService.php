<?php

namespace Gustavguez\Psr7Cms\Domain\Core\Service;

use Doctrine\ORM\EntityManager;
use Gustavguez\Psr7Cms\Domain\Core\Service\MultimediaService;
use Gustavguez\Psr7Cms\Domain\Core\Entity\ContentEntity;
use Gustavguez\Psr7Cms\Domain\Api\Common\BaseService;

class ContentService extends BaseService {

    protected $multimediaService = null;
    protected $multimediaFolder = '';
    protected static $SPANISH_UNNECESSARY = ["el", "la", "los", "las", "un", "una", "unos", "unas", "lo", "al", "del", "para"];

    public function __construct(EntityManager $entityManager = null, MultimediaService $multimediaService = null) {
        parent::__construct($entityManager);

        $this->multimediaService = $multimediaService;
    }

    public function deleteContent($id) {
        if ((int) $id > 0) {
            parent::delete($id);
        }
    }

    public function addContent($payload, $uploadFiles, $userId) {
        $content = new $this->class();
        /* @var $content ContentEntity */
        $content->setContent($payload['content']);
        $content->setDescription($payload['description']);
        $content->setHighlighted((bool) $payload['highlighted']);
        $content->setKeywords($payload['keywords']);
        $content->setPublished(true);
        $content->setTitle($payload['title']);
        $content->setUpDate(date('Y-m-d H:i:s'));
        $content->setUserId($userId);

        parent::add($content);
        //Add Multimedia
        if (!empty($uploadFiles) && !empty($uploadFiles['picture'])) {
            $multimediaEntity = $this->multimediaService->addMultimedia($uploadFiles['picture'], $this->multimediaFolder);
            if (!empty($multimediaEntity)) {
                $content->setMultimedia($multimediaEntity);
                $this->entityManager->flush($content);
            }
        }
    }

    public function updateContent($payload, $uploadFiles) {
        $content = parent::findOneBy(array(
                    'id' => $payload['id']
        ));

        if ($content instanceof $this->class) {
            $content->setContent($payload['content']);
            $content->setDescription($payload['description']);
            $content->setHighlighted((bool) $payload['highlighted']);
            $content->setKeywords($payload['keywords']);
            $content->setTitle($payload['title']);
            //Add Multimedia
            if (!empty($uploadFiles) && !empty($uploadFiles['picture'])) {
                $multimediaEntity = $this->multimediaService->addMultimedia($uploadFiles['picture'], $this->multimediaFolder);
                (!empty($multimediaEntity)) && $content->setMultimedia($multimediaEntity);
            }
            parent::update($content);
        }
    }

    public function searchContent($query) {
        //Process query before execute
        $aux = array();
        $queryParts = explode(' ', $query);

        foreach ($queryParts as $queryWord) {
            //transform word
            $queryWord = trim(strtolower($queryWord));

            //Check unnessesary
            if (!in_array($queryWord, self::$SPANISH_UNNECESSARY)) {
                //Must remove plural?
                if(substr($queryWord, -1) === 's'){
                    $queryWord = substr($queryWord, 0, -1);
                }
                
                //Push as valid quey word
                $aux[] = $queryWord;
            }
        }
        
        //Create new quer improved
        $query = implode('%', $aux);

        return $this->repository->createQueryBuilder('c')
                        ->where('c.title LIKE :query OR c.description LIKE :query')
                        ->andWhere('c.published = 1')
                        ->setParameter('query', sprintf('%%%s%%', $query))
                        ->orderBy('c.id', 'DESC')
                        ->getQuery()
                        ->getResult();
    }

}
