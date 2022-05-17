<?php


class car
{	
    private $title;
	private $id;
    private $price;
	private $quantity;
	private $discount;


    // Constructor
	public function __construct($title, $id, $price, $quantity, $discount) 
	{
		$this->title = $title;
		$this->price = $price;
		$this->id = $id;
		$this->quantity = $quantity;
		$this->discount=$discount;
		
	}
	public function getTitle()
    {
        return $this->title;
    }
	public function getID()
    {
        return $this->id;
    }
	public function getPrice()
    {
        return $this->price;
    }
	public function getQuantity()
    {
        return $this->quantity;
    }
	public function getDiscount()
	{
		return $this->discount;
	}
}
?>