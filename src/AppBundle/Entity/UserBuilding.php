<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserBuilding
 *
 * @ORM\Table(name="user_building")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserBuildingRepository")
 *
 */
class UserBuilding
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="ID")
     * })
     */
    private $user;

    /**
     * @var \AppBundle\Entity\Building
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Building")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Building_id", referencedColumnName="ID")
     * })
     */
    private $building;

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
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     * @return UserBuilding
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set building
     *
     * @param \AppBundle\Entity\Building $building
     * @return UserBuilding
     */
    public function setBuilding(\AppBundle\Entity\Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get buildingId
     *
     * @return \AppBundle\Entity\Building
     */
    public function getBuilding()
    {
        return $this->building;
    }
}
