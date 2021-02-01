<?php declare(strict_types=1);
/* Copyright (c) 1998-2021 ILIAS open source, Extended GPL, see docs/LICENSE */

use ILIAS\DI\Container;
use ILIAS\Plugin\CourseBooking\Cron\TestCronInterfaceJob;

/**
 * Class ilTestCronInterfacePlugin
 * @author Michael Jansen <mjansen@databay.de>
 */
class ilTestCronInterfacePlugin extends ilUserInterfaceHookPlugin implements ilCronJobProvider
{
    /** @var Container */
    private $dic;

    /**
     * ilTestCronInterfacePlugin constructor.
     */
    public function __construct()
    {
        global $DIC;

        $this->dic = $DIC;

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function init()
    {
        parent::init();
        $this->registerAutoloader();
    }

    public function registerAutoloader() : void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
    }

    /**
     * @inheritDoc
     */
    public function getPluginName()
    {
        $class = substr(self::class, 2);
        $pluginPosition = strrpos($class, 'Plugin');

        return substr($class, 0, $pluginPosition);
    }

    /**
     * @inheritDoc
     */
    public function getCronJobInstances()
    {
        return [
            new TestCronInterfaceJob($this, $this->dic->logger()->root()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getCronJobInstance($a_job_id)
    {
        foreach ($this->getCronJobInstances() as $cronJob) {
            if ($a_job_id === $cronJob->getId()) {
                return $cronJob;
            }
        }

        throw new OutOfBoundsException(sprintf("Could not find any job for id '%s'", $a_job_id));
    }
}
