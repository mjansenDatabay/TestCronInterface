<?php declare(strict_types=1);
/* Copyright (c) 1998-2021 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace ILIAS\Plugin\CourseBooking\Cron;

use ilCronJob;
use ilCronJobResult;
use ilLogger;
use ilTestCronInterfacePlugin;

/**
 * Class TestCronInterfaceJob
 * @package ILIAS\Plugin\TestCronInterface\Cron
 * @author Michael Jansen <mjansen@databay.de>
 */
class TestCronInterfaceJob extends ilCronJob
{
    /** @var ilTestCronInterfacePlugin */
    private $plugin;
    /** @var ilLogger */
    private $logger;

    /**
     * OpenBookingsReminder constructor.
     * @param ilTestCronInterfacePlugin $plugin
     * @param ilLogger $logger
     */
    public function __construct(ilTestCronInterfacePlugin $plugin, ilLogger $logger)
    {
        $this->plugin = $plugin;
        $this->logger = $logger;
    }


    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return sprintf("Title Test of: %s", self::class);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return sprintf("Description Test of: %s", self::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return 'testcroninterface_job';
    }

    /**
     * @inheritDoc
     */
    public function hasAutoActivation()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function hasFlexibleSchedule()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultScheduleType()
    {
        return ilCronJob::SCHEDULE_TYPE_DAILY;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultScheduleValue()
    {
        return 1;
    }

    /**
     * @return bool
     */
    public function isManuallyExecutable()
    {
        return defined('DEVMODE') && (bool) DEVMODE;
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $this->logger->info('Started job');

        $result = new ilCronJobResult();
        $result->setStatus(ilCronJobResult::STATUS_OK);
        $result->setMessage('Successfully finished job');

        $this->logger->info($result->getMessage());

        return $result;
    }
}
