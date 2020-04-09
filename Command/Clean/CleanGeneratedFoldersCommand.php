<?php

namespace DNAFactory\DevKtm\Command\Clean;

use Magento\Framework\Filesystem\DirectoryList as FilesystemDirectoryList;
use Magento\Framework\Filesystem\Io\File as FilesystemIoFile;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class CleanGeneratedFoldersCommand extends AbstractCleanerCommand
{
    protected $name = "dna:clean:generated-folders";
    protected $description = "Clean all generated folders for dev";

    protected function _clean()
    {
        $this->cleanGenerated();
    }
}
