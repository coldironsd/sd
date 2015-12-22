<?php
// src/AppBundle/Entity/DeliveryRequest.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="deliver_request")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DeliveryRequestRepository")
 */
class DeliveryRequest implements \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=255, unique=false, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\Column(length=255, nullable=false)
     */
    private $pickup_addr;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pickup_addr_coord;
    
    /**
     * @ORM\Column(length=255, nullable=false)
     */
    private $dest_addr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dest_addr_coord;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="deliver_request")
     * @ORM\JoinColumn(name="created_user_id", referencedColumnName="id", nullable=false)
     */
    private $created_user_id;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cost;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $delivery_date;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @ORM\Version
     */
    private $last_updated;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="deliver_request")
     * @ORM\JoinColumn(name="deliver_user_id", referencedColumnName="id", nullable=false)
     */
    private $deliver_user_id;

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->description,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->description,
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
     * Set name
     *
     * @param string $name
     *
     * @return DeliveryRequest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return DeliveryRequest
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pickupAddr
     *
     * @param string $pickupAddr
     *
     * @return DeliveryRequest
     */
    public function setPickupAddr($pickupAddr)
    {
        $this->pickup_addr = $pickupAddr;

        return $this;
    }

    /**
     * Get pickupAddr
     *
     * @return string
     */
    public function getPickupAddr()
    {
        return $this->pickup_addr;
    }

    /**
     * Set destAddr
     *
     * @param string $destAddr
     *
     * @return DeliveryRequest
     */
    public function setDestAddr($destAddr)
    {
        $this->dest_addr = $destAddr;

        return $this;
    }

    /**
     * Get destAddr
     *
     * @return string
     */
    public function getDestAddr()
    {
        return $this->dest_addr;
    }

    /**
     * Set createdUserId
     *
     * @param integer $createdUserId
     *
     * @return DeliveryRequest
     */
    public function setCreatedUserId($createdUserId)
    {
        $this->created_user_id = $createdUserId;

        return $this;
    }

    /**
     * Get createdUserId
     *
     * @return integer
     */
    public function getCreatedUserId()
    {
        return $this->created_user_id;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return DeliveryRequest
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set deliveryDate
     *
     * @param \DateTime $deliveryDate
     *
     * @return DeliveryRequest
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->delivery_date = $deliveryDate;

        return $this;
    }

    /**
     * Get deliveryDate
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
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

    /**
     * Set deliverUserId
     *
     * @param integer $deliverUserId
     *
     * @return DeliveryRequest
     */
    public function setDeliverUserId($deliverUserId)
    {
        $this->deliver_user_id = $deliverUserId;

        return $this;
    }

    /**
     * Get deliverUserId
     *
     * @return integer
     */
    public function getDeliverUserId()
    {
        return $this->deliver_user_id;
    }

    /**
     * Set pickupAddrCoord
     *
     * @param string $pickupAddrCoord
     *
     * @return DeliveryRequest
     */
    public function setPickupAddrCoord($pickupAddrCoord)
    {
        $this->pickup_addr_coord = $pickupAddrCoord;

        return $this;
    }

    /**
     * Get pickupAddrCoord
     *
     * @return string
     */
    public function getPickupAddrCoord()
    {
        return $this->pickup_addr_coord;
    }

    /**
     * Set destAddrCoord
     *
     * @param string $destAddrCoord
     *
     * @return DeliveryRequest
     */
    public function setDestAddrCoord($destAddrCoord)
    {
        $this->dest_addr_coord = $destAddrCoord;

        return $this;
    }

    /**
     * Get destAddrCoord
     *
     * @return string
     */
    public function getDestAddrCoord()
    {
        return $this->dest_addr_coord;
    }
}
