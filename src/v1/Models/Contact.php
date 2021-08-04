<?php

namespace EcoOnline\ContactManagerApi\v1\Models;

use EcoOnline\UserApi\v1\Domain\User\Models\User as UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

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
    public function scopeSearch($query, $request)
    {
        if ($request->has('qs')) {
            $qs = $request->get('qs');

            return $query->where('email', 'LIKE', '%' . $qs . '%')
                ->orWhere('first_name', 'LIKE', '%' . $qs . '%')
                ->orWhere('last_name', 'LIKE', '%' . $qs . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $qs . '%')
                ->orWhere('linkedin_url', 'LIKE', '%' . $qs . '%')
                ->orWhere('country', 'LIKE', '%' . $qs . '%')
                ->orWhere('city', 'LIKE', '%' . $qs . '%');
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
}
