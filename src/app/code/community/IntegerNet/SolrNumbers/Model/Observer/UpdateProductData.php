<?php
/**
 * integer_net Magento Module
 *
 * @copyright  Copyright (c) 2019 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */

class IntegerNet_SolrNumbers_Model_Observer_UpdateProductData extends Mage_Core_Model_Observer
{
    const MAPPING = array(
        '1' => 'one',
        '2' => 'two',
        '3' => 'three',
        '4' => 'four',
        '5' => 'five',
        '6' => 'six',
        '7' => 'seven',
        '8' => 'eight',
        '9' => 'nine',
        '0' => 'zero',
        '-' => '',
        '_' => '',
        '/' => '',
    );

    /**
     * @param Varien_Event_Observer $observer
     * @see @event integernet_solr_get_product_data
     */
    public function execute(Varien_Event_Observer $observer)
    {
        /** @var \IntegerNet\Solr\Indexer\IndexDocument $productData */
        $productData = $observer->getData('product_data');

        foreach ($productData as $fieldName => $fieldValue) {
            if ($this->canUpdateField($fieldName)) {
                $productData->setData($fieldName, $this->getUpdatedFieldValue($fieldValue));
            }
        }
    }

    /**
     * @param string|string[] $fieldValue
     * @return string|string[]
     */
    protected function getUpdatedFieldValue($fieldValue)
    {
        if (is_array($fieldValue)) {
            foreach ($fieldValue as $key => $value) {
                $fieldValue[$key] = $this->getUpdatedFieldValue($value);
            }
            return $fieldValue;
        }

        /** @var IntegerNet_SolrNumbers_Model_CharacterMapping $characterMapping */
        $characterMapping = Mage::getSingleton('integernet_solr_numbers/characterMapping');

        return $characterMapping->getUpdatedString($fieldValue);
    }

    /**
     * @param string $fieldName
     * @return bool
     */
    protected function canUpdateField($fieldName)
    {
        return $this->endsWith($fieldName, '_t')
            || $this->endsWith($fieldName, '_t_mv')
            || $this->endsWith($fieldName, '_t_ns')
            || $this->endsWith($fieldName, '_t_ns_mv');
    }

    /**
     * @param string $fieldName
     * @param string $ending
     * @return bool
     */
    protected function endsWith($fieldName, $ending): bool
    {
        return substr($fieldName, -strlen($ending)) == $ending;
    }
}