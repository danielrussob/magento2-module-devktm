<?php

namespace DNAFactory\DevKtm\Command\Clean;

use Magento\Framework\Filesystem\DirectoryList as FilesystemDirectoryList;
use Magento\Framework\Filesystem\Io\File as FilesystemIoFile;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

abstract class AbstractCleanerCommand extends \DNAFactory\DevKtm\Command\AbstractCommand
{
    /**
     * @var FilesystemDirectoryList
     */
    protected $directoryList;

    /**
     * @var FilesystemIoFile
     */
    protected $ioFile;

    /**
     * @var string
     */
    protected $magentoRootPath;
    /**
     * @var string
     */
    protected $magentoGeneratedPath;

    /**
     * @var string
     */
    protected $magentoVarPath;

    /**
     * @var string
     */
    protected $magentoPubPath;

    public function __construct(
        FilesystemDirectoryList $directoryList,
        FilesystemIoFile $ioFile
    ) {
        $this->directoryList = $directoryList;
        $this->ioFile = $ioFile;

        $this->magentoRootPath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::ROOT);
        $this->magentoGeneratedPath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::GENERATED);
        $this->magentoPubPath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::PUB);
        $this->magentoVarPath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR);

        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Clean folders according to: https://devdocs.magento.com/guides/v2.3/howdoi/php/php_clear-dirs.html");
        $this->clean();
    }

    protected function cleanVar()
    {
        $this->ioFile->rmdir($this->magentoVarPath . '/cache', true);
        $this->ioFile->rmdir($this->magentoVarPath . '/page_cache', true);
        $this->ioFile->rmdir($this->magentoVarPath . '/view_preprocessed', true);
    }

    protected function cleanPubStatic()
    {
        $this->ioFile->rmdir($this->magentoPubPath . '/static/frontend', true);
        $this->ioFile->rmdir($this->magentoPubPath . '/static/adminhtml', true);
        $this->ioFile->rm($this->magentoPubPath . '/deployed_version.txt');
    }

    protected function cleanGenerated()
    {
        $this->ioFile->rmdir($this->magentoGeneratedPath . '/code', true);
        $this->ioFile->rmdir($this->magentoGeneratedPath . '/metadata', true);
    }

    final public function clean()
    {
        $this->beforeClean();
        $this->_clean();
        $this->afterClean();
    }

    protected function beforeClean()
    {

    }

    protected function afterClean()
    {

    }

    protected function _clean()
    {

    }
}
