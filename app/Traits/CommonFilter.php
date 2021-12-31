<?php


namespace App\Traits;


use App\Builders\Builder;

trait CommonFilter
{
    /**
     * Filter model by created datetime
     *
     * @param  string|array  $created_at
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function created_at($created_at)
    {
        if (!$this->query instanceof Builder) {
            // TODO: Need fix
            throw new \Exception("Undefined query");
        }

        if (is_string($created_at)) {
            return $this->query->whereEqual('created_at', $created_at);
        }
        return $this->query->whereDateRange('created_at', $created_at);
    }

    /**
     * Filter model by updated datetime
     *
     * @param  string|array  $updated_at
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function updated_at($updated_at)
    {
        if (!$this->query instanceof Builder) {
            // TODO: Need fix
            throw new \Exception("Undefined query");
        }

        if (is_string($updated_at)) {
            return $this->query->whereEqual('updated_at', $updated_at);
        }
        return $this->query->whereDateRange('updated_at', $updated_at);
    }

    /**
     * Filter model by deleted datetime
     *
     * @param  string|array  $deleted_at
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function deleted_at($deleted_at)
    {
        if (!$this->query instanceof Builder) {
            // TODO: Need fix
            throw new \Exception("Undefined query");
        }

        if (is_string($deleted_at)) {
            return $this->query->whereEqual('deleted_at', $deleted_at);
        }
        return $this->query->whereDateRange('deleted_at', $deleted_at);
    }
}
