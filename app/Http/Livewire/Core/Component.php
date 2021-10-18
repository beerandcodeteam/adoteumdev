<?php

namespace App\Http\Livewire\Core;

use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component as LivewireComponent;
use Livewire\ImplicitRouteBinding;
use Livewire\LifecycleManager;

class Component extends LivewireComponent
{
    public function __invoke(Container $container, mixed $route = null)
    {
        $route = request()->route() ?? $route;

        try {
            $componentParams = (new ImplicitRouteBinding($container))
                ->resolveAllParameters($route, $this);
        } catch (ModelNotFoundException $exception) {
            if ($route->getMissing()) {
                return $route->getMissing()(request());
            }

            throw $exception;
        }
        $manager = LifecycleManager::fromInitialInstance($this)
            ->initialHydrate()
            ->mount($componentParams)
            ->renderToView();

        if ($this->redirectTo) {
            return redirect()->response($this->redirectTo);
        }

        $layoutType = $this->initialLayoutConfiguration['type'] ?? 'component';

        return app('view')->file(base_path('vendor/livewire/livewire/src')."/Macros/livewire-view-{$layoutType}.blade.php", [
            'view' => $this->initialLayoutConfiguration['view'] ?? config('livewire.layout'),
            'params' => $this->initialLayoutConfiguration['params'] ?? [],
            'slotOrSection' => $this->initialLayoutConfiguration['slotOrSection'] ?? [
                'extends' => 'content', 'component' => 'slot',
            ][$layoutType],
            'manager' => $manager,
        ]);
    }
}