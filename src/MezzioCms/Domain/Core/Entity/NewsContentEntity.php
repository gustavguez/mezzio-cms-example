<?php

namespace Gustavguez\MezzioCms\Domain\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="news_contents")
 */
class NewsContentEntity extends ContentEntity {
	
	/**
     * @ORM\Column(name="category_id", type="integer")
     * @var int
     */
	protected $categoryId;
	
	public function getCategoryId() {
        return $this->categoryId;
	}
	
	public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
	}
	
	public function jsonSerialize() {
		$content = parent::jsonSerialize();
		$content['categoryId'] = $this->categoryId;
        return $content;
	}
}
