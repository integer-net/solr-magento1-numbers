<?php
/**
 * integer_net Magento Module
 *
 * @copyright  Copyright (c) 2019 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */

class IntegerNet_SolrNumbers_Model_Observer_UpdateSearchQuery extends Mage_Core_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     * @see @event integernet_solr_get_product_data
     */
    public function execute(Varien_Event_Observer $observer)
    {
        /** @var \IntegerNet\Solr\Event\Transport $transportObject */
        $transportObject = $observer->getData('transport');

        /** @var IntegerNet_SolrNumbers_Model_CharacterMapping $characterMapping */
        $characterMapping = Mage::getSingleton('integernet_solr_numbers/characterMapping');

        $transportObject->setData('query_text', $characterMapping->getUpdatedString($transportObject->getData('query_text')));
    }
}