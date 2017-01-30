<?php

namespace AppBundle\Entity;

/**
 * Cart
 */
class Cart
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var float
     */
    private $priceWt;
    /**
     * @var array
     */
    private $items;
    /**
     * @var User
     */
    private $user;
    /**
     * @var
     */
    private $endPurchase;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set amount
     *
     * @param string $amount
     *
     * @return Cart
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set priceWt
     *
     * @param float $priceWt
     *
     * @return Cart
     */
    public function setpriceWt($priceWt)
    {
        $this->priceWt = $priceWt;

        return $this;
    }

    /**
     * Get priceWt
     *
     * @return float
     */
    public function getpriceWt()
    {
        return $this->priceWt;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Cart
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return Cart
     */
    public function addItem(\AppBundle\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Item $item
     */
    public function removeItem(\AppBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set endPurchase
     *
     * @param boolean $endPurchase
     *
     * @return Cart
     */
    public function setEndPurchase($endPurchase)
    {
        $this->endPurchase = $endPurchase;

        return $this;
    }

    /**
     * Get endPurchase
     *
     * @return boolean
     */
    public function getEndPurchase()
    {
        return $this->endPurchase;
    }
}
