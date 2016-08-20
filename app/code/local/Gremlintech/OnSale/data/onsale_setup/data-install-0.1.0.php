<?php

$allStores = Mage::app()->getStores();
foreach ($allStores as $_eachStoreId => $val)
{
    $_storeId = Mage::app()->getStore($_eachStoreId)->getId();
    $root_catid = Mage::app()->getStore($_storeId)->getRootCategoryId();

    $parentCategory = Mage::getModel('catalog/category')->load($root_catid);
    $childCategory = Mage::getModel('catalog/category')->getCollection()
        ->addAttributeToFilter('is_active', true)
        ->addIdFilter($parentCategory->getChildren())
        ->addAttributeToFilter('name', 'Sale')
        ->getFirstItem()    // Assuming your category names are unique ??
    ;

    if ($childCategory->getId() == null) {
        $category = new Mage_Catalog_Model_Category();
        $category->setName('Sale');
        $category->setUrlKey('sale');
        $category->setIsActive(1);
        $category->setDisplayMode('PRODUCTS');
        $category->setIsAnchor(1);

        $parentCategory = Mage::getModel('catalog/category')->load($root_catid);
        $category->setPath($parentCategory->getPath());

        $category->save();
        unset($category);
    }
}
