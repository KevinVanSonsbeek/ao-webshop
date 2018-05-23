<?php

namespace App\Http\Helpers;

/**
 * Class ShoppingCartItem
 */
class ShoppingCartItem
{

    protected $name;
    protected $description;
    protected $quantity;
    protected $item_id;
    protected $price;

    /**
     * ShoppingCartItem constructor.
     * @param $item_id
     */
    public function __construct($item_id)
    {
        if(!is_numeric($item_id)) {
            return;
        } else {
            $item_data = \App\Product::where('id', $item_id)->firstorfail();

            $this->name = $item_data->name;
            $this->description = $item_data->description;
            $this->quantity = 1;
            $this->item_id = $item_id;
            $this->price = $item_data->price;
        }
    }

    /*
     * Get name
     */
    public function get_name() {
        return $this->name;
    }

    /*
     * Get price
     */
    public function get_price() {
        return $this->price;
    }

    /*
     * Get total price
     */
    public function get_total_price() {
        return $this->price * $this->quantity;
    }

    /*
     * Get description
     */
    public function get_description() {
        return $this->description;
    }

    /*
     * Get quantity
     */
    public function get_quantity() {
        return $this->quantity;
    }

    /*
     * Set quantity
     */
    public function set_quantity($quantity) {
        $this->quantity = $quantity;
    }

    /*
     * Get item id
     */
    public function get_item_id() {
        return $this->item_id;
    }


}
