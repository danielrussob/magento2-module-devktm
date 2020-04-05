<?php

namespace DNAFactory\DevKtm\Generator;

class SeederGenerator extends AbstractGenerator
{
    protected $seederName;

    protected function _generate()
    {
        $objectName = $this->getSeederName();

        //////////////////////////////////////
        /// Setup\Patch\Data\ExampleSeeder.php

        $dummyNamespace = $this->getNamespace('Setup\\Patch\\Data\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;

        $template = $this->getTemplate(
            'seeder/seeder.php',
            ['DummyNamespace', 'DummyClassName'],
            [$dummyNamespace, $className]);
        $this->putTemplate($template, 'Setup/Patch/Data/'.$objectName.'.php');
    }

    public function getSeederName()
    {
        return $this->seederName;
    }

    public function setSeederName($seederName)
    {
        $this->seederName = $seederName;
    }
}
