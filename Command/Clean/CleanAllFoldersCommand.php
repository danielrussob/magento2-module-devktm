<?php

namespace DNAFactory\DevKtm\Command\Clean;

use Magento\Framework\Filesystem\DirectoryList as FilesystemDirectoryList;
use Magento\Framework\Filesystem\Io\File as FilesystemIoFile;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class CleanAllFoldersCommand extends AbstractCleanerCommand
{
    protected $name = "dna:clean:all-folders";
    protected $description = "Clean all folders for dev";

    protected function _clean()
    {
        $this->cleanGenerated();
        $this->cleanVar();
        $this->cleanPubStatic();
    }
}
