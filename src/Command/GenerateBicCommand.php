<?php

namespace Shapecode\Bundle\IbanBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateBicCommand
 *
 * @package Shapecode\Bundle\IbanBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class GenerateBicCommand extends ContainerAwareCommand
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('shapecode:bic:generate');

        $this->addArgument('iban', InputArgument::REQUIRED);
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iban = $input->getArgument('iban');

        $bic = $this->getContainer()->get('shapecode_iban.generator')->generateBic($iban);

        $output->writeln($bic);
    }

}
