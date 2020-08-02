<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service;

use Gustavguez\MezzioCms\Domain\Core\Entity\RecipeContentEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\ContentService;

class RecipeContentService extends ContentService {

    protected $class = RecipeContentEntity::class;
	protected $multimediaFolder = 'recipes';

}
