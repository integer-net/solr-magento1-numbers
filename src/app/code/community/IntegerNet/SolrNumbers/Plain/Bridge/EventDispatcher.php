<?php
/**
 * integer_net Magento Module
 *
 * @category   IntegerNet
 * @package    IntegerNet_SolrNumbers
 * @copyright  Copyright (c) 2019 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */
namespace IntegerNet\SolrSuggest\Plain\Bridge;

use IntegerNet\Solr\Implementor\EventDispatcher;

/**
 * This class replaces the default NullEventDispatcher which is just a dummy. We used to to actually observe events.
 */
class NullEventDispatcher implements EventDispatcher
{
    /**
     * Dispatch event
     *
     * @param string $eventName
     * @param array $data
     * @return void
     */
    public function dispatch($eventName, array $data = array())
    {
        switch ($eventName) {
            case 'integernet_solr_update_query_text':
                $this->dispatchUpdateQueryTextEvent($data);
                return;
        }
    }

    /**
     * Adjust the query text which is being sent to Solr.
     *
     * @param array $data
     */
    private function dispatchUpdateQueryTextEvent(array $data)
    {
        $transportObject = $data['transport'];

        require_once 'app/code/community/IntegerNet/SolrNumbers/Model/CharacterMapping.php';

        /** @var \IntegerNet_SolrNumbers_Model_CharacterMapping $characterMapping */
        $characterMapping = new \IntegerNet_SolrNumbers_Model_CharacterMapping();

        $transportObject->setData('query_text', $characterMapping->getUpdatedString($transportObject->getData('query_text')));
    }
}