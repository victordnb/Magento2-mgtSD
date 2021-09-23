<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Model;

use Unit6\ComputerGames\Model\ResourceModel\Game as GameResourceModel;

/**
 * Class Game
 * @package Unit6\ComputerGames\Model
 */
class Game extends \Magento\Framework\Model\AbstractExtensibleModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(GameResourceModel::class);
    }

    /**
     * TODO: Apply attr source model here
     * @return array
     */
    public function getCustomAttributesCodes()
    {
        return array('game_id', 'name', 'type', 'trial_period', 'release_date');
    }
}