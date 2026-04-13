<?php

declare(strict_types=1);

namespace WapplerSystems\SaveAndClose\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Loads the SaveAndClose JS module for the contextual record edit view.
 */
final readonly class SaveAndCloseJsLoader implements MiddlewareInterface
{
    public function __construct(
        private PageRenderer $pageRenderer,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $request->getAttribute('route');
        $routePath = $route?->getPath() ?? '';

        if ($routePath === '/record/edit/contextual') {
            $this->pageRenderer->loadJavaScriptModule('@save_and_close/form/backend/SaveAndClose.js');
        }

        return $handler->handle($request);
    }
}