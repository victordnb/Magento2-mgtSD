<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Ui\Component\Options;

/**
 * Class TrialPeriods
 * @package Unit6\ComputerGames\Ui\Component\Form
 */
class TrialPeriods implements \Magento\Framework\Data\OptionSourceInterface
{
    const TRIAL_PERIODS = [
        ['label' => 'No', 'value' => '0'],
        ['label' => 'Month', 'value' => '1'],
        ['label' => '2 Months', 'value' => '2'],
        ['label' => '6 Months', 'value' => '6'],
        ['label' => 'Year', 'value' => '12']
    ];

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        $this->options = self::TRIAL_PERIODS;
        return $this->options;
    }
}
