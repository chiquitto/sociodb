<?php

namespace Chiquitto\Sociodb\Action\Sebraeshop;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use DOMElement;
use PDO;
use Zend\Dom\Document;
use Zend\Dom\Document\Query;

/**
 * @link http://www.sebraeshop.com.br/potencial_consumo/
 * @link http://www.sebraeshop.com.br/potencial_consumo/IPCDocumentos/Metodologia_IPC_Maps_2012.pdf
 * Potencial de Consumo
 * 
 * Esta base contempla o consumo das populações urbanas e rurais, com análise individual de 21 categorias de consumo, classificadas por classe econômica de A a E. Traz, também, dados demográficos de todos os municípios do Brasil.
 * As informações foram atualizadas para 2012, detalhadas para todos os municípios. Com essas informações as empresas e candidatos a empreendedores dispõem de subsídios para embasar os seus planejamentos, seja na área comercial, de serviços ou outras áreas em que se façam necessárias. Contém ainda um ranking dos municípios brasileiros segundo o seu Potencial de Consumo.
 */
class PotencialConsumo extends ActionAbstract
{

    const CATEGORIA_ALIMENTACAO_DOMICILIO = 'ALIMENTACAO_DOMICILIO';
    const CATEGORIA_ALIMENTACAO_FORA_DOMICILIO = 'ALIMENTACAO_FORA_DOMICILIO';
    const CATEGORIA_ARTIGOS_LIMPEZA = 'ARTIGOS_DE_LIMPEZA';
    const CATEGORIA_BEBIDAS = 'BEBIDAS';
    const CATEGORIA_CALCADOS = 'CALCADOS';
    const CATEGORIA_EQUIPAMENTOS_ELETRONICOS = 'EQUIPAMENTOS_ELETRONICOS';
    const CATEGORIA_FUMO = 'FUMO';
    const CATEGORIA_HIGIENE_CUIDADOS_PESSOAIS = 'HIGIENE_CUIDADOS_PESSOAIS';
    const CATEGORIA_LIVROS_MATERIAL_ESCOLAR = 'LIVROS_E_MATERIAL_ESCOLAR';
    const CATEGORIA_MANUTENCAO_LAR = 'MANUTENCAO_DO_LAR';
    const CATEGORIA_MATRICULAS_MENSALIDADES = 'MATRICULAS_E_MENSALIDADES';
    const CATEGORIA_MEDICAMENTOS = 'MEDICAMENTOS';
    const CATEGORIA_MOBILIARIOS_ARTIGOS_LAR = 'MOBILIARIOS_ARTIGOS_DO_LAR';
    const CATEGORIA_OUTRAS_DESPESAS = 'OUTRAS_DESPESAS';
    const CATEGORIA_OUTRAS_DESPESAS_VESTUARIO = 'OUTRAS_DESPESAS_DE_VESTUARIO';
    const CATEGORIA_OUTRAS_DESPESAS_SAUDE = 'OUTRAS_DESPESAS_DE_SAUDE';
    const CATEGORIA_RECREACAO_CULTURA = 'RECREACAO_E_CULTURA';
    const CATEGORIA_TOTAL_URBANO = 'TOTAL_URBANO';
    const CATEGORIA_TRANSPORTES_URBANOS = 'TRANSPORTES_URBANOS';
    const CATEGORIA_VEICULO_PROPRIO = 'VEICULO_PROPRIO';
    const CATEGORIA_VESTUARIO_CONFECCIONADO = 'VESTUARIO_CONFECCIONADO';
    const CATEGORIA_VIAGENS = 'VIAGENS';

    private $assoc = [
        11 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=08w9pSZvzTo=',
        12 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=RM6O3EdDSeA=',
        13 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=aDZu4PX1DRM=',
        14 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=X/WogTHA/5M=',
        15 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=zTw6LkbrGeY=',
        16 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=VaUYtC8wYgA=',
        17 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=BIFEjsJo9NA=',
        21 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=0M3ZWKl2cDU=',
        22 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=NOm1HMJi0V4=',
        23 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=KmxaINm5CMc=',
        24 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=z6RRmxv2Orc=',
        25 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=QRkds66ztzg=',
        26 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=qEQTzzg7+nA=',
        27 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=y1BhMgbQxYw=',
        28 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=TuvR3fPW1hU=',
        29 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=/f5dAkeNUPw=',
        31 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=gHOfL8Z8AM0=',
        32 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=6NjZsBHddso=',
        33 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=BsECwXpTUUM=',
        35 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=4y229MA9zgw=',
        41 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=ROPcURoFSyg=',
        42 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=K3sFhQyZsRM=',
        43 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=8fqu/TRZSMA=',
        50 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=l1WjlT8Cq4U=',
        51 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=UN6CEJw487w=',
        52 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=xbVFztVk/KU=',
        53 => 'http://www.sebraeshop.com.br/potencial_consumo/Detalhes.aspx?cod=3BQApNgEfZM=&uf=0MfNHs/Kp94=',
    ];

    /**
     *
     * @var Query
     */
    private $domDocument;
    private $mapaCategorias = [
        self::ALIMENTACAO_DOMICILIO => ['TOTAL' => 19, 'a1' => 20, 'a2' => 21, 'b1' => 22, 'b2' => 23, 'c1' => 24, 'c2' => 236, 'd' => 25, 'e' => 26],
        self::ALIMENTACAO_FORA_DOMICILIO => ['TOTAL' => 27, 'a1' => 29, 'a2' => 30, 'b1' => 31, 'b2' => 32, 'c1' => 33, 'c2' => 237, 'd' => 34, 'e' => 28],
        self::ARTIGOS_LIMPEZA => ['TOTAL' => 37, 'a1' => 38, 'a2' => 39, 'b1' => 40, 'b2' => 41, 'c1' => 42, 'c2' => 238, 'd' => 43, 'e' => 44],
        self::BEBIDAS => ['TOTAL' => 46, 'a1' => 47, 'a2' => 48, 'b1' => 49, 'b2' => 50, 'c1' => 51, 'c2' => 239, 'd' => 52, 'e' => 53],
        self::CALCADOS => ['TOTAL' => 54, 'a1' => 55, 'a2' => 56, 'b1' => 57, 'b2' => 58, 'c1' => 59, 'c2' => 240, 'd' => 60, 'e' => 61],
        //self::DOMICILIO_URBANO => ['TOTAL' => 70, 'a1' => 71, 'a2' => 72, 'b1' => 73, 'b2' => 74, 'c1' => 75, 'c2' => 241, 'd' => 76, 'e' => 77],
        self::EQUIPAMENTOS_ELETRONICOS => ['TOTAL' => 83, 'a1' => 84, 'a2' => 85, 'b1' => 86, 'b2' => 87, 'c1' => 88, 'c2' => 242, 'd' => 89, 'e' => 90],
        self::FUMO => ['TOTAL' => 97, 'a1' => 98, 'a2' => 99, 'b1' => 100, 'b2' => 101, 'c1' => 102, 'c2' => 243, 'd' => 103, 'e' => 104],
        self::HIGIENE_CUIDADOS_PESSOAIS => ['TOTAL' => 105, 'a1' => 106, 'a2' => 107, 'b1' => 108, 'b2' => 109, 'c1' => 110, 'c2' => 244, 'd' => 111, 'e' => 112],
        self::LIVROS_MATERIAL_ESCOLAR => ['TOTAL' => 116, 'a1' => 117, 'a2' => 118, 'b1' => 119, 'b2' => 120, 'c1' => 121, 'c2' => 245, 'd' => 122, 'e' => 123],
        self::MANUTENCAO_LAR => ['TOTAL' => 124, 'a1' => 125, 'a2' => 126, 'b1' => 127, 'b2' => 128, 'c1' => 129, 'c2' => 246, 'd' => 130, 'e' => 131],
        self::MATRICULAS_MENSALIDADES => ['TOTAL' => 132, 'a1' => 133, 'a2' => 134, 'b1' => 135, 'b2' => 136, 'c1' => 137, 'c2' => 247, 'd' => 138, 'e' => 139],
        self::MEDICAMENTOS => ['TOTAL' => 140, 'a1' => 141, 'a2' => 142, 'b1' => 143, 'b2' => 144, 'c1' => 145, 'c2' => 248, 'd' => 146, 'e' => 147],
        self::MOBILIARIOS_ARTIGOS_LAR => ['TOTAL' => 148, 'a1' => 149, 'a2' => 150, 'b1' => 151, 'b2' => 152, 'c1' => 153, 'c2' => 249, 'd' => 154, 'e' => 155],
        self::OUTRAS_DESPESAS => ['TOTAL' => 156, 'a1' => 157, 'a2' => 158, 'b1' => 159, 'b2' => 160, 'c1' => 161, 'c2' => 250, 'd' => 162, 'e' => 163],
        self::OUTRAS_DESPESAS_VESTUARIO => ['TOTAL' => 164, 'a1' => 165, 'a2' => 166, 'b1' => 167, 'b2' => 168, 'c1' => 169, 'c2' => 251, 'd' => 170, 'e' => 171],
        self::OUTRAS_DESPESAS_SAUDE => ['TOTAL' => 172, 'a1' => 173, 'a2' => 174, 'b1' => 175, 'b2' => 176, 'c1' => 177, 'c2' => 252, 'd' => 178, 'e' => 179],
        self::RECREACAO_CULTURA => ['TOTAL' => 190, 'a1' => 183, 'a2' => 184, 'b1' => 185, 'b2' => 186, 'c1' => 187, 'c2' => 253, 'd' => 188, 'e' => 189],
        // self::TOTAL_URBANO => ['TOTAL' => 193, 'a1' => 194, 'a2' => 195, 'b1' => 196, 'b2' => 197, 'c1' => 198, 'c2' => 254, 'd' => 199, 'e' => 200],
        self::TRANSPORTES_URBANOS => ['TOTAL' => 201, 'a1' => 204, 'a2' => 205, 'b1' => 206, 'b2' => 207, 'c1' => 208, 'c2' => 255, 'd' => 209, 'e' => 210],
        self::VEICULO_PROPRIO => ['TOTAL' => 212, 'a1' => 213, 'a2' => 214, 'b1' => 215, 'b2' => 216, 'c1' => 217, 'c2' => 256, 'd' => 218, 'e' => 219],
        self::VESTUARIO_CONFECCIONADO => ['TOTAL' => 220, 'a1' => 221, 'a2' => 222, 'b1' => 223, 'b2' => 224, 'c1' => 225, 'c2' => 257, 'd' => 226, 'e' => 227],
        self::VIAGENS => ['TOTAL' => 228, 'a1' => 229, 'a2' => 230, 'b1' => 231, 'b2' => 232, 'c1' => 233, 'c2' => 258, 'd' => 234, 'e' => 235]
    ];
    private $tmpDirPath;
    private $tmpFilePath;

    private function loadFile($cdUf)
    {
        $filePath = strtr($this->tmpFilePath, [
            '{UF}' => $cdUf
        ]);

        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
        } else {
            $url = $this->assoc[$cdUf];
            $content = file_get_contents($url);

            // @link http://stackoverflow.com/questions/6941642/php-json-decode-fails-without-quotes-on-key
            // $content = str_replace(array('"', "'"), array('\"', '"'), $content);
            $content = preg_replace('/(\w+):/i', '"\1":', $content);

            if (!is_dir($this->tmpDirPath)) {
                mkdir($this->tmpDirPath, 0777, true);
            }

            file_put_contents($filePath, $content);
        }

        return $content;
    }

    public function process(array $params = array())
    {
        $this->tmpDirPath = SOCIODB_PATH_TMP . '/sebraeshop/uf';
        $this->tmpFilePath = $this->tmpDirPath . '/{UF}.html';

        $conn = Conexao::getInstance()->getDoctrine();
        $ufRowset = $conn->query('SELECT cdUf, stSigla From tbsuf');

        while ($ufRow = $ufRowset->fetch(PDO::FETCH_ASSOC)) {
            $this->processUf($ufRow['cdUf']);
        }
    }

    /**
     * Script utilizado para gerar o $mapa
     * 
     * <script>
      var trs = document.querySelectorAll('table[width="1000px"] tr');
      var r = [];
      for (var tri in trs) {
      if ((tri == 0) || (tri == 'length') || (tri == 'item')) {
      continue;
      }
      var tr = trs[tri];

      var rr = [];
      var spans = tr.querySelectorAll('span', tr);
      for (var spani in spans) {
      var key = '';
      switch (spani) {
      case '0':
      key = 'total';
      break;
      case '1':
      key = 'a1';
      break;
      case '2':
      key = 'a2';
      break;
      case '3':
      key = 'b1';
      break;
      case '4':
      key = 'b2';
      break;
      case '5':
      key = 'c1';
      break;
      case '6':
      key = 'c2';
      break;
      case '7':
      key = 'd';
      break;
      case '8':
      key = 'e';
      break;
      }
      if (key != '') {
      rr.push("'" + key + "' => " + spans[spani].id.substring(15));
      }
      }

      var t = tr.querySelector('strong[class="texto_corrido_NI"]').innerHTML;
      t = t.toLowerCase().replace(/,/g, '').replace(/ /g, '_');

      r.push("'" + t + "' => [" + rr.join(", ") + "]");
      }
      console.log("[\n\t" + r.join(",\n\t") + "\n]");
      </script>
     * 
     * @return type
     */
    private function processTableDomCategoriaConsumo()
    {
        $query = new Query();
        $res = $query->execute('#FormView1 table[width="1000px"] span[id*="FormView1_Label"]', $this->domDocument, Query::TYPE_CSS);

        $r = [];

        foreach ($res as $key => $spanNode) {
            $id = substr($spanNode->attributes->getNamedItem('id')->value, 15);

            $ok = false;
            foreach ($this->mapaCategorias as $varCategoria => $itens) {
                foreach ($itens as $varClasse => $idActual) {
                    if ($idActual == $id) {
                        $ok = true;
                        break;
                    }
                }

                if ($ok) {
                    break;
                }
            }

            if ($ok) {
                $r[$varCategoria][$varClasse] = strtr($spanNode->textContent, [
                        //'.' => '',
                        //',' => '.'
                ]);
            }
        }

        return $r;
    }

    private function processTableDomPopulacao()
    {
        $query = new Query();
        $res = $query->execute('#FormView1 table[width="44%"] span[id*="FormView1_Label"]', $this->domDocument, Query::TYPE_CSS);

        $r = [];

        // Extrair valores
        /* @var $spanNode DOMElement */
        foreach ($res as $key => $spanNode) {
            switch ($spanNode->attributes->getNamedItem('id')->value) {
                case 'FormView1_Label3':
                    $r['total'] = $spanNode->textContent;
                    break;
                case 'FormView1_Label4':
                    $r['urbana'] = $spanNode->textContent;
                    break;
                case 'FormView1_Label5':
                    $r['rural'] = $spanNode->textContent;
                    break;
                case 'FormView1_Label6':
                    $r['masculino'] = $spanNode->textContent;
                    break;
                case 'FormView1_Label7':
                    $r['feminino'] = $spanNode->textContent;
                    break;
                case 'FormView1_Label15':
                    $r['alfabetizada'] = $spanNode->textContent;
                    break;

                default:
                    break;
            }
        }

        return $r;
    }

    private function processUf($cdUf)
    {
        $html = $this->loadFile($cdUf);
        $this->domDocument = new Document($html, Document::DOC_XHTML);

        $r = [];
        $r['pop'] = $this->processTableDomPopulacao();
        $r['categoria-consumo'] = $this->processTableDomCategoriaConsumo();

        //die('<pre>' . __FILE__ . ' in line ' . __LINE__ . "\n" . print_r($r, TRUE));
    }

}
