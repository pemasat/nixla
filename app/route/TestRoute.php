<?php

class TestRoute extends Nette\Object implements Nette\Application\IRouter {

	/**
	 * Maps HTTP request to a PresenterRequest object.
	 * @param  Nette\Web\IHttpRequest
	 * @return PresenterRequest|NULL
	 */
	public function match(IHttpRequest $context) {
		\Nette\Diagnostics\FireLogger::log('-------------');
		\Nette\Diagnostics\FireLogger::log($context);
		
		return NULL;

		

		 
			if (!preg_match('#^/([a-zA-Z0-9-]+)/?$#', $context->getUri()->path, $matches)) {
            return NULL;
        }

        $id = $matches[1];
        if (dibi::fetchSingle("SELECT COUNT(*) FROM tabulka_produktu WHERE nameid=%s", $id)) {
            $presenter = 'Front:Product';

        } elseif (dibi::fetchSingle("SELECT COUNT(*) FROM tabulka_kategorie WHERE nameid=%s", $id)) {
            $presenter = 'Front:Category';

        } elseif (dibi::fetchSingle("SELECT COUNT(*) FROM tabulka_s_clanky WHERE nameid=%s", $id)) {
            $presenter = 'Front:Article';

        } else {
            return NULL;
        }
        // alternativa: použít jednu tabulku s páry URL -> jméno Presenteru
        // výhoda: jeden lookup místo (až) tří, neměřitelně vyšší rychlost ;)
        // nevýhoda: nutnost ji udržovat :-(

        // alternativa č.2: místo COUNT(*) načíst z DB celý záznam a předat v parametru presenteru
        // výhoda: stejně jej bude potřebovat
        // nevýhoda: nadstandardní závislost mezi routerem a presenterem

        $params = $context->getQuery();
        $params['id'] = $id;

        return new PresenterRequest(
            $presenter,
            $context->getMethod(),
            $params,
            $context->getPost(),
            $context->getFiles(),
            array('secured' => $context->isSecured())
        );
    }



	/**
	 * Constructs URL path from PresenterRequest object.
	 * @param  Nette\Web\IHttpRequest
	 * @param  PresenterRequest
	 * @return string|NULL
	 */
	public function constructUrl(PresenterRequest $request, IHttpRequest $context) {
		\Nette\Diagnostics\FireLogger::log('oooooooooooooo');
		return NULL;
		
		
		 // overime ze presenter je jeden ze podporovanych a existuje parameter 'id'
		 static $presenters = array(
			  'Front:Spot' => TRUE,
			  'Front:Category' => TRUE,
			  'Front:Product' => TRUE,
		 );

		 if (!isset($presenters[$request->getPresenterName()])) {
			  return NULL;
		 }

		 $params = $request->getParams();
		 if (!isset($params['id'])) {
			  return NULL;
		 }

		 // vse ok, generuj URL
		 $uri = $context->getUri()->basePath . rawurlencode($params['id']);
		 unset($params['id'], $params['action']);

		 $query = http_build_query($params, '', '&');
		 if ($query !== '') $uri .= '?' . $query;

		 return $uri;
	}

}