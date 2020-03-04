<?php

namespace App\Http\Actions;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use Traversable;

trait PreparesDataForService
{
    /**
     * Prepare data for Service.
     *
     * @param  mixed  $data
     */
    public function forService($data, ?string $key = null): array
    {
        if (is_array($data)) {
            if ($key) {
                return [$key => $data];
            }

            return $data;
        } elseif ($data instanceof Enumerable) {
            if ($key) {
                return [$key => $data->all()];
            }

            return $data->all();
        } elseif ($data instanceof Arrayable) {
            if ($key) {
                return [$key => $data->toArray()];
            }

            return $data->toArray();
        } elseif ($data instanceof Jsonable) {
            if ($key) {
                return [$key => json_decode($data->toJson(), true)];
            }

            return json_decode($data->toJson(), true);
        } elseif ($data instanceof JsonSerializable) {
            if ($key) {
                return [$key => (array) $data->jsonSerialize()];
            }

            return (array) $data->jsonSerialize();
        } elseif ($data instanceof Traversable) {
            if ($key) {
                return [$key => iterator_to_array($data)];
            }

            return iterator_to_array($data);
        }


        if ($key) {
            return [$key => (array) $data];
        }

        return (array) $data;
    }
}
