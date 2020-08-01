<?php

namespace Gustavguez\MezzioCms\Domain\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="sections_contents")
 */
class SectionContentEntity extends ContentEntity {
	
	/**
     * @ORM\OneToOne(targetEntity="SectionContentEntity")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;
	
	public function getParent() {
        return $this->parent;
    }

	
	public function setParent($parent) {
        $this->parent = $parent;
	}
	
	public function jsonSerialize() {
		$content = parent::jsonSerialize();
		$parent = null;

		if ($this->parent instanceof JsonSerializable) {
            $parent = $this->parent->jsonSerialize();
		}

		$content['parent'] = $this->parent;
        return $content;
	}
}
