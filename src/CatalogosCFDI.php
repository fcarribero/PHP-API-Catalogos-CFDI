<?php


namespace Advans\Api\CatalogosCFDI;

class CatalogosCFDI {

    protected Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * @return bool|string
     * @throws CatalogosCFDIException
     */
    public function version() {
        return trim($this->call('version'));
    }

    /**
     * @param $catalogo
     * @param $value
     * @param null $fecha (Formato YYYY-MM-DD)
     * @return bool|string
     * @throws CatalogosCFDIException
     */
    public function getItem($catalogo, $value, $fecha = null) {

        try {
            $query = [];
            if ($fecha !== null) $query['fecha'] = $fecha;
            if (gettype($value) == 'object' && get_class($value) == CustomWhere::class) {
                $query['where'] = $value->parse();
                return json_decode($this->call($catalogo, 'GET', $query));
            } else if (gettype($value) == 'array') {
                $where = new CustomWhere($value[0], $value[1]);
                $query['where'] = $where->parse();
                return json_decode($this->call($catalogo, 'GET', $query));
            } else {
                return json_decode($this->call($catalogo . '/' . $value, 'GET', $query));
            }
        } catch (CatalogosCFDIException $e) {
            if ($e->getCode() == 404) {
                return false;
            }
            throw $e;
        }
    }

    /**
     * @param $method
     * @param string $verb
     * @param null $params
     * @return bool|string
     * @throws CatalogosCFDIException
     */
    protected function call($method, string $verb = 'GET', $params = null) {
        $verb = strtoupper($verb);
        $url = $this->config->base_url . $method . ($verb == 'GET' && $params ? '?' . http_build_query($params) : '');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $verb,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $verb == 'POST' && $params ? json_encode($params) : null,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->config->key
            ]
        ]);
        $result = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($http_code != 200 || $result === false) {
            throw new CatalogosCFDIException('Error de conexión con Catálogos CFDI. HTTP_CODE: ' . $http_code, $http_code);
        }
        return $result;
    }
}