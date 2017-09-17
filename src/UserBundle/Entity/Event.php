<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="Event")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $reference;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\NotNull()
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="from", type="datetime")
     * @Assert\NotNull()
     */
    private $from;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="to", type="datetime")
     * @Assert\NotNull()
     */
    private $to;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="promoter_id", referencedColumnName="id")
     */
    private $promoter;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param DateTime $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return DateTime
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param DateTime $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return User
     */
    public function getPromoter()
    {
        return $this->promoter;
    }

    /**
     * @param User $promoter
     */
    public function setPromoter($promoter)
    {
        $this->promoter = $promoter;
    }
}


