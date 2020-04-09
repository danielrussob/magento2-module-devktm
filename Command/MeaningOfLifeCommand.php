<?php

namespace DNAFactory\DevKtm\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class MeaningOfLifeCommand extends AbstractCommand
{
    protected $name = "dna:meaning-of-life";
    protected $description = "What is the meaning of life?";

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("I'm a dumb code generator...");
        $output->writeln("But we are hiring (www.dnafactory.it) and togheter we can found it...");
        $output->writeln("...no, it's a joke, we can't found it, but we can hire you");
    }
}
