<?php
class App
{

    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($url[0]) && isset($url[1]) && count($url) === 2 && $url[0] === 's')
            $this->service($url[1]);

        if (isset($url[0])) {
            if (file_exists('app/controllers/' . ucfirst($url[0]) . '.php'))
                $this->controller = ucfirst($url[0]);
            else
                $this->errorDocument();

            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);

                if (isset($url[2])) {
                    $this->check_if_URL_parameters_match_method_parameters(
                        $this->controller,
                        $this->method,
                        $url
                    );
                }
            } else if (method_exists($this->controller, $this->method)) {
                $this->check_if_URL_parameters_match_method_parameters(
                    $this->controller,
                    $this->method,
                    $url
                );
            } else
                $this->errorDocument();
        }

        call_user_func_array([new $this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(
                rtrim($_GET['url'], '/'),
                FILTER_SANITIZE_STRING
            ));
        }
    }

    private function errorDocument()
    {
        $this->controller = 'Errors';
        $this->method = 'page404';
        require_once 'app/controllers/' . $this->controller . '.php';
    }

    private function service($param)
    {
        require_once 'app/controllers/Link.php';
        (new Link())->resolve($param);
        exit();
    }

    private function check_if_URL_parameters_match_method_parameters($controller, $method, $params)
    {
        $reflection = new ReflectionMethod($controller, $method);

        $totalParametersURL = count($params);
        $totalParametersMethod = $reflection->getNumberOfParameters();
        $requiredParametrsMethod = $reflection->getNumberOfRequiredParameters();
        $lastParameterMethod = $totalParametersMethod !== 0 ? ($reflection->getParameters())[$totalParametersMethod - 1] : null;

        if (
            !$lastParameterMethod?->isVariadic() &&
            ($totalParametersMethod !== $totalParametersURL
                && $requiredParametrsMethod !== $totalParametersURL)
        )
            $this->errorDocument();
        else
            $this->params = array_values($params);
    }
}
