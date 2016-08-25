<?php

namespace Nht\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
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

        // Upload exceptions
        if(
           $e instanceof \Nht\Hocs\Core\Uploads\Exceptions\FileTypeIsNotAllowedException
           || $e instanceof \Nht\Hocs\Core\Uploads\Exceptions\NoFileSelectedException
           || $e instanceof \Nht\Hocs\Core\Uploads\Exceptions\UploadException
           || $e instanceof \Nht\Hocs\Core\Uploads\Exceptions\UploadMaxFileSizeException
           || $e instanceof \Nht\Hocs\Core\Uploads\Exceptions\UploadPathDoesNotExistException
        ) {

            if($request->ajax()) {
                return response()->json([
                    'code'    => 0,
                    'message' => $e->getMessage()
                ]);
            } else {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        }

        // Exception không thể đọc đưọc file ảnh
        if( $e instanceof \Intervention\Image\Exception\NotReadableException ) {
            if($request->ajax()) {
                return response()->json([
                    'code'    => 0,
                    'message' => 'Không thể đọc được nội dung file ảnh'
                ]);
            } else {
                return redirect()->back()->withInput()->with('error', 'Không thể đọc được nội dung file ảnh');
            }
        }

        // 404 not found
        if($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return \App::abort(404);
        }

        return parent::render($request, $e);
    }
}
