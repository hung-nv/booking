<?php

namespace App\Services;


use App\Models\Contact;

class ContactServices
{
    public function createContact($dataRequest)
    {
        $dataRequest['content'] = "Thời gian: " . $dataRequest['date']
            . "\nNgười lớn: " . $dataRequest['numberAdult']
            . "\nTrẻ em: " . $dataRequest['numberChild'];

        Contact::create($dataRequest);

        return trans('messages.book_success', ['name' => $dataRequest['name']]);
    }
}