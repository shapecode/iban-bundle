<?php

namespace Shapecode\Bundle\IbanBundle\Command;

use Shapecode\Bundle\IbanBundle\Iban\IbanApiInterface;
use Symfony\Component\Console\Command\Command;
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
class ValidateIbanCommand extends Command
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

        $valid = $this->iban->validateIban($iban);

        $io->title('Validate IBAN: ' . $iban);

        if ($valid) {
            $io->success('IBAN is valid');
        } else {
            $io->error('IBAN is invalid');
        }
    }

}
