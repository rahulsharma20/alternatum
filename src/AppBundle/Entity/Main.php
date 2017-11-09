<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Main
 *
 * @ORM\Table(name="Main")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MainRepository")
 * @Vich\Uploadable
 *
 */
class Main
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
     * @var \AppBundle\Entity\Building
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Building")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Building", referencedColumnName="ID")
     * })
     */
    private $building;

    /**
     * @var \AppBundle\Entity\Level
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Level")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Level", referencedColumnName="ID")
     * })
     */
    private $level;

    /**
     * @var \AppBundle\Entity\RoomNo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RoomNo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RoomNo", referencedColumnName="ID")
     * })
     */
    private $roomNo;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string")
     */
    private $description;

    /**
     * @var \AppBundle\Entity\DorR
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DorR")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DorR", referencedColumnName="ID")
     * })
     */
    private $dorR;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="photo", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="string")
     */
    private $photo;

    /**
     *
     * @var integer
     */
    private $imageSize;

    /**
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \AppBundle\Entity\Responsible
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Responsible")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Responsible", referencedColumnName="ID")
     * })
     */
    private $responsible;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User", referencedColumnName="ID")
     * })
     */
    private $user;

    /**
     * @var datetime
     *
     * @ORM\Column(name="DueDate", type="datetime")
     */
    private $dueDate;

    /**
     * @var datetime
     *
     * @ORM\Column(name="InspectionDate", type="datetime")
     */
    private $inspectionDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="Complete", type="integer")
     */
    private $complete;

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
     * Set description
     *
     * @param string $description
     * @return Main
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
     * Set photo
     *
     * @param string $photo
     * @return Main
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Main
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set inspectionDate
     *
     * @param \DateTime $inspectionDate
     * @return Main
     */
    public function setInspectionDate($inspectionDate)
    {
        $this->inspectionDate = $inspectionDate;

        return $this;
    }

    /**
     * Get inspectionDate
     *
     * @return \DateTime
     */
    public function getInspectionDate()
    {
        return $this->inspectionDate;
    }

    /**
     * Set complete
     *
     * @param integer $complete
     * @return Main
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * Get complete
     *
     * @return integer
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * Set building
     *
     * @param \AppBundle\Entity\Building $building
     * @return Main
     */
    public function setBuilding(\AppBundle\Entity\Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return \AppBundle\Entity\Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set level
     *
     * @param \AppBundle\Entity\Level $level
     * @return Main
     */
    public function setLevel(\AppBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \AppBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set roomNo
     *
     * @param \AppBundle\Entity\RoomNo $roomNo
     * @return Main
     */
    public function setRoomNo(\AppBundle\Entity\RoomNo $roomNo = null)
    {
        $this->roomNo = $roomNo;

        return $this;
    }

    /**
     * Get roomNo
     *
     * @return \AppBundle\Entity\RoomNo
     */
    public function getRoomNo()
    {
        return $this->roomNo;
    }

    /**
     * Set dorR
     *
     * @param \AppBundle\Entity\DorR $dorR
     * @return Main
     */
    public function setDorR(\AppBundle\Entity\DorR $dorR = null)
    {
        $this->dorR = $dorR;

        return $this;
    }

    /**
     * Get dorR
     *
     * @return \AppBundle\Entity\DorR
     */
    public function getDorR()
    {
        return $this->dorR;
    }

    /**
     * Set responsible
     *
     * @param \AppBundle\Entity\Responsible $responsible
     * @return Main
     */
    public function setResponsible(\AppBundle\Entity\Responsible $responsible = null)
    {
        $this->responsible = $responsible;

        return $this;
    }

    /**
     * Get responsible
     *
     * @return \AppBundle\Entity\Responsible
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     * @return Main
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
}
