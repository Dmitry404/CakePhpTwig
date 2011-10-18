<?php
/**
 * CakePhp View class that provides work with Twig template engine
 *
 * @link https://github.com/cakephp/cakephp
 * @link https://github.com/fabpot/Twig
 *
 * @autor Dmitriy Butakov
 */
class TwigView extends View {
    private $twig = null;

    /**
     * @param $controller Controller
     */
    public function __construct($controller) {
        parent::__construct($controller);

        $defaultOptions = array(
            'cache' => CACHE . 'views',
            'autoescape' => false,
            'debug' => (bool)Configure::read('debug'),
        );

        $loader = new Twig_Loader_Filesystem(APP);
        $this->twig = new Twig_Environment($loader, $defaultOptions);

        $this->ext = '.htm';
    }

    public function renderLayout($content_for_layout, $layout = null) {
        if (strpos($this->_getLayoutFileName($layout), APP) === 0) {
            return '';
        } else {
            return parent::renderLayout($content_for_layout, $layout);
        }
    }

    protected function _render($___viewFn, $___dataForView = array()) {
        if (file_exists($___viewFn) && strpos($___viewFn, APP) === 0) {
            $relativePathToTemplate = str_replace(APP, '', $___viewFn);

            $___dataForView = array_merge(
                $this->viewVars,
                $___dataForView,
                $this->getLoadedHelpers()
            );

            try {
                return $this->twig->loadTemplate($relativePathToTemplate)->display($___dataForView);
            } catch (Exception $e) {
                CakeLog::write('error', $e->getMessage() . $e->getTraceAsString());

                // I clean rendered content because I want to show only my error page
                ob_end_clean();
                
                $this->renderTwigExceptionPage($e);
            }
        } else {
            return parent::_render($___viewFn, $___dataForView);
        }
    }

    private function getLoadedHelpers() {
        $loadedHelpers = array();
        foreach ($this->Helpers->enabled() as $helper) {
            $loadedHelpers[$helper] = $this->Helpers->{$helper};
        }

        return $loadedHelpers;
    }

    private function renderTwigExceptionPage(Exception $e) {
        $errorEnvironment = new Twig_Environment(
           new Twig_Loader_Filesystem(__DIR__ . DS . 'errors')
       );
       $errorEnvironment
           ->loadTemplate('syntax_error.htm')
           ->display(array('e' => $e));
    }

}
