<?php

class Gremlintech_OnSale_Block_Catalog_Layer_View extends Mage_Catalog_Block_Layer_View
{
    public function getLayer()
    {
        return Mage::getSingleton('onsale/layer');
    }
}