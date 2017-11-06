<?php

namespace Shapecode\Bundle\IbanBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ValidateIbanCommand
 *
 * @package Shapecode\Bundle\IbanBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ValidateIbanCommand extends ContainerAwareCommand
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('shapecode:iban:validate');

        $this->addArgument('iban', InputArgument::REQUIRED);
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $iban = $input->getArgument('iban');

        $valid = $this->getContainer()->get('shapecode_iban.generator')->validateIban($iban);

        $io->title('Validate IBAN: ' . $iban);

        if ($valid) {
            $io->success('IBAN is valid');
        } else {
            $io->error('IBAN is invalid');
        }
    }

}
