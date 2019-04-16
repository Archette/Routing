<?php

declare(strict_types=1);

namespace Archette\Routing;

use Doctrine\Common\Persistence\Mapping\Driver\AnnotationDriver;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Rixafy\Routing\Route\Group\RouteGroupFacade;
use Rixafy\Routing\Route\Group\RouteGroupFactory;
use Rixafy\Routing\Route\Group\RouteGroupRepository;
use Rixafy\Routing\Route\RouteFacade;
use Rixafy\Routing\Route\RouteFactory;
use Rixafy\Routing\Route\RouteRepository;

class RoutingExtension extends CompilerExtension
{
    public function beforeCompile()
    {
    	/** @var ServiceDefinition $annotationDriver */
        $annotationDriver = $this->getContainerBuilder()->getDefinitionByType(AnnotationDriver::class);
        $annotationDriver->addSetup('addPaths', [['vendor/rixafy/routing']]);
    }

    public function loadConfiguration()
    {
        $this->getContainerBuilder()->addDefinition($this->prefix('routeFacade'))
            ->setFactory(RouteFacade::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeRepository'))
            ->setFactory(RouteRepository::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeFactory'))
            ->setFactory(RouteFactory::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeGroupFacade'))
            ->setFactory(RouteGroupFacade::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeGroupRepository'))
            ->setFactory(RouteGroupRepository::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeGroupFactory'))
            ->setFactory(RouteGroupFactory::class);
    }
}