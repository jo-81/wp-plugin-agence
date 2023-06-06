<?php

namespace App\Service\Utils;

if (! defined('ABSPATH')) {
    exit;
}

final class ArgumentBuilder
{
    private array $args = [];
    
    /**
     * getArguments
     *
     * @return array
     */
    public function getArguments(): array
    {
        return $this->args;
    }
    
    /**
     * addArguments
     *
     * @param  mixed $args
     * @return self
     */
    public function addArguments(array $args): self
    {
        $this->args = wp_parse_args($args, $this->args);

        return $this;
    }
    
    /**
     * addQueryArguments
     *
     * @param  string $tag
     * @param  array $args
     * @return self
     */
    public function addQueryArguments(string $tag, string $relation, array ...$args): self
    {
        if (! in_array($tag, ['meta_query', 'tax_query'])) {
            throw new \Exception("Le tag {$tag} n'existe pas");
        }

        // Si la clé $tag n'existe pas
        if (! isset($this->args[$tag])) {
            $this->args = wp_parse_args([$tag => array_merge(['relation' => $relation], $args)], $this->args);
        } else {
            $this->args[$tag] = wp_parse_args($args, $this->args[$tag]);
        }

        return $this;
    }

    public function removeQueryArgument(string $tag)
    {
        if (! array_key_exists($tag, $this->args)) {
            return $this;
        }

        unset($this->args[$tag]);

        return $this;
    }
    
    /**
     * query
     *
     * @param  array $args
     * @return self
     */
    public static function query(array $args): self
    {
        return (new self)->addArguments($args);
    }
}