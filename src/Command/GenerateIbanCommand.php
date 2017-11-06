<?php

namespace Shapecode\Bundle\IbanBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class GenerateIbanCommand
 *
 * @package Shapecode\Bundle\IbanBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class GenerateIbanCommand extends ContainerAwareCommand
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('shapecode:iban:generate');

        $this->addArgument('countryCode', InputArgument::REQUIRED);
        $this->addArgument('bankIdentification', InputArgument::REQUIRED);
        $this->addArgument('accountNr', InputArgument::REQUIRED);
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $countryCode = $input->getArgument('countryCode');
        $bankIdentification = $input->getArgument('bankIdentification');
        $accountNr = $input->getArgument('accountNr');

        $iban = $this->getContainer()->get('shapecode_iban.generator')->generateIban($countryCode, $bankIdentification, $accountNr);
        $bic = $this->getContainer()->get('shapecode_iban.generator')->generateBic($iban);

        $io->title('IBAN Information');

        $io->table(
            [],
            [
                ['IBAN', $iban],
                ['BIC', $bic],
            ]
        );
    }

}
