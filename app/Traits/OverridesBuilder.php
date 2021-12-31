<?php


namespace App\Traits;


trait OverridesBuilder
{
    /**
     * @inheritDoc
     */
    public function newEloquentBuilder($query)
    {
        $class = $this->getCustomBuilderClass();
        if (class_exists($class)) {
            return new $class($query);
        }
        return parent::newEloquentBuilder($query);
    }

    /**
     * Get query builder class name
     * @return string
     */
    private function getCustomBuilderClass()
    {
        return method_exists($this, 'provideCustomBuilder') ? $this->provideCustomBuilder() : null;
    }
}
