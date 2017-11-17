<?php

namespace Shapecode\Bundle\IbanBundle\Command;

use Shapecode\Bundle\IbanBundle\Iban\IbanGeneratorInterface;
use Symfony\Component\Console\Command\Command;
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
class GenerateBicCommand extends Command
{

    /** @var IbanGeneratorInterface */
    protected $iban;

    /**
     * @param IbanGeneratorInterface $iban
     */
    public function __construct(IbanGeneratorInterface $iban)
    {
        $this->iban = $iban;

        parent::__construct();
    }

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

        $bic = $this->iban->generateBic($iban);

        $output->writeln($bic);
    }

}
