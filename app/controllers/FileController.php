<?php
require_once './models/Order.php';


class FileController
{
    public static function ReadCsv($filename)
    {
        $path = $_ENV['PATH_TO_CSV'] . '/' . $filename;
        $csv = array_map('str_getcsv', file($path));
        array_walk($csv, function (&$array) use ($csv) {
            $array = array_combine($csv[0], $array);
        });
        array_shift($csv); // removemos header


        return $csv;
    }


    public static function LoadFromCsv($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $filename = $parametros['filename'];
        $controller = $parametros['controller'];
        var_dump($filename);

        $csv = FileController::ReadCsv($filename);

        foreach ($csv as $obj) {
            $controller::CargarDesdeCSV($obj);
        }

        $payload = json_encode(array("mensaje" => "Se cargaron valores desde Csv"));

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }


    public static function WriteCsv($filename, $array, $headers)
    {
        $path = $_ENV['PATH_TO_CSV'] . '/' . $filename;
        $file = fopen($path, 'w');
        fputcsv($file, $headers);
        foreach ($array as $fields) {
            fputcsv($file, get_object_vars($fields));
        }

        fclose($file);
    }


    public static function WriteToCsv($request, $response, $args)
    {
        // Get params
        $parametros = $request->getQueryParams();
        $filename = $parametros['filename'];
        $model = $parametros['model'];
        // var_dump($filename);

        $array = $model::getAll();
        $headers = []; 
        foreach (get_object_vars($array[0]) as $key => $value) {
            array_push($headers, $key);
        }

        FileController::WriteCsv($filename, $array, $headers);


        $payload = json_encode(array("mensaje" => "Se escribieron valores al archivo Csv"));

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
