<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="Building")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\BuildingRepository")
 *
 */
class Building
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
     * @ORM\Column(name="Building", type="string")
     */
    private $building;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string")
     */
    private $size;

    /**
     * @var \AppBundle\Entity\BuildingTypes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BuildingTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="building_type", referencedColumnName="ID")
     * })
     */
    private $buildingType;

    /**
     * @var string
     *
     * @ORM\Column(name="architect_drawing", type="string")
     */
    private $architectDrawing;

    /**
     * @var \AppBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project", referencedColumnName="ID")
     * })
     */
    private $project;

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
     * Set building
     *
     * @param string $building
     * @return Building
     */
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Building
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set architectDrawing
     *
     * @param string $architectDrawing
     * @return Building
     */
    public function setArchitectDrawing($architectDrawing)
    {
        $this->architectDrawing = $architectDrawing;

        return $this;
    }

    /**
     * Get architectDrawing
     *
     * @return string
     */
    public function getArchitectDrawing()
    {
        return $this->architectDrawing;
    }

    /**
     * Set buildingType
     *
     * @param \AppBundle\Entity\BuildingType $buildingType
     * @return Building
     */
    public function setBuildingType(\AppBundle\Entity\BuildingTypes $buildingType = null)
    {
        $this->buildingType = $buildingType;

        return $this;
    }

    /**
     * Get buildingType
     *
     * @return \AppBundle\Entity\BuildingType
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     * @return Building
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    public function __toString() {
        return $this->building;
    }
}
