<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoomNo
 *
 * @ORM\Table(name="RoomNo")
 * @ORM\Entity
 */
class RoomNo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="RoomNo", type="string")
     */
    private $roomNo;

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
     * Set roomNo
     *
     * @param string $roomNo
     * @return RoomNo
     */
    public function setRoomNo($roomNo)
    {
        $this->roomNo = $roomNo;

        return $this;
    }

    /**
     * Get roomNo
     *
     * @return string
     */
    public function getRoomNo()
    {
        return $this->roomNo;
    }

    public function __toString() {
        return $this->roomNo;
    }
}
