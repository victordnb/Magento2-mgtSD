<?php
/**
 *  Copyright © Magento. All rights reserved.
 *  See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Controller\Adminhtml\Game;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use Unit6\ComputerGames\Model\GameFactory;

/**
 * Class Delete
 * @package Unit6\ComputerGames\Controller\Adminhtml\Game
 */
class Delete extends Action
{
    /**
     * @var null|GameFactory
     */
    protected $gameFactory = null;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * Edit constructor.
     */
    public function __construct(Action\Context $context, GameFactory $gameFactory, RedirectFactory $redirectFactory)
    {
        $this->game = $gameFactory->create();
        $this->resultRedirectFactory = $redirectFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     */
    public function execute()
    {
        $entityId = $this->getRequest()->getParam('game_id');

        $this->game->load($entityId);
        if ($this->game->getId()) {
            $this->game->delete();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Unit6_ComputerGames::grid');
    }
}
