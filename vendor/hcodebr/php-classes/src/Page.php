<?php

namespace Hcode;

Use Rain\Tpl;

class Page {

	private $tpl;
	private $options = [];
	// Opções padrões
	private $defaults = [
		"data"=>[]
	];


	public function __construct($opts = array()) {

		// Mescla de arrays - O último sobreescreve o primeiro
		$this->options = array_merge($this -> defaults, $opts);

		// Configuração RainTPL - Do Template
		// Necessário uma pasta para pegar arquivos HTML
		// E uma para arquivos de cache
		$config = array(
			// $_SERVER["DOCUMENT_ROOT"] -> Variável que retorna a localização do repositório raiz da aplicação
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
		);

		// (::) Acessar métodos ou propriedades estáticas
		Tpl::configure( $config );

		$this -> tpl = new Tpl;

		// Variaveis vem de acordo com a rota

		$this -> setData($this -> options["data"]);

		// Desenho do cabeçalho
		$this -> tpl -> draw("header");
	}

	private function setData($data = array()) {

		foreach($data as $key => $value) {
			$this -> tpl -> assign($key, $value);
		}

	}

	// Desenhar corpo/Content da página
	public function setTpl($name, $data = array(), $returnHTML = false) {

		$this -> setData($data);

		return $this -> tpl -> draw($name, $returnHTML);

	}

	// Rodapé
	public function __destruct() {

		$this -> tpl -> draw("footer");

	}

}

?>