<?php

namespace Gustavguez\MezzioCms\Domain\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="events_contents")
 */
class EventContentEntity extends ContentEntity {
	
	/**
     * @ORM\Column(name="date", type="datetime")
     * @var int
     */
	protected $date;
	
	public function getDate() {
        return $this->date;
	}
	
	public function setDate($date) {
        $this->date = $date;
	}
	
	public function jsonSerialize() {
		$content = parent::jsonSerialize();
		$content['date'] = $this->date;
        return $content;
	}
}
