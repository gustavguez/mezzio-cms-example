<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service;

use Gustavguez\MezzioCms\Domain\Core\Entity\NewsContentEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\ContentService;

class NewsContentService extends ContentService {

    protected $class = NewsContentEntity::class;
    protected $multimediaFolder = 'news';

}
