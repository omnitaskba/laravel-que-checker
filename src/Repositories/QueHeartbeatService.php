<?php

namespace Omnitask\LaravelQueChecker\Repositories;

use Omnitask\LaravelQueChecker\Notifications\QueStatusNotification;
use Omnitask\LaravelQueChecker\Models\QueHeartbeat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class QueHeartbeatServiceResponse
{
    public $data;
    public $errors;

    public function __construct($errors = null, $data = [])
    {
        $this->errors = $errors;
        $this->data = $data;

    }

    public function throwExceptionWithErrorMessages(){
        throw new Exception($this->convertErrorsToString());
    }

    public function convertErrorsToString(){
        return implode('.', $this->errors);
    }
}

class QueHeartbeatService
{

    public static function createNewQueHeartbeat(){
        $errors = null;
        $data = [];
        $slackChanel = config('laravelqchecker.slack_que_status_notification');

        $failedHeartbeats = QueHeartbeat::where('status',QueHeartbeat::$_STATUS_FAILED)->first();

        try{
            
            DB::beginTransaction();
            if($failedHeartbeats){
                $failedHeartbeats->update([
                    'status' => QueHeartbeat::$_STATUS_CHECKED
                ]);

                if($slackChanel){
                    Notification::route('slack', $slackChanel)
                        ->notify(new QueStatusNotification(true));
                }
            }

            $newQueHeartbeat = QueHeartbeat::create([
                'status' => QueHeartbeat::$_STATUS_PENDING
            ]);

            DB::commit();
           
            $data['que_heartbeat'] = $newQueHeartbeat;
            
        }catch(Exception $e){
            DB::rollback();
            $errors[] = 'Failed to create new heart beat';
            Log::error('Failed to create new heart beat. Error:'. $e);
        }

        return new  QueHeartbeatServiceResponse($errors, $data);
    }

    public static function createNewQueHeartbeatOrFail(){
        $response = self::createNewQueHeartbeat();

        return $response->errors ? $response->throwExceptionWithErrorMessages() : $response;
    }

    public static function checkIsQueWorking(){
        $errors = null;
        $data = [];
        $slackChanel = config('laravelqchecker.slack_que_status_notification');

        $failedHeartbeats = QueHeartbeat::where('status',QueHeartbeat::$_STATUS_FAILED)->first();

        if($failedHeartbeats){
            return new  QueHeartbeatServiceResponse($errors, $data);
        }

        $pendingHeartbeats = QueHeartbeat::where('status', QueHeartbeat::$_STATUS_PENDING)->first();


        try{
           
            DB::beginTransaction();

            if($pendingHeartbeats){
                $pendingHeartbeats->update([
                    'status' => QueHeartbeat::$_STATUS_CHECKED
                ]);
            }else{
                QueHeartbeat::create([
                    'status' => QueHeartbeat::$_STATUS_FAILED
                ]);

                
                if($slackChanel){
                    Notification::route('slack', $slackChanel)
                        ->notify(new QueStatusNotification(false));
                }
            }


            DB::commit();
           
            $data['success'] = true;
            
        }catch(Exception $e){
            DB::rollback();
            $errors[] = 'Failed to check is que working';
            Log::error('Failed to check is que working. Error:'. $e);
        }

        return new  QueHeartbeatServiceResponse($errors, $data);
    }

    public static function checkIsQueWorkingOrFail(){
        $response = self::checkIsQueWorking();

        return $response->errors ? $response->throwExceptionWithErrorMessages() : $response;
    }

    public static function deleteOldQueHeartbeats(){
        $errors = null;
        $data = [];
        
        $oldQueHeartBeats = QueHeartbeat::where('created_at', '<=', Carbon::now()->subDays(7))->get();

        try{
           
           
            DB::beginTransaction();

            foreach ($oldQueHeartBeats as $queHeartbeat) {
                $queHeartbeat->delete();
            }

            DB::commit();
           
            $data['success'] = true;
            
        }catch(Exception $e){
            DB::rollback();
            $errors[] = 'Failed to delete old que heartbeats';
            Log::error('Failed to delete old que heartbeats. Error:'. $e);
        }

        return new  QueHeartbeatServiceResponse($errors, $data);
    }
    
}
