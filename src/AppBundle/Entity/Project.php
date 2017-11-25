<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity
 */
class Project
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
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_coordinates", type="string")
     */
    private $gpsCoordinates;

    /**
     * @var string
     *
     * @ORM\Column(name="plan_view", type="string")
     */
    private $planView;

    /**
     * @var string
     *
     * @ORM\Column(name="ownership", type="string")
     */
    private $ownership;

    /**
     * @var string
     *
     * @ORM\Column(name="occupant", type="string")
     */
    private $occupant;

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
     * @return Project
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
     * Set address
     *
     * @param string $address
     * @return Project
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set gpsCoordinates
     *
     * @param string $gpsCoordinates
     * @return Project
     */
    public function setGpsCoordinates($gpsCoordinates)
    {
        $this->gpsCoordinates = $gpsCoordinates;

        return $this;
    }

    /**
     * Get gpsCoordinates
     *
     * @return string
     */
    public function getGpsCoordinates()
    {
        return $this->gpsCoordinates;
    }

    /**
     * Set planView
     *
     * @param string $planView
     * @return Project
     */
    public function setPlanView($planView)
    {
        $this->planView = $planView;

        return $this;
    }

    /**
     * Get planView
     *
     * @return string
     */
    public function getPlanView()
    {
        return $this->planView;
    }

    /**
     * Set ownership
     *
     * @param string $ownership
     * @return Project
     */
    public function setOwnership($ownership)
    {
        $this->ownership = $ownership;

        return $this;
    }

    /**
     * Get ownership
     *
     * @return string
     */
    public function getOwnership()
    {
        return $this->ownership;
    }

    /**
     * Set occupant
     *
     * @param string $occupant
     * @return Project
     */
    public function setOccupant($occupant)
    {
        $this->occupant = $occupant;

        return $this;
    }

    /**
     * Get occupant
     *
     * @return string
     */
    public function getOccupant()
    {
        return $this->occupant;
    }

    public function __toString() {
        return $this->building;
    }
}
