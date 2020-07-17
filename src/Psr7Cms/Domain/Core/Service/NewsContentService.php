<?php

namespace Gustavguez\Psr7Cms\Domain\Core\Service;

use Gustavguez\Psr7Cms\Domain\Core\Entity\NewsContentEntity;
use Gustavguez\Psr7Cms\Domain\Core\Service\ContentService;

class NewsContentService extends ContentService {

    protected $class = NewsContentEntity::class;
    protected $multimediaFolder = 'news';

}
