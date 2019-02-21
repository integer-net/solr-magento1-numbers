<?php

/**
 * integer_net Magento Module
 *
 * @copyright  Copyright (c) 2019 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */
class IntegerNet_SolrNumbers_Model_CharacterMapping
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
     * @param string $string
     * @return string
     */
    public function getUpdatedString($string)
    {
        return str_replace(
            array_keys(self::MAPPING),
            array_values(self::MAPPING),
            $string
        );
    }
}