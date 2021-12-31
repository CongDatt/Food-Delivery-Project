<?php


namespace App\Builders;

use App\Filters\EloquentFilter;
use App\Filters\Filter;
use App\Sorts\Sort;
use Closure;
use Illuminate\Database\Eloquent\Builder as BaseBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Arr;

class Builder extends BaseBuilder implements EloquentFilter
{
    /**
     * @param  Filter  $filter
     * @return Builder
     */
    public function filter(Filter $filter)
    {
        return $filter->apply($this);
    }

    /**
     * @param Sort $sort
     * @return Builder
     */
    public function sortBy(Sort $sort)
    {
        return $sort->apply($this);
    }

    /**
     * @param  Closure|string|array  $column
     * @param  string|null  $value
     * @return $this
     */
    public function whereStartsWith($column, $value = null)
    {
        $this->where($column, 'like', $value.'%');
        return $this;
    }

    /**
     * @param  Closure|string|array  $column
     * @param  string|null  $value
     * @return $this
     */
    public function whereEndsWith($column, $value = null)
    {
        $this->where($column, 'like', '%'.$value);
        return $this;
    }

    /**
     * @param  Closure|string|array  $column
     * @param  string|null  $value
     * @return $this
     */
    public function whereLike($column, $value = null)
    {
        $this->where($column, 'like', '%'.$value.'%');
        return $this;
    }

    /**
     * @param  Closure|string|array  $column
     * @param  string|null  $value
     * @return $this
     */
    public function whereEqual($column, $value = null)
    {
        $this->where($column, '=', $value);
        return $this;
    }

    /**
     * @param  Closure|string|array  $column
     * @param  string|null  $value
     * @return $this
     */
    public function whereNotEqual($column, $value = null)
    {
        $this->where($column, '<>', $value);
        return $this;
    }

    /**
     * @param  string  $column
     * @param  array  $value
     * @return Builder
     */
    public function whereDateRange($column, array $value = [])
    {
        $from = Arr::get($value, 'from', '');
        $to = Arr::get($value, 'to', '');
        $this->query->where(function (QueryBuilder $query) use ($column, $from, $to) {
            return $query
                ->when($from, function (QueryBuilder $query) use ($column, $from) {
                    return $query->where($column, '>=', $from);
                })
                ->when($to, function (QueryBuilder $query) use ($column, $to) {
                    return $query->where($column, '<=', $to);
                });
        });
        return $this;
    }
}
