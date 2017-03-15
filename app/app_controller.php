<?php
class AppController extends Controller
{
    public $default_view_class = 'AppLayoutView';

    public function beforeFilter()
    {
    }

    public function afterFilter()
    {
    }

    public function dispatchAction()
    {
        try {
            try {
                parent::dispatchAction();
            } catch (Exception $e) {
                // Output to php error log all exceptions
                $log = sprintf('Exception:%s@%s %s', $e->getFile(), $e->getLine(), $e->getMessage());
                error_log($log);
                throw $e;
            }
        } catch (Exception $e) {
            if (DEBUG_DUMP_EXCEPTION && Param::get('debug')) {
                // When debug output is on or debug is available in the
                // query parameters. Display all errors as html
                $this->view = new $this->default_view_class($this);

                $this->set('e', $e);
                $this->render('error/dump');
            } else {
                $this->set('e', $e);
                $this->render('error/error');
            }
        }
    }

    protected function setFlash($message, $flash_level = "info")
    {
        Session::set("flash-message", $message);
        Session::set("flash-level", $flash_level);
    }

    protected function redirect($url)
    {
        header("Location: ".$url);
        exit;
    }
}
