<?php

namespace DNAFactory\DevKtm\Generator;

class MenuGenerator extends AbstractGenerator
{
    protected $menuName;

    protected function _generate()
    {
        //////////////////////////////////////
        /// etc/adminhtml/menu.xml

        $template = $this->getTemplate(
            'menu/menu.xml',
            ['DummyTableName'],
            [$this->getMenuName()]
        );

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist('db_schema.xml')) {
            $this->putTemplate($template, 'etc/db_schema.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify etc/db_schema.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }
    }

    public function getMenuName()
    {
        return $this->menuName;
    }

    public function setMenuName($menuName)
    {
        $this->menuName = $menuName;
    }
}
