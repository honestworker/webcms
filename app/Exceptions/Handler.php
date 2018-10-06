<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		//echo '<pre>'; print_r($e); exit;
		
		
		if ($e instanceof TokenMismatchException){
			//echo 123; exit;
            //redirect to form an example of how i handle mine
			
           	//return redirect($request->fullUrl())->withData('token_error',"Opps! Seems you couldn't submit form for a longtime. Please try again");
			
			//$this->data['token_error'] = "Opps! Seems you couldn't submit form for a longtime. Please try again";
			
			return redirect('/token_expired');
        }
		return parent::render($request, $e);
	}

}
