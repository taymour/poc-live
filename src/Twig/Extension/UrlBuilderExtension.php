<?php

namespace App\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UrlBuilderExtension extends AbstractExtension
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly RouterInterface $router
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('build_url', [$this, 'buildUrl']),
        ];
    }

    // Too many route manipulations
    public function buildUrl(array $props = []): string
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            throw new \LogicException("No current request available. Make sure this function is called within a request context.");
        }

        $currentRoute = $request->attributes->get('_route');

        if (!$currentRoute) {
            throw new \LogicException("Unable to determine the current route.");
        }

        $params = $request->attributes->get('_route_params');
        if (str_contains($currentRoute, 'ux_live_component')) {
            $url = $request->headers->get('referer'); // Not sure if it works everytime
            $parsedUrl = parse_url($url);
            $route = $this->router->match($parsedUrl['path']);
            $currentRoute = $route['_route'];

            foreach ($props as $index => $prop) {
                $route[$index] = $prop;
            }

            unset($route['_route']);
            unset($route['_controller']);

            $params = $route;
        }

        return $this->router->generate($currentRoute, $params);
    }
}
