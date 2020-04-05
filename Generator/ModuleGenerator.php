<?php

namespace DNAFactory\DevKtm\Generator;

class ModuleGenerator extends AbstractGenerator
{
    protected function _generate()
    {
        $rootNamespace = $this->getRootNamespace();
        $jsonRootNamespace = $rootNamespace . '\\';
        $jsonRootNamespace = str_replace('\\', '\\\\', $jsonRootNamespace);

        $moduleName = $this->getModuleName();

        $template = $this->getTemplate('composer.json', ['DummyJsonRootNamespace'], [$jsonRootNamespace]);
        $this->putTemplate($template, 'composer.json');

        $template = $this->getTemplate('registration.php', ['DummyModuleName'], [$moduleName]);
        $this->putTemplate($template, 'registration.php');

        $template = $this->getTemplate('module.xml', ['DummyModuleName'], [$moduleName]);
        $this->putTemplate($template, 'etc/module.xml');
    }
}
