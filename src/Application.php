<?php

namespace App;

if (! defined('ABSPATH')) {
    exit;
}

final class Application
{
    private array $controllers = [];

    /**
     * start
     *
     * @return void
     */
    public function start(): void
    {
        foreach ($this->controllers as $controller) {
            $controller();
        }
    }

    /**
     * addController
     *
     * @param  string $controller
     * @return self
     */
    public function addController(string $controller): self
    {
        if (! class_exists($controller)) {
            throw new \Exception(sprintf("Le controller %s n'existe pas", basename($controller)));
        }

        $classe = new $controller();
        if (! method_exists($classe, '__invoke')) {
            throw new \Exception("La classe " . get_class($classe) .  " n'implémente pas la méthode invoke");
        }

        $this->controllers[] = $classe;

        return $this;
    }
}
