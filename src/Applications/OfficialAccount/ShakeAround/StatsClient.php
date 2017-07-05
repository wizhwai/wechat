<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Applications\OfficialAccount\ShakeAround;

use EasyWeChat\Kernel\BaseClient;

/**
 * Class StatsClient.
 *
 * @author    allen05ren <allen05ren@outlook.com>
 */
class StatsClient extends BaseClient
{
    /**
     * Fetch statistics data by deviceId.
     *
     * @param array $deviceIdentifier
     * @param int   $beginDate        (Unix timestamp)
     * @param int   $endDate          (Unix timestamp)
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Support\Collection|array|object|string
     */
    public function deviceSummary(array $deviceIdentifier, $beginDate, $endDate)
    {
        $params = [
            'device_identifier' => $deviceIdentifier,
            'begin_date' => $beginDate,
            'end_date' => $endDate,
        ];

        return $this->httpPostJson('shakearound/statistics/device', $params);
    }

    /**
     * Fetch all devices statistics data by date.
     *
     * @param int $timestamp
     * @param int $pageIndex
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Support\Collection|array|object|string
     */
    public function batchDeviceSummary($timestamp, $pageIndex)
    {
        $params = [
            'date' => $timestamp,
            'page_index' => $pageIndex,
        ];

        return $this->httpPostJson('shakearound/statistics/devicelist', $params);
    }

    /**
     * Fetch statistics data by pageId.
     *
     * @param int $pageId
     * @param int $beginDate (Unix timestamp)
     * @param int $endDate   (Unix timestamp)
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Support\Collection|array|object|string
     */
    public function pageSummary($pageId, $beginDate, $endDate)
    {
        $params = [
            'page_id' => $pageId,
            'begin_date' => $beginDate,
            'end_date' => $endDate,
        ];

        return $this->httpPostJson('shakearound/statistics/page', $params);
    }

    /**
     * Fetch all pages statistics data by date.
     *
     * @param int $timestamp
     * @param int $pageIndex
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Support\Collection|array|object|string
     */
    public function batchPageSummary($timestamp, $pageIndex)
    {
        $params = [
            'date' => $timestamp,
            'page_index' => $pageIndex,
        ];

        return $this->httpPostJson('shakearound/statistics/patelist', $params);
    }
}