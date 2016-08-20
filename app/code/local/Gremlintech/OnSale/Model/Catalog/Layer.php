<?php

class Gremlintech_OnSale_Model_Catalog_Layer extends Mage_Catalog_Model_Layer
{
    public function getProductCollection()
    {

        if (isset($this->_productCollections[$this->getCurrentCategory()->getId()])) {
            $collection = $this->_productCollections[$this->getCurrentCategory()->getId()];
        } else {

            $collection = Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToSelect('*');

            $todayDate = date('m/d/y');
            $tomorrow = mktime(0, 0, 0, date('m'), date('d'), date('y'));
            $tomorrowDate = date('m/d/y', $tomorrow);

            /**$collection->addFieldToFilter('special_from_date', array('or'=> array(
                0 => array('date' => true, 'from' => $tomorrowDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ))
                ->addFieldToFilter('special_to_date', array('or'=> array(
                    0 => array('date' => true, 'from' => $tomorrowDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
            ;**/

            $collection->addPriceDataFieldFilter('%s < %s', ['final_price', 'price']);
            $this->prepareProductCollection($collection);
            $this->_productCollections[$this->getCurrentCategory()->getId()] = $collection;
}
        return $collection;


    }
}