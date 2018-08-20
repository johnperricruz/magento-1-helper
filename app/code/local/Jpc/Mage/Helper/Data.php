<?php

class Jpc_Mage_Helper_Data extends Mage_Core_Helper_Abstract{
	
	/**
	 * Everything is worth a test :)
	 *  <?php echo Mage::helper('Jpc_Mage')->debug(); ?>
	 */
	function debug(){
		return 'Jpc Mage helper Class is connected.';
	}
	
	/**
	 * Custom Functions Here
	 */
	function getStaticBlock($_this,$identifier){
		//Mage::helper('Jpc_Mage')->getStaticBlock($this,'left')
		return $_this->getLayout()->createBlock('cms/block')->setBlockId($identifier)->toHtml();
	}
	function getSkinImageUrl($location){
		////Mage::helper('Jpc_Mage')->getSkinUrl('folder/logo.png')
		return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'/frontend/rwd/rocket/images/'.$location;
	}
	function getRevSlider($_this,$identifier){
		//Mage::helper('Jpc_Mage')->getRevSlider($this,'homepage-slider') 
		return $_this->getLayout()->createBlock('nwdrevslider/revslider')->setAlias($identifier)->toHtml();
	}
	function getProductsInCategory($cat_id){
		//Mage::helper('Jpc_Mage')->getProductsInCategory(1) 
		$category_model = Mage::getModel('catalog/category')->load($category_id);    
		$collection = Mage::getResourceModel('catalog/product_collection');
		$collection->addCategoryFilter($category_model);  							 
		$collection->addAttributeToFilter('status',1);                              
		$collection->addAttributeToFilter('visibility',4); 
		$collection->addAttributeToSelect(array('description','name','url','small_image','price')); 
		//$collection->getSelect()->order('rand()');                                 
		$collection->addStoreFilter(); 
		return $collection; 
	}
	public function getProductImageUrl($prod,$size){
		//Mage::helper('Jpc_Mage')->getProductImageUrl($prod,$size = 200) 
		return Mage::helper('catalog/image')->init($prod, 'small_image')->resize($size);
	}
} 