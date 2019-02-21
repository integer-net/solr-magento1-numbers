<?php
/**
 * integer_net Magento Module
 *
 * @category   IntegerNet
 * @package    IntegerNet_SolrNumbers
 * @copyright  Copyright (c) 2019 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */
use IntegerNet\SolrSuggest\Plain\AppConfig;

require_once 'lib/IntegerNet_Solr/Solr/Implementor/EventDispatcher.php';
require_once 'app/code/community/IntegerNet/SolrNumbers/Plain/Bridge/EventDispatcher.php';

return getcwd() . '/autosuggest.config.php';

