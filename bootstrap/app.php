<?php

use App\DTOs\ApiResponseDTO;
use App\Http\Middleware\SetLangMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SetLangMiddleware::class);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        // NotFoundHttpException
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                $response = new ApiResponseDTO(__('messages.not_found'), null);

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                $response = new ApiResponseDTO(__('messages.unauthenticated'), null);

                return response()->json($response, Response::HTTP_UNAUTHORIZED);
            }
        });
    })->create();
