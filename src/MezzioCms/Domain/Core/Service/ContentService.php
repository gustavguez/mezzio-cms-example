<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service;

use Doctrine\ORM\EntityManager;
use Gustavguez\MezzioCms\Domain\Core\Service\MultimediaService;
use Gustavguez\MezzioCms\Domain\Core\Entity\ContentEntity;
use Gustavguez\MezzioCms\Domain\Api\Common\BaseService;
use Gustavguez\MezzioCms\Domain\Oauth\Entity\UserEntity;

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
            return parent::deleteEntity($id);
        }
    }

    public function addContent($payload, $uploadFiles, UserEntity $user) {
        $content = new $this->class();
        /* @var $content ContentEntity */
        $content->setContent(isset($payload['content']) ? $payload['content'] : null);
        $content->setDescription(isset($payload['description']) ? $payload['description'] : null);
        $content->setHighlighted(isset($payload['highlighted']) ? (bool) $payload['highlighted'] : false);
        $content->setKeywords(isset($payload['keywords']) ? $payload['keywords'] : null);
        $content->setPublished(true);
        $content->setTitle($payload['title']);
        $content->setUpDate(date('Y-m-d H:i:s'));
		$content->setUser($user);
		
		//Parse content
		$this->parseContentBeforePersist($content, $payload);

		//Persist
        $this->entityManager->persist($content);
		$this->entityManager->flush();
		
        //Add Multimedia
        if (!empty($uploadFiles) && !empty($uploadFiles['picture'])) {
            $multimediaEntity = $this->multimediaService->addMultimedia($uploadFiles['picture'], $this->multimediaFolder);
            if (!empty($multimediaEntity)) {
                $content->setMultimedia($multimediaEntity);
                $this->entityManager->flush($content);
            }
		}
		return $content;
	}
	
	public function parseContentBeforePersist($content, $payload){

	}

    public function updateContent($id, $payload, $uploadFiles) {
        $content = parent::getEntity($id);

        if ($content instanceof $this->class) {
			$content->setContent(isset($payload['content']) ? $payload['content'] : null);
			$content->setDescription(isset($payload['description']) ? $payload['description'] : null);
			$content->setHighlighted(isset($payload['highlighted']) ? (bool) $payload['highlighted'] : false);
			$content->setKeywords(isset($payload['keywords']) ? $payload['keywords'] : null);
			$content->setTitle($payload['title']);
			
			//Parse content
			$this->parseContentBeforePersist($content, $payload);

            //Add Multimedia
            if (!empty($uploadFiles) && !empty($uploadFiles['picture'])) {
                $multimediaEntity = $this->multimediaService->addMultimedia($uploadFiles['picture'], $this->multimediaFolder);
                (!empty($multimediaEntity)) && $content->setMultimedia($multimediaEntity);
			}
			
            //Persist
			$this->entityManager->persist($content);
			$this->entityManager->flush();
			return $content;
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

        return $this->entityRepository->createQueryBuilder('c')
                        ->where('c.title LIKE :query OR c.description LIKE :query')
                        ->andWhere('c.published = 1')
                        ->setParameter('query', sprintf('%%%s%%', $query))
                        ->orderBy('c.id', 'DESC')
                        ->getQuery()
                        ->getResult();
    }

}
