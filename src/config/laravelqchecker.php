<?php

return [
    'slack_que_status_notification' => env('LARAVEL_QUE_CHECKER_SLACK_WEBHOOK', null),
    'slack_notification_channel' => env('LARAVEL_QUE_CHECKER_SLACK_CHANNEL', null),
    'que_check_minutes_interval' => env('LARAVEL_QUE_CHECKER_MINUTES_INTERVAL', 5),
    'que_check_hour_range' => env('LARAVEL_QUE_CHECKER_HOUR_RANGE', '0-23'),
    'que_delete_old_heartbeats_time' => env('LARAVEL_QUE_CHECKER_DELETE_HEARTBEATS_TIME', '03:00'),
    'que_delete_old_heartbeats_days_interval' => env('LARAVEL_QUE_CHECKER_DELETE_HEARTBEATS_DAYS_INTERVAL', 7),
];
