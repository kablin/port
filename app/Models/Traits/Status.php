<?php


namespace App\Models\Traits;


trait Status
{

	public static $status_available = 'available';

	public static $status_unavailable = 'unavailable';

	public function scopeAvailable($query)
	{
		return $query->where('status', self::$status_available);
	}
}
