<?php

namespace App\Traits;

use App\Builders\Builder;

trait CommonSort
{
    /**
     * Sort model by created datetime
     *
     * @param  string  $direction
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function created_at($direction)
    {
        if (!$this->query instanceof Builder) {
            // TODO: Need fix
            throw new \Exception("Undefined query");
        }

        return $this->query->orderBy('created_at', $direction);
    }

    /**
     * Sort model by updated datetime
     *
     * @param  string  $direction
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function updated_at($direction)
    {
        if (!$this->query instanceof Builder) {
            // TODO: Need fix
            throw new \Exception("Undefined query");
        }

        return $this->query->orderBy('updated_at', $direction);
    }

    /**
     * Sort model by deleted datetime
     *
     * @param  string  $direction
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function deleted_at($direction)
    {
        if (!$this->query instanceof Builder) {
            // TODO: Need fix
            throw new \Exception("Undefined query");
        }

        return $this->query->orderBy('deleted_at', $direction);
    }
}
