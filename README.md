# Configuration
## 1. Run php artisan migrate
## 2. Setup .env Variables

```
SLACK_QUE_NOTIFICATION=https://hooks.slack.com/services/A3xxxxHL/C01BxxxxGNS/EfLwgqxxxxxxsRV2JTQ
SLACK_QUE_NOTIFICATION_CHANNEL=test-que
```

# Usage
## Call commands in App\Console\Kernel.php
``` 
$schedule->command(CheckQue::class)->cron('1,6,11,16,21,26,31,36,41,46,51,56 * * * *');
$schedule->command(CheckIsQueWorking::class)->cron('3,8,13,18,23,28,33,38,43,48,53,58 * * * *');;
$schedule->command(DeleteOldQueHeartbeats::class)->dailyAt('03:00');
```

###### *Important: Command CheckIsQueWorking should be called with slight delay after CheckQue Command
