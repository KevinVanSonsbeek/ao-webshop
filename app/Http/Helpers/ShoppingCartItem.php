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
        }
    }

    /*
     * Get name
     */
    public function get_name() {
        return $this->name;
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
