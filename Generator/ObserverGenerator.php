<?php

namespace DNAFactory\DevKtm\Generator;

class ObserverGenerator extends AbstractGenerator
{
    protected $observerName;
    protected $area;
    protected $eventName;

    protected function _generate()
    {
        $objectName = $this->getObserverName();

        //////////////////////////////////////
        /// Observer/ExampleObserver.php

        $dummyNamespace = $this->getNamespace('Observer\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;

        $dummyItemName = $this->convertFullClassNameInXmlName($dummyFullClassName);

        $template = $this->getTemplate(
            'observer/observer.php',
            ['DummyNamespace', 'DummyClassName'],
            [$dummyNamespace, $className]);
        $this->putTemplate($template, 'Observer/'.$objectName.'.php');

        //////////////////////////////////////
        /// etc/[AREA_CODE]/events.xml

        $template = $this->getTemplate(
            'observer/events.xml',
            ['DummyItemName', 'DummyFullClassName', 'DummyEventName'],
            [$dummyItemName, $dummyFullClassName, $this->getEventName()]
        );

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist($this->getAreaFolder() . 'events.xml')) {
            $this->putTemplate($template, 'etc/'.$this->getAreaFolder().'events.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify etc/".$this->getAreaFolder()."events.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }
    }

    public function setObserverName($observerName)
    {
        $this->observerName = $observerName;
    }

    public function getObserverName()
    {
        return $this->observerName;
    }

    public function getAreaFolder()
    {
        $area = $this->getArea();
        if ($area == 'base') {
            return '';
        }

        return $area . '/';
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getEventName()
    {
        return $this->eventName;
    }

    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }
}
