<?php

namespace App\Services;


use App\Mail\BookRoom;
use App\Models\Contact;
use App\Models\Option;
use Illuminate\Support\Facades\Mail;

class ContactServices
{
    public function createContact($dataRequest)
    {
        $dataRequest['content'] = "Time checkin - checkout: " . $dataRequest['date']
            . "\r\nAdult: " . $dataRequest['numberAdult']
            . "\r\nChild: " . $dataRequest['numberChild']
            . "\r\nRoom: " . $dataRequest['room']
            . "\r\niStay: " . $dataRequest['istay'];

        $contact = Contact::create($dataRequest);

        $email = Option::where('key', 'email')->where('lang', config('const.lang.en.alias'))
            ->first();

        if ($email) {
            Mail::to($email->value)
                ->send(new BookRoom($contact));
        }

        return trans('messages.book_success', ['name' => $dataRequest['name']]);
    }
}