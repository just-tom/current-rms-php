<?php

namespace CurrentRms\Resources;

use CurrentRms\CurrentRms;

class Products extends ResourceAbstract
{
    const URI_PRODUCT = 'products/%d';
    const URI_PRODUCTS = 'products';
    const URI_PRODUCT_INVENTORY = 'products/inventory/';

    /**
     * @param int $id
     *
     * @return object
     */
    public function getProduct($id)
    {
        $resource = sprintf(self::URI_PRODUCT, $id);
        $this->sendRequest($resource, array(), CurrentRms::GET);
        return $this->getResponse();
    }

    /**
     * @return object
     */
    public function getProducts()
    {
        $this->sendRequest(Products::URI_PRODUCTS, array(), CurrentRms::GET);
        return $this->getResponse();
    }

    /**
     * @param int   $id
     * @param array $productData
     *
     * @return object
     */
    public function updateProduct($id, array $productData)
    {
        $data = ['json' => $productData];
        $resource = sprintf(self::URI_PRODUCT, $id);
        $this->sendRequest($resource, $data, CurrentRms::PUT);
        return $this->getResponse();
    }

    /**
     * @param array $productData
     *
     * @return object
     */
    public function createProduct(array $productData)
    {
        $data = ['json' => $productData];
        $this->sendRequest(self::URI_PRODUCTS, $data, CurrentRms::POST);
        return $this->getResponse();
    }

    /**
     * @return object
     */
    public function getProductInventories()
    {
        $this->sendRequest(self::URI_PRODUCT_INVENTORY, array(),
            CurrentRms::GET);
        return $this->getResponse();
    }
}