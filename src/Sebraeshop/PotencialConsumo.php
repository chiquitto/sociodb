<?php

namespace Chiquitto\Sociodb\Sebraeshop;

/**
 * @link http://www.sebraeshop.com.br/potencial_consumo/
 * @link http://www.sebraeshop.com.br/potencial_consumo/IPCDocumentos/Metodologia_IPC_Maps_2012.pdf
 * Potencial de Consumo
 * 
 * Esta base contempla o consumo das populações urbanas e rurais, com análise individual de 21 categorias de consumo, classificadas por classe econômica de A a E. Traz, também, dados demográficos de todos os municípios do Brasil.
 * As informações foram atualizadas para 2012, detalhadas para todos os municípios. Com essas informações as empresas e candidatos a empreendedores dispõem de subsídios para embasar os seus planejamentos, seja na área comercial, de serviços ou outras áreas em que se façam necessárias. Contém ainda um ranking dos municípios brasileiros segundo o seu Potencial de Consumo.
 */
class PotencialConsumo
{

    const CATEGORIA_ALIMENTACAO_DOMICILIO = 1;
    const CATEGORIA_ALIMENTACAO_FORA_DOMICILIO = 2;
    const CATEGORIA_ARTIGOS_LIMPEZA = 3;
    const CATEGORIA_BEBIDAS = 4;
    const CATEGORIA_CALCADOS = 5;
    const CATEGORIA_EQUIPAMENTOS_ELETRONICOS = 6;
    const CATEGORIA_FUMO = 7;
    const CATEGORIA_HIGIENE_CUIDADOS_PESSOAIS = 8;
    const CATEGORIA_LIVROS_MATERIAL_ESCOLAR = 9;
    const CATEGORIA_MANUTENCAO_LAR = 10;
    const CATEGORIA_MATRICULAS_MENSALIDADES = 11;
    const CATEGORIA_MEDICAMENTOS = 12;
    const CATEGORIA_MOBILIARIOS_ARTIGOS_LAR = 13;
    const CATEGORIA_OUTRAS_DESPESAS = 14;
    const CATEGORIA_OUTRAS_DESPESAS_VESTUARIO = 15;
    const CATEGORIA_OUTRAS_DESPESAS_SAUDE = 16;
    const CATEGORIA_RECREACAO_CULTURA = 17;
    const CATEGORIA_TRANSPORTES_URBANOS = 18;
    const CATEGORIA_VEICULO_PROPRIO = 19;
    const CATEGORIA_VESTUARIO_CONFECCIONADO = 20;
    const CATEGORIA_VIAGENS = 21;
    const CATEGORIA_DOMICILIO_URBANO = 22;
    const CATEGORIA_TOTAL_URBANO = 23;
    const CLASSE_A1 = 'A1';
    const CLASSE_A2 = 'A2';
    const CLASSE_B1 = 'B1';
    const CLASSE_B2 = 'B2';
    const CLASSE_C1 = 'C1';
    const CLASSE_C2 = 'C2';
    const CLASSE_D = 'D';
    const CLASSE_E = 'E';

    /**
     * Retorna true, se $classe é uma classe socioeconomica.
     * 
     * @param string $classe
     * @return boolean
     */
    public static function validarClasse($classe)
    {
        switch ($classe) {
            case self::CLASSE_A1:
            case self::CLASSE_A2:
            case self::CLASSE_B1:
            case self::CLASSE_B2:
            case self::CLASSE_C1:
            case self::CLASSE_C2:
            case self::CLASSE_D:
            case self::CLASSE_E:
                return true;
        }
        
        return false;
    }

}
