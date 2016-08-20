<?php

class Gremlintech_OnSale_Model_Observer
{
    public function addCategoryNameHandle(Varien_Event_Observer $observer)
    {

        $category = Mage::registry('current_category');

        if (!($category instanceof Mage_Catalog_Model_Category)) {
            return;
        }

        $categoryname = str_replace(' ','_',$category->getname());

        $update = $observer->getEvent()->getLayout()->getUpdate();
        $update->addHandle('category_' . strtolower($categoryname));
    }
}