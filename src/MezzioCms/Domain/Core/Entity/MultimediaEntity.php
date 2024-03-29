<?php

namespace Gustavguez\MezzioCms\Domain\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="multimedias")
 */
class MultimediaEntity implements JsonSerializable {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=255)
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(name="source", type="string")
     * @var string
     */
    private $source;

    /**
     * @ORM\Column(name="folder", type="string")
     * @var string
     */
	private $folder;
	
	 /**
     * @ORM\Column(name="type", type="integer")
     * @var string
     */
    private $type;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSource() {
        return $this->source;
    }

    public function getFolder() {
        return $this->folder;
	}

	public function getType() {
        return $this->type;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setSource($source) {
        $this->source = $source;
    }

    public function setFolder($folder) {
        $this->folder = $folder;
	}
	
	public function setType($type) {
        $this->type = $type;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'source' => $this->source,
            'folder' => $this->folder,
            'type' => $this->type
        ];
    }

}
