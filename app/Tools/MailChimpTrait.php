<?php

namespace App\Tools;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Candidate;
use App\Exceptions\SomethingWentWrong;

trait MailChimpTrait
{

    public function createContact(Candidate $candidato)
    {
        if (ENV('MAIL_CHIMP_ENABLE')) {
            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
                'apiKey' => ENV('MAIL_CHIMP_API_KEY'),
                'server' => ENV('MAIL_CHIMP_SERVER')
            ]);

            $list_id = ENV('MAIL_CHIMP_AUDIENCE_ID');

            try {
                $response = $mailchimp->lists->addListMember($list_id, [
                    "email_address" => $candidato->user->email,
                    "status" => "subscribed",
                    "merge_fields" => [
                        "FNAME" => $candidato->name,
                        "LNAME" => $candidato->last_name
                    ]
                ]);
                // print_r($response);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }


    public function subscribeContact(Candidate $candidato)
    {
        if (ENV('MAIL_CHIMP_ENABLE')) {
            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
                'apiKey' => ENV('MAIL_CHIMP_API_KEY'),
                'server' => ENV('MAIL_CHIMP_SERVER')
            ]);

            $list_id = ENV('MAIL_CHIMP_AUDIENCE_ID');

            $subscriberHash = md5(strtolower($candidato->user->email));

            try {
                $response = $mailchimp->lists->updateListMember($listId, $subscriberHash, ["status" => "subscribed"]);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    public function unsubscribeContact(Candidate $candidato)
    {
        if (ENV('MAIL_CHIMP_ENABLE')) {
            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
                'apiKey' => ENV('MAIL_CHIMP_API_KEY'),
                'server' => ENV('MAIL_CHIMP_SERVER')
            ]);

            $list_id = ENV('MAIL_CHIMP_AUDIENCE_ID');

            $subscriberHash = md5(strtolower($candidato->user->email));

            try {
                $response = $mailchimp->lists->updateListMember($listId, $subscriberHash, ["status" => "unsubscribed"]);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    public function tagContact(Candidate $candidato)
    {
        if (ENV('MAIL_CHIMP_ENABLE')) {
            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
                'apiKey' => ENV('MAIL_CHIMP_API_KEY'),
                'server' => ENV('MAIL_CHIMP_SERVER')
            ]);

            $list_id = ENV('MAIL_CHIMP_AUDIENCE_ID');

            $subscriberHash = md5(strtolower($candidato->user->email));

            try {
                $mailchimp->lists->updateListMemberTags($list_id, $subscriberHash, [
                    "tags" => [
                        [
                            "name" => ENV('MAIL_CHIMP_TAG'),
                            "status" => "active"
                        ]
                    ]
                ]);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

}