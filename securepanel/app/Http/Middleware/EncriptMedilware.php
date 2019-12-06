<?php

namespace App\Http\Middleware;

use Closure;

class EncriptMedilware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        if (array_key_exists('param', $input)) {
            $inputParams = \json_decode(\base64_decode($input['param']), true);
            $request->replace($inputParams);
        }
        
        $response  = $next($request);
        $collection = $response->original;
        if ($request->dev) {
            if (array_key_exists('fail',$collection)) {
                $collection['status'] = 'error';
            } else {
                $collection['status'] = 'success';
            }
        
        } else {
            
            if ($response->original['data'] ) {
                $body = '';
                if ((is_object($response->original['data']) || is_array($response->original['data']))) {
                    $body = \base64_encode(\json_encode($response->original['data']));
                } else if (is_string($response->original['data'])) {
                    $body = \base64_encode($response->original['data']);
                }
                $collection['data'] = $body;
            }
            if (array_key_exists('fail',$collection)) {
                $collection['status'] = 'error';
            } else {
                $collection['status'] = 'success';
            }
            
        }
        return response($collection);
        
    }
}
