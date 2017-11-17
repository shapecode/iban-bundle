<?php

namespace Shapecode\Bundle\IbanBundle\Command;

use Shapecode\Bundle\IbanBundle\Iban\IbanApiInterface;
use Symfony\Component\Console\Command\Command;
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
class GenerateIbanCommand extends Command
{

    /** @var IbanApiInterface */
    protected $iban;

    /**
     * @param IbanApiInterface $iban
     */
    public function __construct(IbanApiInterface $iban)
    {
        $this->iban = $iban;

        parent::__construct();
    }

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

        $iban = $this->iban->generateIban($countryCode, $bankIdentification, $accountNr);
        $bic = $this->iban->generateBic($iban);

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
