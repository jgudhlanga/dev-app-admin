<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ApiExceptionTrait
{
	/**
	 * @param $request
	 * @param $exception
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function apiException($request, $exception)
	{
		if($this->isModelNotFoundException($exception))
		{
			return $this->modelNotFoundResponse();
		}
		
		if($this->isHttpNotFoundException($exception))
		{
			return $this->httpNotFoundResponse();
		}
		
		return parent::render($request, $exception);
	}
	
	/**
	 * @param $exception
	 * @return bool
	 */
	public function isModelNotFoundException($exception)
	{
		return $exception instanceof ModelNotFoundException;
	}
	
	/**
	 * @param $exception
	 * @return bool
	 */
	public function isHttpNotFoundException($exception)
	{
		return $exception instanceof NotFoundHttpException;
	}
	
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function modelNotFoundResponse()
	{
		return response()->json(['errors'=>'Model not Found'], Response::HTTP_NOT_FOUND);
	}
	
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function httpNotFoundResponse()
	{
		return response()->json(['errors'=>'Incorrect route'], Response::HTTP_NOT_FOUND);
	}
}