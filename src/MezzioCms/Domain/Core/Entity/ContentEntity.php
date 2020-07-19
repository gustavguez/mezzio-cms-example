<?php

namespace Gustavguez\MezzioCms\Domain\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use JsonSerializable;

abstract class ContentEntity implements JsonSerializable {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(name="keywords", type="string", length=255)
     * @var string
     */
    protected $keywords;

    /**
     * @ORM\Column(name="content", type="string")
     * @var string
     */
    protected $content;

    /**
     * @ORM\Column(name="description", type="string", length=255)
     * @var string
     */
    protected $description;

    /**
	 * @ORM\OneToOne(targetEntity="Gustavguez\MezzioCms\Domain\Oauth\Entity\UserEntity")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var string
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="MultimediaEntity")
     * @ORM\JoinColumn(name="multimedia_id", referencedColumnName="id")
     */
    protected $multimedia;

    /**
     * @ORM\Column(name="up_date", type="string")
     * @var string
     */
    protected $upDate;

    /**
     * @ORM\Column(name="published", type="boolean")
     * @var boolean
     */
    protected $published;

    /**
     * @ORM\Column(name="highlighted", type="boolean")
     * @var boolean
     */
    protected $highlighted;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function getContent() {
        return $this->content;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUser() {
        return $this->user;
    }

    public function getMultimedia() {
        return $this->multimedia;
    }

    public function getUpDate() {
        return $this->upDate;
    }

    public function getPublished() {
        return $this->published;
    }

    public function getHighlighted() {
        return $this->highlighted;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setMultimedia($multimedia) {
        $this->multimedia = $multimedia;
    }

    public function setUpDate($upDate) {
        $this->upDate = $upDate;
    }

    public function setPublished($published) {
        $this->published = $published;
    }

    public function setHighlighted($highlighted) {
        $this->highlighted = $highlighted;
    }

    public function jsonSerialize() {
		$multimedia = null;
		$user = null;
        $slug = Slugify::create();

        if ($this->multimedia instanceof JsonSerializable) {
            $multimedia = $this->multimedia->jsonSerialize();
		}
		
		if ($this->user instanceof JsonSerializable) {
            $user = $this->user->jsonSerialize();
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $slug->slugify(html_entity_decode($this->title)),
            'keywords' => $this->keywords,
            'description' => $this->description,
            'content' => $this->content,
            'published' => $this->published,
            'highlighted' => $this->highlighted,
            'upDate' => $this->upDate,
            'multimedia' => $multimedia,
            'user' => $user,
        ];
	}
	
}
