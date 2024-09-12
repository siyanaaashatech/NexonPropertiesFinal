<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PropertySearch extends Model
{
    // The model does not need a table, as it's used for search purposes
    protected $table = null;

    /**
     * Scope for filtering by listing type.
     */
    public function scopeListType(Builder $query, $listType)
    {
        return $query->when($listType, function ($q) use ($listType) {
            $q->where('list_type', 'like', "%{$listType}%");
        });
    }

    /**
     * Scope for filtering by property type.
     */
    public function scopePropertyType(Builder $query, $propertyType)
    {
        return $query->when($propertyType, function ($q) use ($propertyType) {
            $q->where('property_type', 'like', "%{$propertyType}%");
        });
    }

    /**
     * Scope for filtering by location.
     */
    public function scopeLocation(Builder $query, $location)
    {
        return $query->when($location, function ($q) use ($location) {
            $q->where('location', 'like', "%{$location}%");
        });
    }

    /**
     * Scope for filtering by price range.
     */
    public function scopePrice(Builder $query, $minPrice, $maxPrice)
    {
        return $query->when($minPrice || $maxPrice, function ($q) use ($minPrice, $maxPrice) {
            if ($minPrice && $maxPrice) {
                $q->whereBetween('price', [$minPrice, $maxPrice]);
            } elseif ($minPrice) {
                $q->where('price', '>=', $minPrice);
            } elseif ($maxPrice) {
                $q->where('price', '<=', $maxPrice);
            }
        });
    }

    /**
     * Scope for filtering by number of bedrooms.
     */
    public function scopeBedroom(Builder $query, $bedroom)
    {
        return $query->when($bedroom, function ($q) use ($bedroom) {
            $q->where('bedroom', $bedroom);
        });
    }

    /**
     * Apply all filters to the query.
     */
    public static function applyFilters($query, $filters)
    {
        return $query
            ->listType($filters['list_type'] ?? null)
            ->propertyType($filters['property_type'] ?? null)
            ->location($filters['location'] ?? null)
            ->price($filters['min_price'] ?? null, $filters['max_price'] ?? null)
            ->bedroom($filters['bedroom'] ?? null);
    }
}
