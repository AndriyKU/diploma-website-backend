<?php
class Errors extends Controller
{
    public function page404()
    {
        // header('Location: /app/views/errors/404.php');
        // exit();

        http_response_code(404);
        $this->view('errors/404');
    }
}
