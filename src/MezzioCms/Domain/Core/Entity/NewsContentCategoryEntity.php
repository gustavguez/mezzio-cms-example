<?php

namespace Gustavguez\MezzioCms\Domain\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="news_content_categories")
 */
class NewsContentCategoryEntity implements JsonSerializable {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @var string
     */
    private $name;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

}
