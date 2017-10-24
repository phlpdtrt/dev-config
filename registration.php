<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * @category   PhlpDtrt
 * @package    DevConfig
 * @author     Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright  Copyright (c) 2017 Philipp Dittert <philipp.dittert@gmail.com>
 * @link       https://github.com/phlpdtrt/dev-config
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'PhlpDtrt_DevConfig',
    __DIR__
);
