<?php

namespace EcoOnline\ContactManagerApi\v1\Models;

use EcoOnline\ContactManagerApi\Database\Factories\ContactFactory;
use EcoOnline\UserApi\v1\Domain\User\Models\User as UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package EcoOnline\ContactManagerApi
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property string $linkedin_url
 * @property string $country
 * @property string $city
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */

class Contact extends Model
{
    use HasFactory;

    protected $table = "public.contacts";

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'linkedin_url',
        'country',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }

    /**
     * Queries for the contacts owned by the authenticated user
     */
    public function scopeWhereOwns($query)
    {
        return $query->where('user_id', auth()->id());
    }

    /**
     * Filters the query based on the given querystring
     */
    public function scopeSearch($query, $queryString = null)
    {
        if ($queryString) {
            return $query->where('email', 'LIKE', '%' . $queryString . '%')
                ->orWhere('first_name', 'LIKE', '%' . $queryString . '%')
                ->orWhere('last_name', 'LIKE', '%' . $queryString . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $queryString . '%')
                ->orWhere('linkedin_url', 'LIKE', '%' . $queryString . '%')
                ->orWhere('country', 'LIKE', '%' . $queryString . '%')
                ->orWhere('city', 'LIKE', '%' . $queryString . '%');
        }

        return $query;
    }

    /**
     * Sorts the query based on the given column and direction
     */
    public function scopeSort($query, $request)
    {
        if ($request->get('sort_column')) {
            return $query->orderBy($request->get('sort_column'), $request->get('sort_direction', 'DESC'));
        }

        return $query;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }
}
