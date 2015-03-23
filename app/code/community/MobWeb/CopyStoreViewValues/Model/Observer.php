<?php

class MobWeb_CopyStoreViewValues_Model_Observer
{
	public function catalogProductSaveBefore($observer)
	{
		// Load the helper & config
		$helper = Mage::helper('copystoreviewvalues');
		$config = $helper->getConfig();

		// Load the saved product from the observer
		$event = $observer->getEvent();
		$product = $event->getProduct();
		$productId = $product->getId();
		$productStoreViewId = $product->getStoreId();

		// If the product is not a configurable product, don't do anything
		if($product->getTypeId() !== "configurable") {
			return $observer;
		}

		// Check if the current store view is a "source" store view whose attribute values need to copied
		// to any "target" store views
		if(array_key_exists($productStoreViewId, $config['storeViewRelationships'])) {

			// Loop through the "target" store views and copy the attribute values from the "source" store views
			// over to the "target" store views
			foreach($config['storeViewRelationships'][$productStoreViewId] AS $targetStoreViewId) {

				// Loop through the attributes that need to be copied
				foreach($config['copyAttributes'] AS $sourceAttributeCode) {

					// Get the product's attribute value from the source store view
					$sourceAttributeValue = $product->getData($sourceAttributeCode);

					// If the current attribute uses the default value from the "default values" (Store View 0),
					// it will be empty for the source Store View, so we don't need to update any target Store Views,
					// since they will inherit the values from the "default values" anyway
					if(!$sourceAttributeValue || empty($sourceAttributeValue)) {
						continue;
					}

					// Update the product's attribute value in the target store view
					Mage::getSingleton('catalog/product_action')->updateAttributes(
						array($productId),
						array($sourceAttributeCode => $sourceAttributeValue),
						$targetStoreViewId
					);

					$helper->log(sprintf('Copied value for attribute "%s" from Store View %s to Store View %s: %s', $sourceAttributeCode, $productStoreViewId, $targetStoreViewId, $sourceAttributeValue));
				}
			}
		}

		return $observer;
	}
}