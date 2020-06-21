<?php

declare(strict_types=1);

namespace Archette\Routing;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Rixafy\Routing\Route\Group\RouteGroupFacade;
use Rixafy\Routing\Route\Group\RouteGroupFactory;
use Rixafy\Routing\Route\Group\RouteGroupRepository;
use Rixafy\Routing\Route\RouteFacade;
use Rixafy\Routing\Route\RouteFactory;
use Rixafy\Routing\Route\RouteRepository;
use Rixafy\Routing\Route\Site\RouteSiteFacade;
use Rixafy\Routing\Route\Site\RouteSiteFactory;
use Rixafy\Routing\Route\Site\RouteSiteRepository;

class RoutingExtension extends CompilerExtension
{
    public function beforeCompile(): void
    {
		if (class_exists('Nettrine\ORM\DI\Helpers\MappingHelper')) {
			\Nettrine\ORM\DI\Helpers\MappingHelper::of($this)
				->addAnnotation('Rixafy\Routing', __DIR__ . '/../../../rixafy/routing');
		} else {
			/** @var ServiceDefinition $annotationDriver */
			$annotationDriver = $this->getContainerBuilder()->getDefinitionByType(MappingDriver::class);
			$annotationDriver->addSetup('addPaths', [['vendor/rixafy/routing']]);
		}
    }

    public function loadConfiguration(): void
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

        $this->getContainerBuilder()->addDefinition($this->prefix('routeSiteFacade'))
            ->setFactory(RouteSiteFacade::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeSiteRepository'))
            ->setFactory(RouteSiteRepository::class);

        $this->getContainerBuilder()->addDefinition($this->prefix('routeSiteFactory'))
            ->setFactory(RouteSiteFactory::class);
    }
}
