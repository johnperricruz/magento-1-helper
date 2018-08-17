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
	 
}