<?php

namespace App\Services;


use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeServices
{
    /**
     * Add attribute.
     * @param $data
     * @return string
     */
    public function addAttributre($data)
    {
        $attribute = Attribute::find($data['attribute_id']);

        $attribute->attribute_values()->create([
            'attr_value' => $data['attr_value']
        ]);

        return 'Add "'.$data['attr_value'].'" successful';
    }

    /**
     * Get attributes.
     * @param $idType
     * @return mixed
     */
    public function getAttributeByType($idType)
    {
        $attribute = Attribute::find($idType);

        return $attribute->attribute_values;
    }

    public function getAttributeValues()
    {
        return AttributeValue::all();
    }
}