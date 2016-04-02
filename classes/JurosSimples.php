<?php

/**
 * JurosSimples
 *
 * @author Dian Carlos (dian.cabral@gmail.com)
 * @copyright 2016 Dian Carlos
 */

class JurosSimples {

	/**
	 * @var int Juros Final
	 */
	public $J;

	/**
	 * @var int Capital Principal
	 */
	public $P;

	/**
	 * @var int Taxa de Juros
	 */
	public $i;

	/**
	 * @var string Frequencia da Taxa de Juros
	 *
	 * Aceita os seguintes valores
	 *
	 * am = ao mês
	 * ab = ao bimestre
	 * at = ao trimestre
	 * as = ao semestre
	 * aa = ao ano
	 *
	 */
	public $ix;

	/**
	 * @var int Número de Dias
	 */
	public $n;

	function decimal($numero){

		$convertido = number_format($numero, 4, ',', '.');

		return $convertido;

	}

	function dinheiro($numero){

		$arredonda = round($numero, 2);
		$precisao = is_float($numero) ? 2 : 0;

		$convertido = number_format($arredonda, $precisao, ',', '.');

		return $convertido;

	}

	/**
	 * J = P.i.n
	 *
	 * @author Dian Carlos
	 * @version 0.0.0
	 *
	 * @return int Valor do juros
	 */

	function resolver(){

		$juros           = $this->J;
		$capital         = $this->P;
		$taxa            = $this->i;
		$taxa_frequencia = $this->ix;
		$periodo         = $this->n;

		// Verifica a frequencia escolhida em dias e transforma em meses
		switch($taxa_frequencia){

			case 'a.m.' : $dias = 30; break;
			case 'a.b.' : $dias = 60; break;
			case 'a.t.' : $dias = 90; break;
			case 'a.s.' : $dias = 180; break;
			case 'a.a.' : $dias = 360; break;

		}

		// Transforma a taxa em decimal
		$taxa_transformada = number_format($taxa / 100, 4);

		// Transforma o periodo em meses
		$periodo_transformado = number_format($periodo / $dias, 4);

		// Exibe os parametros 'i' e 'n'

		if($taxa){

			echo '$$ i = \text{' . $taxa . '% ' . $taxa_frequencia . '} = \frac{' . $taxa . '}{100} = ' . $this->decimal($taxa_transformada) . ' $$';

		}

		if($periodo){

			echo '$$ n = \text{' . $periodo . ' dias} = \frac{' . $periodo . ' \text{ dias}}{' . $dias . ' \text{ dias}} = ' . $this->decimal($periodo_transformado) . ' $$';

		}

		// Executa a fórmula para achar o Juros
		if(!$juros && $capital && $taxa && $periodo){

			$eq1 = ($capital * $taxa_transformada) * $periodo_transformado;

			/* */

			echo '$$ J = ' . $capital . ' \times ' . $this->decimal($taxa_transformada) . ' \times ' . $this->decimal($periodo_transformado) . ' $$';
			echo '$$ J = ' . $this->dinheiro($eq1) . ' $$';

		} else

		// Executa a fórmula para achar o Capital
		if($juros && !$capital && $taxa && $periodo){

			$eq1 = $taxa_transformada * $periodo_transformado;
			$eq2 = $juros / $eq1;

			/* */

			echo '$$ ' . $this->dinheiro($juros) . ' = P \times ' . $this->decimal($taxa_transformada) . ' \times ' . $this->decimal($periodo_transformado)  . ' $$';
			echo '$$ ' . $this->dinheiro($juros) . ' = P \times ' . $this->decimal($eq1)  . ' $$';
			echo '$$ ' . $this->dinheiro($juros) . ' = ' . $this->decimal($eq1)  . 'P $$';
			echo '$$ P = \frac{' . $this->dinheiro($juros) . '}{' . $this->decimal($eq1) . '} $$';
			echo '$$ P = ' . $this->dinheiro($eq2) . ' $$';

		} else

		// Executa a fórmula para achar a Taxa de Juros
		if($juros && $capital && !$taxa && $periodo){

			$eq1 = $capital * $periodo_transformado;
			$eq2 = $juros / $eq1;
			$eq3 = $this->decimal($eq2 * 100);

			/* */

			echo '$$ ' . $this->dinheiro($juros) . ' = ' . $this->dinheiro($capital) . ' \times i \times ' . $this->decimal($periodo_transformado) . ' $$';
			echo '$$ ' . $this->dinheiro($juros) . ' = ' . $this->dinheiro($capital) . 'i \times ' . $this->decimal($periodo_transformado) . ' $$';
			echo '$$ ' . $this->dinheiro($juros) . ' = ' . $this->dinheiro($eq1) . 'i $$';
			echo '$$ i = \frac{' . $this->dinheiro($juros) . '}{' . $this->dinheiro($eq1) . '} $$';
			echo '$$ i = ' . $this->decimal($eq2) . ' \times 100 $$';
			echo '$$ i = ' . $this->dinheiro($eq3) . ' $$';

		}

	}

}