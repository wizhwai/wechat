<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\OpenPlatform\Server;

use EasyWeChat\Kernel\Traits\Observable;
use EasyWeChat\OfficialAccount\Server\Guard as BaseGuard;
use EasyWeChat\OpenPlatform\Server\Handlers\Authorized;
use EasyWeChat\OpenPlatform\Server\Handlers\Unauthorized;
use EasyWeChat\OpenPlatform\Server\Handlers\UpdateAuthorized;
use EasyWeChat\OpenPlatform\Server\Handlers\VerifyTicketRefreshed;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Guard.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Guard extends BaseGuard
{
    use Observable;

    const EVENT_AUTHORIZED = 'authorized';
    const EVENT_UNAUTHORIZED = 'unauthorized';
    const EVENT_UPDATE_AUTHORIZED = 'updateauthorized';
    const EVENT_COMPONENT_VERIFY_TICKET = 'component_verify_ticket';

    protected function resolve(): Response
    {
        $this->registerHandlers();

        $message = $this->getMessage();

        if (isset($message['InfoType'])) {
            $this->dispatch($message['InfoType'], $message);
        }

        return new Response(static::SUCCESS_EMPTY_RESPONSE);
    }

    protected function registerHandlers()
    {
        $this->on(self::EVENT_AUTHORIZED, Authorized::class);
        $this->on(self::EVENT_UNAUTHORIZED, Unauthorized::class);
        $this->on(self::EVENT_UPDATE_AUTHORIZED, UpdateAuthorized::class);
        $this->on(self::EVENT_COMPONENT_VERIFY_TICKET, VerifyTicketRefreshed::class);
    }
}
