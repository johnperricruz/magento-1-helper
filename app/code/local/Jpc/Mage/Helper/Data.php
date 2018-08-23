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
	/**
	 * Cart
	 */
	function getCartItems(){
		//Mage::helper('Jpc_Mage')->getCartItems();
		//$this->getProduct()->getName()
		return Mage::getModel('checkout/cart')->getQuote()->getAllItems();
	}
	function isCart(){
		//Mage::helper('Jpc_Mage')->isCart() 
		if (Mage::app()->getFrontController()->getAction()->getFullActionName() == 'checkout_cart_index') {
			return true;
		} 
		return false;
	} 
	 
	 
	/**
	 * Product & Category
	 */
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
	
	/**
	 * Utilities
	 */
	function getWishlist(){
		return  Mage::helper('wishlist')->getWishlistItemCollection();
	}
	function isWishlistEmpty(){
		// Mage::helper('Jpc_Mage')->isWishlistEmpty() 
		if(Mage::getSingleton('customer/session')->getWishlistItemCount() >= 1){
			return true;
		}
		return false;
	}
	function strTruncate($str,$limit){
		// Mage::helper('Jpc_Mage')->strTruncate($str,$limit = 50) 
		if(strlen($str) >= $limit){
			return substr($str,0,$limit).'...';
		}
		return $str;
	}
	function getStoreCurrency(){
		// Mage::helper('Jpc_Mage')->getStoreCurrency() 
		return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
	}
	function getFormKey(){
		// Mage::helper('Jpc_Mage')->getFormKey() 
		return Mage::getSingleton('core/session')->getFormKey();
	}	 
} 