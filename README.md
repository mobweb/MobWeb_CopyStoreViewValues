# MobWeb_CopyStoreViewValues extension for Magento

This extension can automatically update attribute values in certain "target" Store Views whenever the attributes are updated in the "source" Store View.

As an example, consider the following Store View setup:

- French (Switzerland)
- French (France)
- English (USA)
- English (UK)
- English (Australia)
- German (Germany)
- German (Switzerland)

Now if you set your default values in French, you'd have to enter the english values (for example the product description) once for each Store View. With this extension you can tell Magento to copy over the product descriptions from the "USA" Store View to the "UK" and "Australia" ones whenever the product description is updated in the "USA" Store View. You can also add another "source" Store View for "Germany", so that the german values are automatically copied over to the "Switzerland" Store View. This can probably save you a lot of work.

## Installation

Install using [colinmollenhour/modman](https://github.com/colinmollenhour/modman/).

## Configuration

You have to update the configuration in the `getConfig` method of the `MobWeb_CopyStoreViewValues_Helper_Data` class, otheriwse nothing will happen.

Also, by default this extension only updates the attribute values when a Configurable Product is changed. If you are working with Simple Products, you may want to comment out the relevant IF condition (`if($product->getTypeId() !== "configurable") {`) in the `catalogProductSaveBefore` method of `MobWeb_CopyStoreViewValues_Model_Observer`.

## Questions? Need help?

Most of my repositories posted here are projects created for customization requests for clients, so they probably aren't very well documented and the code isn't always 100% flexible. If you have a question or are confused about how something is supposed to work, feel free to get in touch and I'll try and help: [info@mobweb.ch](mailto:info@mobweb.ch).