<?php

namespace DNAFactory\DevKtm\Command\Clean;

use Magento\Framework\Filesystem\DirectoryList as FilesystemDirectoryList;
use Magento\Framework\Filesystem\Io\File as FilesystemIoFile;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class CleanStaticFoldersCommand extends AbstractCleanerCommand
{
    protected $name = "dna:clean:static-folders";
    protected $description = "Clean all pub folders for dev";

    protected function _clean()
    {
        $this->cleanPubStatic();
    }
}
