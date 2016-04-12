<?php
// src/AppBundle/Entity/TakeRequest.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="take_request")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TakeRequestRepository")
 */
class TakeRequest implements \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="DeliveryRequest", inversedBy="take_request")
     * @ORM\JoinColumn(name="request_id", referencedColumnName="id", nullable=false)
     */
    private $request_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="take_request")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user_id;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @ORM\Version
     */
    private $last_updated;
    

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return TakeRequest
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }
    
     /**
     * Set requestId
     *
     * @param integer $requestId
     *
     * @return TakeRequest
     */
    public function setRequestId($requestId)
    {
        $this->request_id = $requestId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
     /**
     * Get requestId
     *
     * @return integer
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     *
     * @return DeliveryRequest
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->last_updated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }
}
