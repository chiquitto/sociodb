<?php

namespace Chiquitto\Sociodb\Action\Sebraeshop;

use Chiquitto\Sociodb\Action\ActionAbstract;
use Chiquitto\Sociodb\Conexao;
use Chiquitto\Sociodb\Sebraeshop\PotencialConsumo as SebraeshopPotencialConsumo;
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
 * 
 * SQL para verificacao de tbsebraeshop_uf
 * SELECT 
    uf.cduf,
    uf.qtPopulacao2015 qtPopulacaoIbge,
    ssuf.qtPopulacaoRural,
    ssuf.qtPopulacaoUrbana,
    ssuf.qtPopulacao,
    ssuf.qtDomiciliosRuralTotal,
    ssuf.qtDomiciliosUrbanaTotal,
    ssuf.qtDomiciliosUrbanaA1,
    ssuf.qtDomiciliosUrbanaA2,
    ssuf.qtDomiciliosUrbanaB1,
    ssuf.qtDomiciliosUrbanaB2,
    ssuf.qtDomiciliosUrbanaC1,
    ssuf.qtDomiciliosUrbanaC2,
    ssuf.qtDomiciliosUrbanaD,
    ssuf.qtDomiciliosUrbanaE
FROM tbibge_uf uf
INNER JOIN tbsebraeshop_uf ssuf ON (ssuf.cdUf = uf.cdUf)
;
 */
class PotencialConsumoUf extends ActionAbstract
{

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
        SebraeshopPotencialConsumo::CATEGORY_ALIMENTACAO_DOMICILIO => ['total' => 19, 'a1' => 20, 'a2' => 21, 'b1' => 22, 'b2' => 23, 'c1' => 24, 'c2' => 236, 'd' => 25, 'e' => 26],
        SebraeshopPotencialConsumo::CATEGORY_ALIMENTACAO_FORA_DOMICILIO => ['total' => 27, 'a1' => 29, 'a2' => 30, 'b1' => 31, 'b2' => 32, 'c1' => 33, 'c2' => 237, 'd' => 34, 'e' => 28],
        SebraeshopPotencialConsumo::CATEGORY_ARTIGOS_LIMPEZA => ['total' => 37, 'a1' => 38, 'a2' => 39, 'b1' => 40, 'b2' => 41, 'c1' => 42, 'c2' => 238, 'd' => 43, 'e' => 44],
        SebraeshopPotencialConsumo::CATEGORY_BEBIDAS => ['total' => 46, 'a1' => 47, 'a2' => 48, 'b1' => 49, 'b2' => 50, 'c1' => 51, 'c2' => 239, 'd' => 52, 'e' => 53],
        SebraeshopPotencialConsumo::CATEGORY_CALCADOS => ['total' => 54, 'a1' => 55, 'a2' => 56, 'b1' => 57, 'b2' => 58, 'c1' => 59, 'c2' => 240, 'd' => 60, 'e' => 61],
        SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO => ['total' => 70, 'a1' => 71, 'a2' => 72, 'b1' => 73, 'b2' => 74, 'c1' => 75, 'c2' => 241, 'd' => 76, 'e' => 77],
        SebraeshopPotencialConsumo::CATEGORY_EQUIPAMENTOS_ELETRONICOS => ['total' => 83, 'a1' => 84, 'a2' => 85, 'b1' => 86, 'b2' => 87, 'c1' => 88, 'c2' => 242, 'd' => 89, 'e' => 90],
        SebraeshopPotencialConsumo::CATEGORY_FUMO => ['total' => 97, 'a1' => 98, 'a2' => 99, 'b1' => 100, 'b2' => 101, 'c1' => 102, 'c2' => 243, 'd' => 103, 'e' => 104],
        SebraeshopPotencialConsumo::CATEGORY_HIGIENE_CUIDADOS_PESSOAIS => ['total' => 105, 'a1' => 106, 'a2' => 107, 'b1' => 108, 'b2' => 109, 'c1' => 110, 'c2' => 244, 'd' => 111, 'e' => 112],
        SebraeshopPotencialConsumo::CATEGORY_LIVROS_MATERIAL_ESCOLAR => ['total' => 116, 'a1' => 117, 'a2' => 118, 'b1' => 119, 'b2' => 120, 'c1' => 121, 'c2' => 245, 'd' => 122, 'e' => 123],
        SebraeshopPotencialConsumo::CATEGORY_MANUTENCAO_LAR => ['total' => 124, 'a1' => 125, 'a2' => 126, 'b1' => 127, 'b2' => 128, 'c1' => 129, 'c2' => 246, 'd' => 130, 'e' => 131],
        SebraeshopPotencialConsumo::CATEGORY_MATRICULAS_MENSALIDADES => ['total' => 132, 'a1' => 133, 'a2' => 134, 'b1' => 135, 'b2' => 136, 'c1' => 137, 'c2' => 247, 'd' => 138, 'e' => 139],
        SebraeshopPotencialConsumo::CATEGORY_MEDICAMENTOS => ['total' => 140, 'a1' => 141, 'a2' => 142, 'b1' => 143, 'b2' => 144, 'c1' => 145, 'c2' => 248, 'd' => 146, 'e' => 147],
        SebraeshopPotencialConsumo::CATEGORY_MOBILIARIOS_ARTIGOS_LAR => ['total' => 148, 'a1' => 149, 'a2' => 150, 'b1' => 151, 'b2' => 152, 'c1' => 153, 'c2' => 249, 'd' => 154, 'e' => 155],
        SebraeshopPotencialConsumo::CATEGORY_OUTRAS_DESPESAS => ['total' => 156, 'a1' => 157, 'a2' => 158, 'b1' => 159, 'b2' => 160, 'c1' => 161, 'c2' => 250, 'd' => 162, 'e' => 163],
        SebraeshopPotencialConsumo::CATEGORY_OUTRAS_DESPESAS_VESTUARIO => ['total' => 164, 'a1' => 165, 'a2' => 166, 'b1' => 167, 'b2' => 168, 'c1' => 169, 'c2' => 251, 'd' => 170, 'e' => 171],
        SebraeshopPotencialConsumo::CATEGORY_OUTRAS_DESPESAS_SAUDE => ['total' => 172, 'a1' => 173, 'a2' => 174, 'b1' => 175, 'b2' => 176, 'c1' => 177, 'c2' => 252, 'd' => 178, 'e' => 179],
        SebraeshopPotencialConsumo::CATEGORY_RECREACAO_CULTURA => ['total' => 190, 'a1' => 183, 'a2' => 184, 'b1' => 185, 'b2' => 186, 'c1' => 187, 'c2' => 253, 'd' => 188, 'e' => 189],
        SebraeshopPotencialConsumo::CATEGORY_TOTAL_URBANO => ['total' => 193, 'a1' => 194, 'a2' => 195, 'b1' => 196, 'b2' => 197, 'c1' => 198, 'c2' => 254, 'd' => 199, 'e' => 200],
        SebraeshopPotencialConsumo::CATEGORY_TRANSPORTES_URBANOS => ['total' => 201, 'a1' => 204, 'a2' => 205, 'b1' => 206, 'b2' => 207, 'c1' => 208, 'c2' => 255, 'd' => 209, 'e' => 210],
        SebraeshopPotencialConsumo::CATEGORY_VEICULO_PROPRIO => ['total' => 212, 'a1' => 213, 'a2' => 214, 'b1' => 215, 'b2' => 216, 'c1' => 217, 'c2' => 256, 'd' => 218, 'e' => 219],
        SebraeshopPotencialConsumo::CATEGORY_VESTUARIO_CONFECCIONADO => ['total' => 220, 'a1' => 221, 'a2' => 222, 'b1' => 223, 'b2' => 224, 'c1' => 225, 'c2' => 257, 'd' => 226, 'e' => 227],
        SebraeshopPotencialConsumo::CATEGORY_VIAGENS => ['total' => 228, 'a1' => 229, 'a2' => 230, 'b1' => 231, 'b2' => 232, 'c1' => 233, 'c2' => 258, 'd' => 234, 'e' => 235]
    ];
    private $nrAno = 2012;
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

    private function normalizeNumber($number)
    {
        return (float) strtr($number, [
                    '.' => '',
                    ',' => '.'
        ]);
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
        
        $this->process2015();
    }
    
    private function process2015()
    {
        $conn = Conexao::getInstance()->getDoctrine();
        
        $sql = "Delete From tbsebraeshop_uf Where (nrAno = :nrAnoNovo)";
        $conn->executeUpdate($sql, array(
            ':nrAnoNovo' => 2015
        ));
        
        // Atualizar Populacao Rural e Urbana 2015
        $sql = "Insert Into tbsebraeshop_uf (cdUf, nrAno, qtPopulacaoRural, qtPopulacaoUrbana)
Select
uf.cdUf,
2015 nrAno,
Round(uf.qtPopulacao2015 / (ssuf.qtPopulacaoRural + ssuf.qtPopulacaoUrbana) * ssuf.qtPopulacaoRural) qtPopulacaoRural,
Round(uf.qtPopulacao2015 / (ssuf.qtPopulacaoRural + ssuf.qtPopulacaoUrbana) * ssuf.qtPopulacaoUrbana) qtPopulacaoUrbana
From tbsebraeshop_uf ssuf
Inner Join tbibge_uf uf On (uf.cdUf = ssuf.cdUf)
Where (ssuf.nrAno = :nrAnoAntigo)";
        
        $conn->executeUpdate($sql, array(
            ':nrAnoAntigo' => $this->nrAno
        ));
        
        // Atualizar Populacao Total e Qtd de Domicilios 2015
        $sql = "Update tbsebraeshop_uf ssuf1
Inner Join tbsebraeshop_uf ssuf2
    On (ssuf2.cdUf = ssuf1.cdUf)
    And (ssuf1.nrAno = :nrAnoAntigo)
    And (ssuf2.nrAno = :nrAnoNovo)
Set
    ssuf2.qtPopulacao = (ssuf2.qtPopulacaoRural + ssuf2.qtPopulacaoUrbana),
    ssuf2.qtDomiciliosRuralTotal = Round(ssuf2.qtPopulacaoRural / ssuf1.qtPopulacaoRural * ssuf1.qtDomiciliosRuralTotal),
    -- ssuf2.qtDomiciliosUrbanaTotal = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaTotal),
    ssuf2.qtDomiciliosUrbanaA1 = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaA1),
    ssuf2.qtDomiciliosUrbanaA2 = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaA2),
    ssuf2.qtDomiciliosUrbanaB1 = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaB1),
    ssuf2.qtDomiciliosUrbanaB2 = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaB2),
    ssuf2.qtDomiciliosUrbanaC1 = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaC1),
    ssuf2.qtDomiciliosUrbanaC2 = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaC2),
    ssuf2.qtDomiciliosUrbanaD = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaD),
    ssuf2.qtDomiciliosUrbanaE = Round(ssuf2.qtPopulacaoUrbana / ssuf1.qtPopulacaoUrbana * ssuf1.qtDomiciliosUrbanaE)";
        
        $conn->executeUpdate($sql, array(
            ':nrAnoAntigo' => $this->nrAno,
            ':nrAnoNovo' => 2015,
        ));
        
        $sql = "Update tbsebraeshop_uf
Set qtDomiciliosUrbanaTotal = (qtDomiciliosUrbanaA1 + qtDomiciliosUrbanaA2 + qtDomiciliosUrbanaB1 + qtDomiciliosUrbanaB2 + qtDomiciliosUrbanaC1 + qtDomiciliosUrbanaC2 + qtDomiciliosUrbanaD + qtDomiciliosUrbanaE)
Where (nrAno = :nrAnoNovo)";
        $conn->executeUpdate($sql, array(
            ':nrAnoNovo' => 2015
        ));
        
        $sql = "Delete From tbsebraeshop_uf_consumo Where (nrAno = :nrAnoNovo)";
        $conn->executeUpdate($sql, array(
            ':nrAnoNovo' => 2015
        ));
        
        $sql = "Insert Into tbsebraeshop_uf_consumo
(cdUf, cdCategoria, nrAno, varTotal, varA1, varA2, varB1, varB2, varC1, varC2, varD, varE)
Select
	ssufCon.cdUf,
	ssufCon.cdCategoria,
	:nrAnoNovo nrAno,
	0 varTotal,
	Round(ssufCon.varA1 * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varA1,
	Round(ssufCon.varA2 * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varA2,
	Round(ssufCon.varB1 * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varB1,
	Round(ssufCon.varB2 * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varB2,
	Round(ssufCon.varC1 * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varC1,
	Round(ssufCon.varC2 * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varC2,
	Round(ssufCon.varD * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varD,
	Round(ssufCon.varE * ssuf2015.qtPopulacaoUrbana / ssuf2012.qtPopulacaoUrbana, 2) varE
From tbsebraeshop_uf_consumo ssufCon
Inner Join tbsebraeshop_uf ssuf2012 On (ssuf2012.cdUf = ssufCon.cdUf) And (ssuf2012.nrAno = :nrAnoAntigo)
Inner Join tbsebraeshop_uf ssuf2015 On (ssuf2015.cdUf = ssufCon.cdUf) And (ssuf2015.nrAno = :nrAnoNovo)
Where (ssufCon.nrAno = :nrAnoAntigo)";
        $conn->executeUpdate($sql, array(
            ':nrAnoAntigo' => $this->nrAno,
            ':nrAnoNovo' => 2015,
        ));
        
        $sql = "Update tbsebraeshop_uf_consumo
Set varTotal = (varA1 + varA2 + varB1 + varB2 + varC1 + varC2 + varD + varE)
Where (nrAno = :nrAnoNovo)";
        $conn->executeUpdate($sql, array(
            ':nrAnoNovo' => 2015
        ));
        
        $conn->commit();
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
                $r[$varCategoria][$varClasse] = $this->normalizeNumber($spanNode->textContent);
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
                    $r['total'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label4':
                    $r['urbana'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label5':
                    $r['rural'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label6':
                    $r['masculino'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label7':
                    $r['feminino'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label15':
                    $r['alfabetizada'] = $this->normalizeNumber($spanNode->textContent);
                    break;
            }
        }

        return $r;
    }
    
    private function processTableDomGeral()
    {
        $query = new Query();
        $res = $query->execute('#FormView1 table[border="0"][cellpadding="2"][cellspacing="0"] span[id*="FormView1_Label"]', $this->domDocument, Query::TYPE_CSS);

        $r = [];

        // Extrair valores
        /* @var $spanNode DOMElement */
        foreach ($res as $key => $spanNode) {
            switch ($spanNode->attributes->getNamedItem('id')->value) {
                case 'FormView1_Label78':
                    $r['domicilios-rural'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label79':
                    $r['domicilios-total'] = $this->normalizeNumber($spanNode->textContent);
                    break;
                case 'FormView1_Label80':
                    $r['domicilios-urbana'] = $this->normalizeNumber($spanNode->textContent);
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
        $r['geral'] = $this->processTableDomGeral();
        $r['categoria-consumo'] = $this->processTableDomCategoriaConsumo();

        $sqlDelete = "Delete From tbsebraeshop_uf Where (cdUf = :cdUf)";

        $sqlInsert = "INSERT INTO tbsebraeshop_uf (cdUf, nrAno, qtPopulacaoRural, qtPopulacaoUrbana, qtPopulacao, qtDomiciliosRuralTotal, qtDomiciliosUrbanaTotal, qtDomiciliosUrbanaA1, qtDomiciliosUrbanaA2, qtDomiciliosUrbanaB1, qtDomiciliosUrbanaB2, qtDomiciliosUrbanaC1, qtDomiciliosUrbanaC2, qtDomiciliosUrbanaD, qtDomiciliosUrbanaE) VALUES (:cdUf, :nrAno, :qtPopulacaoRural, :qtPopulacaoUrbana, :qtPopulacao, :qtDomiciliosRuralTotal, :qtDomiciliosUrbanaTotal, :qtDomiciliosUrbanaA1, :qtDomiciliosUrbanaA2, :qtDomiciliosUrbanaB1, :qtDomiciliosUrbanaB2, :qtDomiciliosUrbanaC1, :qtDomiciliosUrbanaC2, :qtDomiciliosUrbanaD, :qtDomiciliosUrbanaE)";

        $conn = Conexao::getInstance()->getDoctrine();

        $conn->executeQuery("Delete From tbsebraeshop_uf Where (cdUf = :cdUf)", array(
            ':cdUf' => $cdUf,
        ));

        $conn->executeQuery("Delete From tbsebraeshop_uf_consumo Where (cdUf = :cdUf)", array(
            ':cdUf' => $cdUf,
        ));

        $st = $conn->prepare($sqlInsert);
        $st->bindValue(':cdUf', $cdUf);
        $st->bindValue(':nrAno', $this->nrAno);
        $st->bindValue(':qtPopulacaoRural', $r['pop']['rural']);
        $st->bindValue(':qtPopulacaoUrbana', $r['pop']['urbana']);
        $st->bindValue(':qtPopulacao', $r['pop']['total']);
        $st->bindValue(':qtDomiciliosRuralTotal', $r['geral']['domicilios-rural']);
        $st->bindValue(':qtDomiciliosUrbanaTotal', $r['geral']['domicilios-urbana']);
        // $st->bindValue(':qtDomiciliosTotal', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['total']);
        $st->bindValue(':qtDomiciliosUrbanaA1', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['a1']);
        $st->bindValue(':qtDomiciliosUrbanaA2', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['a2']);
        $st->bindValue(':qtDomiciliosUrbanaB1', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['b1']);
        $st->bindValue(':qtDomiciliosUrbanaB2', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['b2']);
        $st->bindValue(':qtDomiciliosUrbanaC1', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['c1']);
        $st->bindValue(':qtDomiciliosUrbanaC2', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['c2']);
        $st->bindValue(':qtDomiciliosUrbanaD', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['d']);
        $st->bindValue(':qtDomiciliosUrbanaE', $r['categoria-consumo'][SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO]['e']);
        $st->execute();
        unset($st);

        $sqlInsert = "INSERT INTO tbsebraeshop_uf_consumo
            (cdUf, cdCategoria, nrAno, varTotal, varA1, varA2, varB1, varB2, varC1, varC2, varD, varE) VALUES
            (:cdUf, :cdCategoria, :nrAno, :varTotal, :varA1, :varA2, :varB1, :varB2, :varC1, :varC2, :varD, :varE)";

        foreach ($r['categoria-consumo'] as $cdCategoria => $categoriaConsumo) {
            if ($cdCategoria == SebraeshopPotencialConsumo::CATEGORY_DOMICILIO_URBANO) {
                continue;
            } elseif ($cdCategoria == SebraeshopPotencialConsumo::CATEGORY_TOTAL_URBANO) {
                continue;
            }
            
            $st = $conn->prepare($sqlInsert);
            $st->bindValue(':cdUf', $cdUf);
            $st->bindValue(':cdCategoria', $cdCategoria);
            $st->bindValue(':nrAno', $this->nrAno);
            $st->bindValue(':varTotal', $categoriaConsumo['total']);
            $st->bindValue(':varA1', $categoriaConsumo['a1']);
            $st->bindValue(':varA2', $categoriaConsumo['a2']);
            $st->bindValue(':varB1', $categoriaConsumo['b1']);
            $st->bindValue(':varB2', $categoriaConsumo['b2']);
            $st->bindValue(':varC1', $categoriaConsumo['c1']);
            $st->bindValue(':varC2', $categoriaConsumo['c2']);
            $st->bindValue(':varD', $categoriaConsumo['d']);
            $st->bindValue(':varE', $categoriaConsumo['e']);
            $st->execute();
            unset($st);
        }

        $conn->commit();
    }

}
