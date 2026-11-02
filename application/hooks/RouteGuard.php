<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RouteGuard
{
    public function check()
    {
        /*
        |--------------------------------------------------------------------------
        | Get Requested URI
        |--------------------------------------------------------------------------
        */

        $requestUri = parse_url(
            $_SERVER['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        );

        $requestUri = trim($requestUri, '/');


        /*
        |--------------------------------------------------------------------------
        | Remove Project Directory
        |--------------------------------------------------------------------------
        |
        | Example:
        | /CI3LV/register
        |
        | becomes:
        | register
        |
        */

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

        $scriptDir = trim(
            dirname($scriptName),
            '/'
        );

        if ($scriptDir !== '') {

            if ($requestUri === $scriptDir) {

                $requestUri = '';

            } elseif (
                strpos(
                    $requestUri,
                    $scriptDir . '/'
                ) === 0
            ) {

                $requestUri = substr(
                    $requestUri,
                    strlen($scriptDir) + 1
                );
            }
        }

        $uri = trim($requestUri, '/');


        /*
        |--------------------------------------------------------------------------
        | Load routes.php directly
        |--------------------------------------------------------------------------
        */

        $route = array();

        $routesFile = APPPATH . 'config/routes.php';

        if (!file_exists($routesFile)) {

            $this->show404();

            return;
        }

        require $routesFile;


        /*
        |--------------------------------------------------------------------------
        | Check Route
        |--------------------------------------------------------------------------
        */

        $matched = false;

        foreach ($route as $definedRoute => $destination) {

            /*
            |--------------------------------------------------------------------------
            | Skip CI3 Special Routes
            |--------------------------------------------------------------------------
            */

            if (in_array($definedRoute, array(
                'default_controller',
                '404_override',
                'translate_uri_dashes'
            ), true)) {
                continue;
            }


            $definedRoute = trim(
                $definedRoute,
                '/'
            );


            /*
            |--------------------------------------------------------------------------
            | Exact Route
            |--------------------------------------------------------------------------
            */

            if ($definedRoute === $uri) {

                $matched = true;

                break;
            }


            /*
            |--------------------------------------------------------------------------
            | Dynamic Route
            |--------------------------------------------------------------------------
            */

            $pattern = preg_quote(
                $definedRoute,
                '#'
            );

            $pattern = str_replace(
                array(
                    '\(:any\)',
                    '\(:num\)',
                    '\(:alpha\)',
                    '\(:alnum\)'
                ),
                array(
                    '.*',
                    '[0-9]+',
                    '[a-zA-Z]+',
                    '[a-zA-Z0-9]+'
                ),
                $pattern
            );


            if (preg_match(
                '#^' . $pattern . '$#',
                $uri
            )) {

                $matched = true;

                break;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Route Not Defined
        |--------------------------------------------------------------------------
        */

        if (!$matched) {

            $this->show404();

            return;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 404 Response
    |--------------------------------------------------------------------------
    */

    private function show404()
    {
        http_response_code(404);

        echo '<!DOCTYPE html>
<html>
<head>
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .error {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .box {
            background: #fff;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,.10);
        }

        h1 {
            font-size: 80px;
            margin: 0;
        }

        h2 {
            margin: 10px 0;
        }

        p {
            color: #777;
        }
    </style>
</head>

<body>

<div class="error">
    <div class="box">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>The requested route does not exist.</p>
    </div>
</div>

</body>
</html>';

        exit;
    }
}