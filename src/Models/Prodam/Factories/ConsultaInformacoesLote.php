<?php

namespace NFePHP\NFSe\Models\Prodam\Factories;

/**
 * Classe para a construção do XML relativo ao serviço de
 * Pedido de Consulta de Informações do Lote para os webservices
 * da Cidade de São Paulo conforme o modelo Prodam
 *
 * @category  NFePHP
 * @package   NFePHP\NFSe\Models\Prodam\Factories\ConsultaInformacoesLote
 * @copyright NFePHP Copyright (c) 2016
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse for the canonical source repository
 */

use InvalidArgumentException;
use NFePHP\NFSe\Models\Prodam\Factories\Header;
use NFePHP\NFSe\Models\Prodam\Factories\Factory;

class ConsultaInformacoesLote extends Factory
{
    public function render(
        $versao,
        $remetenteTipoDoc,
        $remetenteCNPJCPF,
        $transacao = '',
        $prestadorIM = '',
        $numeroLote = ''
    ) {
        $method = "PedidoInformacoesLote";
        $content = "<$method "
            . "xmlns:xsd=\""
            . $this->xmlnsxsd
            . "\" xmlns=\""
            . $this->xmlns
            . "\" xmlns:xsi=\""
            . $this->xmlnsxsi
            . "\">";
        $content .= Header::render(
            $versao,
            $remetenteTipoDoc,
            $remetenteCNPJCPF,
            $transacao,
            '',
            '',
            '',
            '',
            '',
            '',
            0,
            0,
            0,
            $numeroLote,
            $prestadorIM
        );
        $content .= "</$method>";
        $body = $this->oCertificate->signXML($content, $method, '', $algorithm = 'SHA1');
        $body = $this->clear($body);
        $this->validar($versao, $body, $method);
        return $body;
    }
}