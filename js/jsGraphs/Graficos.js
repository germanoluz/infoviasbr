/*	InfoviasBR - Dados abertos sobre trânsito em rodovias federais
	Copyright 2013 Equipe InfoviasBR (II Concurso de Aplicativos Abertos do MJ/W3C)
			| Germano Luz: germanoluz@hotmail.com
			| Fábio Françoso: fabio.francoso@outlook.com
			| Halaés Nobre: h.nobre@gmail.com
			| Cássia Sousa: cassinhasousa@gmail.com

	InfoviasBR é um software livre; você pode redistribui-lo e/ou modifica-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF); na versão AGPL v.3.
    InfoviasBR é distribuido na esperança que possa ser  util, mas SEM NENHUMA GARANTIA; sem uma garantia implicita de ADEQUAÇÂO a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR.
    Veja a Licença Pública Geral GNU para maiores detalhes.
    Você deve ter recebido uma cópia da Licença Pública Geral GNU junto com este programa, se não, visite: http://www.infoviasbr.com.br/licenca
	Para obter uma cópia integral do código-fonte visite: http://github.com/infoviasbr
*/

/*********************************************************************************/
/* Inserção de todos os scripts dos gráficos                                     */
/*********************************************************************************/

/*	document.write(unescape("%3Cscript src='jsGraphs/ConsCausaDeAcidentes.js' type='text/javascript'%3E%3C/script%3E"));*/

function include(file)
{

  var script  = document.createElement('script');
  script.src  = file;
  script.type = 'text/javascript';
  script.defer = true;

  document.getElementsByTagName('head').item(0).appendChild(script);

}

/* include any js files here */
include('ConsCausaDeAcidentes.js');
include('ConsCausaDeAcidentes2.js');
include('ConsCausaDeAcidentes3.js');

