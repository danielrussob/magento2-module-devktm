<?php

namespace DNAFactory\DevKtm\Generator;

use Magento\Framework\Filesystem\Directory\ReadFactory as DirectoryReaderFactory;
use Magento\Framework\Filesystem\Directory\WriteFactory as DirectoryWriterFactory;
use Magento\Framework\Filesystem\DirectoryList as FilesystemDirectoryList;
use Magento\Framework\Filesystem\Io\File as FilesystemIoFile;
use Magento\Framework\Module\Dir\Reader as ModuleReader;
use Magento\Framework\Module\Manager as ModuleManager;

use Magento\Framework\Xml\Generator as XmlGenerator;
use Magento\Framework\Xml\Parser as XmlParser;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractGenerator
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var FilesystemDirectoryList
     */
    protected $directoryList;

    /**
     * @var FilesystemIoFile
     */
    protected $ioFile;

    /**
     * @var ModuleReader
     */
    protected $moduleReader;

    /**
     * @var ModuleManager
     */
    protected $moduleManager;

    /**
     * @var DirectoryReaderFactory
     */
    protected $directoryReaderFactory;

    /**
     * @var DirectoryWriterFactory
     */
    protected $directoryWriterFactory;

    /**
     * @var XmlParser
     */
    protected $xmlParser;

    /**
     * @var XmlGenerator
     */
    protected $xmlGenerator;

    protected $moduleName;

    protected $devKtmPath;
    protected $modulePath;
    protected $magentoRootPath;
    protected $magentoAppPath;
    protected $magentoAppCodePath;

    public function __construct(
        FilesystemDirectoryList $directoryList,
        FilesystemIoFile $ioFile,
        ModuleReader $moduleReader,
        ModuleManager $moduleManager,
        DirectoryReaderFactory $directoryReaderFactory,
        DirectoryWriterFactory $directoryWriterFactory,
        XmlParser $xmlParser,
        XmlGenerator $xmlGenerator
    ) {

        $this->directoryList = $directoryList;
        $this->ioFile = $ioFile;
        $this->moduleReader = $moduleReader;
        $this->moduleManager = $moduleManager;
        $this->directoryReaderFactory = $directoryReaderFactory;
        $this->directoryWriterFactory = $directoryWriterFactory;
        $this->xmlParser = $xmlParser;
        $this->xmlGenerator = $xmlGenerator;
    }

    abstract protected function _generate();

    final public function generate()
    {
        $this->beforeGenerate();
        $this->_generate();
        $this->afterGenerate();
    }

    protected function beforeGenerate()
    {
        $this->devKtmPath = $this->moduleReader->getModuleDir('', 'DNAFactory_DevKtm');

        $this->magentoRootPath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::ROOT);
        $this->magentoAppPath = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::APP);
        $this->magentoAppCodePath = $this->magentoAppPath . '/code';

        try {
            $this->modulePath = $this->moduleReader->getModuleDir('', $this->getModuleName());
        } catch (\Exception $e) {
            $this->modulePath = $this->magentoAppCodePath . '/' . str_replace("_", '/', $this->getModuleName());
            $this->ioFile->mkdir($this->modulePath, 0777, true);
        }
    }

    protected function afterGenerate()
    {

    }

    public function setIO(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

    protected function getTemplate($stubName, $search = [], $replace = [])
    {
        $template = str_replace($search, $replace, $this->getStub($stubName));
        return $template;
    }

    protected function getStub($name)
    {
        $directoryReader = $this->directoryReaderFactory->create($this->devKtmPath . '/stubs');
        $content = $directoryReader->readFile($name . ".stub");
        return $content;
    }

    protected function putTemplate($content, $filename)
    {
        $filename = str_replace("\\", "/", $filename);

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath);
        if ($directoryReader->isExist($filename)) {
            $this->output->writeln('<error>' . __("File %1 already exist", $this->modulePath.'/'.$filename) . '</error>');
        } else {
            $directoryWriter = $this->directoryWriterFactory->create($this->modulePath);
            $directoryWriter->writeFile($filename, $content);
            $this->output->writeln('<info>' . __("File %1 generated", $this->modulePath.'/'.$filename) . '</info>');
        }
    }

    protected function convertFullClassNameInXmlName($fullClassName)
    {
        $xmlName = strtolower($fullClassName);
        $xmlName = str_replace("\\", "_", $xmlName);
        return $xmlName;
    }

    /**
     * Get Class name for a given full class name
     * Model\Product\Info => Info
     * @param $name
     * @return 0|array
     */
    protected function getClassName($name)
    {
        $className = explode('\\', $name);
        return end($className);
    }

    /**
     * Get the full namespace for a given class by Module, without the class name
     * Model/Product => Vendor\Module\Model
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return $this->getRootNamespace() . "\\" . trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Get Root Namespace of module Vendor_Module => Vendor\Module
     * @return string
     */
    protected function getRootNamespace()
    {
        return str_replace("_", "\\", $this->getModuleName());
    }
}
