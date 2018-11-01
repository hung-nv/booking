<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends \Eloquent
{
    protected $table = 'services';

    protected $fillable = ['user_id', 'icon'];

    public function servicesContent()
    {
        return $this->hasMany('App\Models\ServicesContent', 'services_id');
    }

    public static function findOriginServicesById($servicesId)
    {
        return self::select([
            'b.name',
            'a.id'
        ])
            ->from('services AS a')
            ->join('services_content AS b', function ($join) {
                $join->on('a.id', '=', 'b.services_id');
                $join->where('b.lang', config('const.lang.en.alias'));
            })
            ->where('a.id', $servicesId)
            ->first();
    }

    public static function getAllServices()
    {
        return self::select([
            'a.*',
            'a.id AS id_content',
            'b.id',
            'b.icon',
            'b.created_at'
        ])
            ->from('services_content AS a')
            ->leftJoin('services AS b', function ($join) {
                $join->on('a.services_id', '=', 'b.id');
            })
            ->get()
            ->toArray();
    }

    public static function findServicesByServicesContentId($servicesContentId)
    {
        return self::select('a.created_at', 'a.icon', 'b.*')
            ->from('services AS a')
            ->join('services_content AS b', function ($join) {
                $join->on('a.id', '=', 'b.services_id');
            })
            ->where('b.id', $servicesContentId)
            ->first();
    }
}
