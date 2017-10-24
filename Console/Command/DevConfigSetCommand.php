<?php declare(strict_types=1);

/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace PhlpDtrt\DevConfig\Console\Command;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State as AppState;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;

/**
 * @category   PhlpDtrt
 * @package    DevConfig
 * @subpackage Console
 * @author     Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright  Copyright (c) 2017 Philipp Dittert <philipp.dittert@gmail.com>
 * @link       https://github.com/PhlpDtrt/DevConfig
 */

class DevConfigSetCommand extends Command
{
    /**
     * @var ConfigInterface
     */
    protected $_configInterface;

    /**
     * @var AppState
     */
    protected $appState;

    /**
     * @var string
     */
    protected $allowedNamespace = "dev";

    /**
     * DevConfigSetCommand constructor.
     * @param AppState $appState
     * @param ConfigInterface $configInterface
     */
    public function __construct(
        AppState $appState,
        ConfigInterface $configInterface
    ) {
        $this->_configInterface = $configInterface;
        $this->appState = $appState;
        parent::__construct();
    }

    /**
     * Configures the current command.
     */
    public function configure()
    {
        $this->setName('phlpdtrt:dev-config:set');
        $this->setDescription('allows to set any config within "dev" namespace');
        $this->setDefinition([
            new InputArgument(
                "key",
                InputArgument::REQUIRED,
                'config key'
            ),
            new InputArgument(
                "value",
                InputArgument::REQUIRED,
                'config value'
            )
        ]);

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->appState->setAreaCode('adminhtml');

            $key = $this->validateNamespace($input->getArgument("key"));
            $value = $input->getArgument("value");

            $this->_configInterface->saveConfig(
                "{$key}",
                "{$value}",
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
                0
            );
        } catch (\Exception $e) {
            $output->write("<error>{$e->getMessage()}</error>");
            $output->writeln("");
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }

    /**
     * validates if the given config key has an allowed namespace
     *
     * @param string $key the config key
     *
     * @return string
     * @throws \Exception
     */
    protected function validateNamespace(string $key)
    {
        $pattern = "/^{$this->allowedNamespace}\//";
        if (!preg_match($pattern, $key)) {
            throw new \Exception("config key '{$key}' has a not allowed namespace");
        }
        return $key;
    }
}
