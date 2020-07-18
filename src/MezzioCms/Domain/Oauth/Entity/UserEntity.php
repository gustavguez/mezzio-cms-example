<?php

namespace Gustavguez\MezzioCms\Domain\Oauth\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_users")
 */
class UserEntity implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=255)
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=255)
     * @var string
     */
    private $lastName;

    /**
     * @ORM\Column(name="profile_image", type="string", length=255)
     * @var string
     */
    private $profileImage;

    /**
     * Application constructor.
     * @param $name
     */
    public function __construct($username, $firstName, $lastName, $profileImage)
    {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->profileImage = $profileImage;
    }

    public function getId(){ 
        return $this->id; 
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'profileImage' => $this->profileImage
        ];
    }
}