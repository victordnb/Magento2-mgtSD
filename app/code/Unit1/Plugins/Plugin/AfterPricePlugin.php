<?php

namespace Unit1\Plugins\Plugin;

class AfterPricePlugin{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result){
        $result = $result + 0.5;
    }
}

