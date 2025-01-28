<?php

namespace App\Repositories;

use App\Models\Location;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LocationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'country',
        'description'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    public function model()
    {
        return Location::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Location
     */
    public function create($input)
    {
        $model = $this->model->newInstance($input);
        $model->save();
        return $model;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return Location
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->fill($input);
        $model->save();
        return $model;
    }

    /**
     * Get list of locations for select dropdown
     *
     * @return \Illuminate\Support\Collection
     */
    public function getLocationsList()
    {
        return $this->model->pluck('name', 'id');
    }

    /**
     * Get locations with professional count
     *
     * @return Collection
     */
    public function getLocationsWithProfessionalCount()
    {
        return Location::withCount('professionals')
            ->orderBy('professionals_count', 'desc')
            ->get();
    }

    /**
     * Find locations by country
     *
     * @param string $country
     * @return Collection
     */
    public function findByCountry($country)
    {
        return $this->model->where('country', $country)->get();
    }

    /**
     * Get top N locations by professional count
     *
     * @param int $limit
     * @return Collection
     */
    public function getTopLocationsByProfessionals($limit = 5)
    {
        return Location::withCount('professionals')
            ->orderBy('professionals_count', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Search locations by name or code
     *
     * @param string $term
     * @return Collection
     */
    public function search($term)
    {
        return $this->model->where('name', 'LIKE', "%{$term}%")
            ->orWhere('code', 'LIKE', "%{$term}%")
            ->get();
    }
}