<?php

namespace Sms\Controller;

use Sms\Helper\Phone;
use Sms\Model\Blacklist;
use Sms\Model\BlacklistQuery;

class BlacklistController extends LayoutController
{
    public function get()
    {
        $phone = $this->f('phone');
        $phone = Phone::sanitize($phone);

        if (!$phone) {
            $this->forward('error', 'pageNotFound', ["Phone is invalid"]);
        }

        $blacklist = BlacklistQuery::create()
            ->filterByPhone($phone)
            ->findOne();

        if (!$blacklist) {
            $this->forward('error', 'pageNotFound', ["Phone was not found in the blacklist"]);
        }

        $this->setContent([
            'blacklist' => [
                'phone' => $blacklist->getPhone(),
                'created_at' => $blacklist->getCreatedAt('Y-m-d H:i:s'),
            ]
        ]);
    }

    public function post()
    {
        $phone = $this->f('phone');
        $phone = Phone::sanitize($phone);

        $this->validateNotEmpty($phone, 'phone');

        try {
            $blacklist = new Blacklist();
            $blacklist->setPhone($phone);
            $blacklist->save();
        } catch (\Throwable $e) {

        }
    }

    public function delete()
    {
        $phone = $this->f('phone');
        $phone = Phone::sanitize($phone);

        if (!$phone) {
            $this->forward('error', 'pageNotFound', ["Phone is invalid"]);
        }

        BlacklistQuery::create()
            ->filterByPhone($phone)
            ->delete();
    }
}
