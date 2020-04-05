<?php

namespace DNAFactory\DevKtm\Generator;

class DataPatchGenerator extends AbstractGenerator
{
    protected $patchName;

    protected function _generate()
    {
        $objectName = $this->getPatchName();

        //////////////////////////////////////
        /// Setup\Patch\Data\ExampleSeeder.php

        $dummyNamespace = $this->getNamespace('Setup\\Patch\\Data\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;

        $template = $this->getTemplate(
            'patch/patch.php',
            ['DummyNamespace', 'DummyClassName'],
            [$dummyNamespace, $className]);
        $this->putTemplate($template, 'Setup/Patch/Data/'.$objectName.'.php');
    }

    public function getPatchName()
    {
        return $this->patchName;
    }

    public function setPatchName($patchName)
    {
        $this->patchName = $patchName;
    }
}
