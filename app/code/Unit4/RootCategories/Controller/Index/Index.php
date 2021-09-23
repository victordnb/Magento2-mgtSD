<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit4\RootCategories\Controller\Index;

use \Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Unit4\RootCategories\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
