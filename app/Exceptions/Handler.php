<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use GuzzleHttp\Client;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        // parent::report($exception);

        parent::report($exception);
        // $client  = new Client();
        // $url = "https://api.telegram.org/bot".env("BOTTELEGRAM","806954216:AAGy32opLuacInlrTx36nuiVHazXzX8zFjk")."/sendMessage";//<== ganti jadi token yang kita tadi
        // $data    = $client->request('GET', $url, [
        //     'json' =>[
        //       "chat_id" => env("BOTTELEGRAM_CHATID","741436337"), //<== ganti dengan id_message yang kita dapat tadi
        //       "text" => "File : ".$exception->getFile()."\nLine : ".$exception->getLine()."\nCode : ".$exception->getCode()."\nMessage : ".$exception->getMessage(),"disable_notification" => true
        //     ]
        // ]);

        // $json = $data->getBody();
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
