<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit6\ComputerGames\Controller\Adminhtml\Game;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use Unit6\ComputerGames\Model\GameFactory;

/**
 * Class Save
 * @package Unit6\ComputerGames\Controller\Adminhtml\Game
 */
class Save extends Action
{
    /**
     * @var null|Game
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

        $postData = $this->getRequest()->getParams();
        $gameId = 0;
        if (isset($postData['game_id'])) {
            $gameId = (int)$postData['game_id'];
        }
        
        $this->game->setName($postData['name'])
            ->setReleaseDate($postData['release_date'])
            ->setType($postData['type'])
            ->setTrialPeriod($postData['trial_period']);
        if ($gameId > 0) {
            $this->game->setGameId($gameId);
        }
        $this->game->save();
        $savedGameId = $this->game->getId();

        $returnToEdit = (bool)$this->getRequest()->getParam('back', false);
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($returnToEdit) {
            if ($savedGameId) {
                $resultRedirect->setPath(
                    '*/*/edit',
                    ['game_id' => $savedGameId, '_current' => true]
                );
            } else {
                $resultRedirect->setPath(
                    '*/*/edit',
                    ['_current' => true]
                );
            }
        } else {
            $resultRedirect->setPath('*/*/index');
        }
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
