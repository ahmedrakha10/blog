<?php


function api_response($data = null, $message = "", $status = "success", $status_code = 200)
{

    $response = [
        'status'  => $status ? 1 : 0,
        'message' => $message,
        'data'    => $data,
    ];
    try {
        if ($data) {
            $pagination = api_model_set_pagenation($data);
            if ($pagination) {
                $response['pagination'] = $pagination;
            } else {
                foreach ($data as $key => $row) {
                    if (is_string($key)) {
                        $pagination = api_model_set_pagenation($row);
                        if ($pagination) {
                            $response['pagination'] = $pagination;
                            break;
                        }
                    }
                }
            }
        }
    } catch
    (\Throwable $th) {
        //throw $th;
    }
    return response()->json($response, $status_code);
}

if (!function_exists('api_model_set_pagenation')) {

    function api_model_set_pagenation($model)
    {
        if (is_object($model) && count((array)$model)) {
            try {
                $pagination['total'] = $model->total();
                $pagination['lastPage'] = $model->lastPage();
                $pagination['perPage'] = $model->perPage();
                $pagination['currentPage'] = $model->currentPage();
                return $pagination;
            } catch (\Exception$e) {
            }
        }
        return null;
    }
}
