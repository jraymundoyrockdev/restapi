<?php

namespace RestApi\Entity;

/**
 * @Entity @Table(name="vehicles")
 **/
class Vehicle
{
    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string") * */
    protected $name;

    /** @Column(type="string") * */
    protected $engine_displacement;

    /** @Column(type="string") * */
    protected $power;

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
     * @return Vehicle
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
     * Set engineDisplacement
     *
     * @param string $engineDisplacement
     * @return Vehicle
     */
    public function setEngineDisplacement($engineDisplacement)
    {
        $this->engine_displacement = $engineDisplacement;

        return $this;
    }

    /**
     * Get engineDisplacement
     *
     * @return string
     */
    public function getEngineDisplacement()
    {
        return $this->engine_displacement;
    }

    /**
     * Set power
     *
     * @param string $power
     * @return Vehicle
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return string
     */
    public function getPower()
    {
        return $this->power;
    }
}
