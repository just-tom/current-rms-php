<?php

namespace CurrentRms\Resources;

use CurrentRms\CurrentRms;

class Accessories extends ResourceAbstract
{
    const URI_PRODUCT_ACCESSORY = 'products/%d/accessories/%d';
    const URI_PRODUCT_ACCESSORIES = 'products/%d/accessories';

    /**
     * @param int $productId
     * @param int $accessoryId
     *
     * @return mixed
     */
    public function getProductAccessory($productId, $accessoryId)
    {
        $resource = sprintf(
            self::URI_PRODUCT_ACCESSORY,
            $productId,
            $accessoryId
        );
        $this->sendRequest($resource, array(), CurrentRms::GET);
        return $this->getResponse();
    }

    /**
     * @param int   $productId
     * @param int   $accessoryId
     * @param array $accessoryData
     *
     * @return mixed
     */
    public function updateProductAccessory(
        $productId,
        $accessoryId,
        array $accessoryData
    ) {
        $data = ['json' => $accessoryData];
        $resource = sprintf(
            self::URI_PRODUCT_ACCESSORY,
            $productId,
            $accessoryId
        );
        $this->sendRequest($resource, $data, CurrentRms::PUT);
        return $this->getResponse();
    }

    /**
     * @param int   $productId
     * @param array $productData
     *
     * @return object
     */
    public function createProductAccessory($productId, array $productData)
    {
        $data = ['json' => $productData];
        $resource = sprintf(
            self::URI_PRODUCT_ACCESSORIES,
            $productId
        );
        $this->sendRequest($resource, $data, CurrentRms::POST);
        return $this->getResponse();
    }

    /**
     * @param int $productId
     *
     * @return object
     */
    public function getProductAccessories($productId)
    {
        $resource = sprintf(
            self::URI_PRODUCT_ACCESSORIES,
            $productId
        );
        $this->sendRequest($resource, array(), CurrentRms::GET);
        return $this->getResponse();
    }
}