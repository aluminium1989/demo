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
 * @ORM\Table(name="account")
 */
class Account implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16, unique=true, nullable=false)
     * @Assert\Length(min = 8, max = 15)
     * @Assert\Regex("/[a-z]/")
     * @Assert\NotBlank()
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     * @Assert\Length(min = 2, max = 16)
     * @Assert\Regex("/[a-zA-Z]/")
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max = 30)
     * @ORM\Column(type="string", length=16, nullable=false)
     * @Assert\Regex("/[.*]/")
     */
    private $lastName;

    /**
     * @Assert\Length(min = 1)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=256, nullable=false)
     * @Assert\Length(min = 12, max = 20)
     * @Assert\Regex("/[a-zA-Z]/")
     */
    private $password;

    /**
     * @var
     */
    private $confirm;

    /**
     * Year of birth
     * @ORM\Column(type="integer", length=4, nullable=true)
     * @Assert\LessThanOrEqual(2010)
     * @Assert\GreaterThanOrEqual(1900)
     * @Assert\Regex("/[0-9]/")
     * @Assert\NotBlank()
     */
    private $yob;

    /**
     * Has a cat
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $hasCat;

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
     * Set login
     *
     * @param string $login
     * @return Account
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
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
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set yob
     *
     * @param integer $yob
     * @return Account
     */
    public function setYob($yob)
    {
        $this->yob = $yob;

        return $this;
    }

    /**
     * Get yob
     *
     * @return integer 
     */
    public function getYob()
    {
        return $this->yob;
    }

    /**
     * Set hasCat
     *
     * @param integer $hasCat
     * @return Account
     */
    public function setHasCat($hasCat)
    {
        $this->hasCat = $hasCat;

        return $this;
    }

    /**
     * Get hasCat
     *
     * @return integer 
     */
    public function getHasCat()
    {
        return $this->hasCat;
    }

    /**
     * Set confirm
     *
     * @param string $confirm
     * @return Account
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * Get confirm
     *
     * @return string
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function getUsername(){
        return $this->getLogin();
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}
