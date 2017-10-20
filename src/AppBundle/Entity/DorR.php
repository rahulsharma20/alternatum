<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DorR
 *
 * @ORM\Table(name="DorR")
 * @ORM\Entity
 */
class DorR
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
     * @ORM\Column(name="DorR", type="string")
     */
    private $dorR;

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
     * Set dorR
     *
     * @param string $dorR
     * @return DorR
     */
    public function setDorR($dorR)
    {
        $this->dorR = $dorR;

        return $this;
    }

    /**
     * Get dorR
     *
     * @return string
     */
    public function getDorR()
    {
        return $this->dorR;
    }

    public function __toString() {
        return $this->dorR;
    }
}
