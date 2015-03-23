<?php

class MobWeb_CopyStoreViewValues_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig()
	{
		$config = array();

		// Which store view values should be copied to which other store views?
		// Format: "Source ID" => "Target IDs"
		$config['storeViewRelationships']= array(
			// '3' => array('1', '2')
		);

		// Which attribute codes should be copied from the source to the target store view(s)?
		$config['copyAttributes'] = array(
			// 'name',
			// 'description',
			// 'short_description',
		);

		return $config;
	}

	public function log($msg)
	{
		Mage::log($msg, NULL, 'MobWeb_CopyStoreViewValues.log');
	}
}