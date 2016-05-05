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

    const CATEGORY_ALIMENTACAO_DOMICILIO = 1;
    const CATEGORY_ALIMENTACAO_FORA_DOMICILIO = 2;
    const CATEGORY_ARTIGOS_LIMPEZA = 3;
    const CATEGORY_BEBIDAS = 4;
    const CATEGORY_CALCADOS = 5;
    const CATEGORY_EQUIPAMENTOS_ELETRONICOS = 6;
    const CATEGORY_FUMO = 7;
    const CATEGORY_HIGIENE_CUIDADOS_PESSOAIS = 8;
    const CATEGORY_LIVROS_MATERIAL_ESCOLAR = 9;
    const CATEGORY_MANUTENCAO_LAR = 10;
    const CATEGORY_MATRICULAS_MENSALIDADES = 11;
    const CATEGORY_MEDICAMENTOS = 12;
    const CATEGORY_MOBILIARIOS_ARTIGOS_LAR = 13;
    const CATEGORY_OUTRAS_DESPESAS = 14;
    const CATEGORY_OUTRAS_DESPESAS_VESTUARIO = 15;
    const CATEGORY_OUTRAS_DESPESAS_SAUDE = 16;
    const CATEGORY_RECREACAO_CULTURA = 17;
    const CATEGORY_TRANSPORTES_URBANOS = 18;
    const CATEGORY_VEICULO_PROPRIO = 19;
    const CATEGORY_VESTUARIO_CONFECCIONADO = 20;
    const CATEGORY_VIAGENS = 21;
    const CATEGORY_DOMICILIO_URBANO = 22;
    const CATEGORY_TOTAL_URBANO = 23;
    const CLASS_A1 = 'A1';
    const CLASS_A2 = 'A2';
    const CLASS_B1 = 'B1';
    const CLASS_B2 = 'B2';
    const CLASS_C1 = 'C1';
    const CLASS_C2 = 'C2';
    const CLASS_D = 'D';
    const CLASS_E = 'E';
    
    private static $categoryNames = array(
        self::CATEGORY_ALIMENTACAO_DOMICILIO => 'Alimentação Domicílio',
        self::CATEGORY_ALIMENTACAO_FORA_DOMICILIO => 'Alimentação fora Domicílio',
        self::CATEGORY_ARTIGOS_LIMPEZA => 'Artigos de limpeza',
        self::CATEGORY_BEBIDAS => 'Bebidas',
        self::CATEGORY_CALCADOS => 'Calçados',
        self::CATEGORY_EQUIPAMENTOS_ELETRONICOS => 'Equipamentos Eletrônicos',
        self::CATEGORY_FUMO => 'Fumo',
        self::CATEGORY_HIGIENE_CUIDADOS_PESSOAIS => 'Higiene e Cuidados Pessoais',
        self::CATEGORY_LIVROS_MATERIAL_ESCOLAR => 'Livros e Material Escolar',
        self::CATEGORY_MANUTENCAO_LAR => 'Manutenção do Lar',
        self::CATEGORY_MATRICULAS_MENSALIDADES => 'Matriculas e Mensalidades',
        self::CATEGORY_MEDICAMENTOS => 'Medicamentos',
        self::CATEGORY_MOBILIARIOS_ARTIGOS_LAR => 'Mobiliarios e Artigos do Lar',
        self::CATEGORY_OUTRAS_DESPESAS => 'Outras Despesas',
        self::CATEGORY_OUTRAS_DESPESAS_VESTUARIO => 'Outras Despesas Vestuário',
        self::CATEGORY_OUTRAS_DESPESAS_SAUDE => 'Outras Despesas Saúde',
        self::CATEGORY_RECREACAO_CULTURA => 'Recreação e Cultura',
        self::CATEGORY_TRANSPORTES_URBANOS => 'Transportes Urbanos',
        self::CATEGORY_VEICULO_PROPRIO => 'Veículo Próprio',
        self::CATEGORY_VESTUARIO_CONFECCIONADO => 'Vestuário Confeccionado',
        self::CATEGORY_VIAGENS => 'Viagens',
    );
    
    private static $classNames = array(
        self::CLASS_A1 => 'A1',
        self::CLASS_A2 => 'A2',
        self::CLASS_B1 => 'B1',
        self::CLASS_B2 => 'B2',
        self::CLASS_C1 => 'C1',
        self::CLASS_C2 => 'C2',
        self::CLASS_D => 'D',
        self::CLASS_E => 'E',
    );

    public static function getCategoriaName($cdCategory)
    {
        return isset(self::$categoryNames[$cdCategory]) ? self::$categoryNames[$cdCategory] : null;
    }

    public static function getCategoriaNames()
    {
        return self::$categoryNames;
    }
    
    public static function getClass($class)
    {
        return isset(self::$classNames[$class]) ? self::$classNames[$class] : null;
    }
    
    public static function getClasses()
    {
        return self::$classNames;
    }

    /**
     * Retorna true, se $classe é uma classe socioeconomica.
     * 
     * @param string $class
     * @return boolean
     */
    public static function validClass($class)
    {
        switch ($class) {
            case self::CLASS_A1:
            case self::CLASS_A2:
            case self::CLASS_B1:
            case self::CLASS_B2:
            case self::CLASS_C1:
            case self::CLASS_C2:
            case self::CLASS_D:
            case self::CLASS_E:
                return true;
        }
        
        return false;
    }

}
