<?php
class Gremlintech_OnSale_Block_Catalog_Product_List extends Mage_Catalog_Block_Product_List
{
    protected function _getProductCollection()
    {
        //parent::_getProductCollection();
        if (is_null($this->_productCollection))
        {
            $layer = $this->getLayer();
            $productCollection = $layer->getProductCollection();
            $this->_productCollection = $productCollection;
        }
        //echo $this->_productCollection->getSelect();
        return $this->_productCollection;
    }
}
			