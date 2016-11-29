<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="request")
 */
class Req
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     * @Assert\Length(min = 2, max = 16)
     * @Assert\Regex("/[a-zA-Z]/")
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max = 30)
     * @ORM\Column(type="string", length=16, nullable=true)
     * @Assert\Regex("/.+/")
     */
    private $lastName;

    /**
     * @Assert\Length(min = 1)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $email;

    /**
     * Year of birth
     * @ORM\Column(type="text", length=12, nullable=true)
     * @Assert\Regex("/[0-9]{10,12}/")
     * @Assert\NotBlank()
     */
    private $telephone;

    /**
     * @Assert\Length(min = 1)
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $request;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $requestDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Account
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Account
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return Request
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Request
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set request
     *
     * @param string $request
     * @return Request
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set requestDate
     *
     * @param \DateTime $requestDate
     * @return Request
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get requestDate
     *
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Request
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
}