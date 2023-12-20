<?php 
    require "./biblioteca/PHPMailer/Exception.php";
    require "./biblioteca/PHPMailer/OAuthTokenProvider.php";
    require "./biblioteca/PHPMailer/OAuth.php";
    require "./biblioteca/PHPMailer/PHPMailer.php";
    require "./biblioteca/PHPMailer/POP3.php";
    require "./biblioteca/PHPMailer/SMTP.php";
    require "./biblioteca/PHPMailer/DSNConfigurator.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


class Mensagem {

    private $nome_completo = null;

    private $email = null;

    private $assunto = null;

    private $mensagem = null;

    private $colecaoDados = array();

    public $status = array('codigo_status' => null, 'descricao_status' => '');



    public function __get($atributo)
    {
        return $this->$atributo;
    }



    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function validaMensagem() {

        if (empty($this->nome_completo) or empty($this->email) or empty($this->assunto) or empty($this->mensagem)) {

            return false;
        }

        return true;
    }
    
}


// acessando métodos da classe
$mensagem = new Mensagem();

$mensagem->__set('nome_completo', $_REQUEST['nome_completo']);

$mensagem->__set('email', $_REQUEST['email']);

$mensagem->__set('assunto', $_REQUEST['assunto']);

$mensagem->__set('mensagem', $_REQUEST['mensagem']);

//$mensagem->__set('email', $_REQUEST[$colecaoDados(0)]);


// validador dos campos
if (!$mensagem->validaMensagem()) {
    
    echo 'Mensagem não é Válida';
    die();
}

// Foi inserido em variaveis os dados coletados para melhor os inserir na mensagem dos emails. Vede a inserção no try: $mail->Body 
$conteudo_body_mensagem = $mensagem->__get('mensagem');
$conteudo_body_nome_completo = $mensagem->__get('nome_completo');
$conteudo_body_email = $mensagem->__get('email');


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'garanhunscaruaruhbpay@gmail.com';                     //SMTP username
    $mail->Password   = 'cctgqatddqgclbau';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Charset
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    //Recipients
    $mail->setFrom('garanhunscaruaruhbpay@gmail.com');
    $mail->addAddress('arquivos2.itsolucoes@gmail.com');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('luannogueira093@gmail.com');
    // $mail->addCC('luannogueira093@gmail.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body    = "Um usuário recebeu uma mensagem com os seguintes dados, <strong>Email: </strong> " . $conteudo_body_email . ' <strong>Nome Completo: </strong>' . $conteudo_body_nome_completo . '</br>' . ' <strong>Mensagem: </strong> ' . $conteudo_body_mensagem;
    $mail->AltBody = 'Para ler essa mensagem se é necessário usar um Client que leia HTML.';

    $mail->send();

    $mensagem->status['codigo_status'] = 1;
    $mensagem->status['descricao_status'] = 'Mensagem Enviada, agradecemos por sua confiança, assim que possível entraremos em contato.';

} catch (Exception $e) {

    $mensagem->status['codigo_status'] = 2;
    $mensagem->status['descricao_status'] = 'Mensagem Não Enviada, por favor tente mais tarde!' . $mail->ErrorInfo;
    
}

?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	
    <title>FUNPREVI - Fundo de Previdência de Iguaracy</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-finance-business.css">
    <link rel="stylesheet" href="assets/css/owl.css">

	
	<!-- ferramenta de acessibilidade -->
	<script>(function(d){var s = d.createElement("script");s.setAttribute("data-account", "tVphZsK25S");s.setAttribute("src", "https://cdn.userway.org/widget.js");(d.body || d.head).appendChild(s);})(document)</script><noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website accessibility</a></noscript>
    
	<div id="preloader">
        <div class="jumper">
            
        </div>
    </div>  

    <!-- Header -->

	<div id="topo" class="sub-header">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <ul class="left-info">
              <li><a href="index.html" accesskey="1"><b class="badge badge-rounded badge-light">1</b> Ir para o inicio</a></li>
              
            </ul>
          </div>
        </div>
      </div>
    </div> 


    <!-- Banner Ends Here -->
	<div id="conteudo" class="more-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5">
            <div class="more-info-content">
              <div class="row">
                <div class="col-md-12">
				</div>
                <div class="col-md-12">
                  <div class="right-content text-center">

                  <img src="assets/images/funprevi-1.png" alt="Fundo de Previdencia de Iguaracy" width="500px" height="110px">

                  <?php if ($mensagem->status['codigo_status'] == 1) { ?>

                    <h2>Sua mensagem <em>foi enviada com Sucesso</em></h2>
                     
                    <p> <?php echo $mensagem->status['descricao_status']?> </p>

                     <a href="index.html" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>

                  <?php }?>

                  <?php if ($mensagem->status['codigo_status'] == 2){ ?>

                    <h2>Erro <em>no envio da sua mensagem!</em></h2>

                    <p> <?php echo $mensagem->status['descricao_status'] ?> </p>

                    <a href="index.html" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>

                 <?php }?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>




    <!-- Footer Starts Here -->
    <footer id="rodape">
      <div class="container">
        <div class="row">
          <div class="col-md-3 footer-item">
            <h4>Atendimento</h4>
			<ul class="menu-list">
              <li><i class="fas fa-map-marked-alt mr-2"></i><a href="https://goo.gl/maps/JUQUTsywck82qP1s6">Praça Antônio Rabelo, 03 – Centro, Iguaracy - PE, 56840-000</a></li>
              <li><i class="fas fa-envelope"></i><a href="#"> previdencia@iguaracy.pe.gov.br</a></li>
              <li><i class="fas fa-calendar-alt"></i><a> Segunda à Sexta 07h00 às 13h00</a></li>
              <li><i class="fas fa-phone"></i><a> Telefone: (87) 3837-1156</a></li>
            
            </ul>            
			<ul class="social-icons">
              <li><a rel="nofollow" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          <div class="col-md-3 footer-item">
            <h4>Institucionais</h4>
            <ul class="menu-list">
              <li><a href="https://www.iguaracy.pe.gov.br" target="_blank">Prefeitura Municipal de Iguaracy</a></li>
              <li><a href="https://iguaracy.pe.leg.br" target="_blank">Câmara Municipal de Iguaracy</a></li>
              <li><a href="https://www.pe.gov.br/portal-governo-pe/"  target="_blank">Governo do Estado</a></li>
              <li><a href="#"target="_blank">Ministério da Previdência Social</a></li>
            </ul>
          </div>
          <div class="col-md-3 footer-item">
            <h4>Links Úteis</h4>
            <ul class="menu-list">
              <li><a href="https://it-solucoes.com/transparenciaMunicipal/carregaPortalCM.aspx?ID=41&e=F" target="_blank">Portal da Transparência</a></li>
              <li><a href="http://www.it-solucoes.com/transparenciaMunicipal/consultaPrestacaoContas.aspx?ID=41&e=F" target="_blank">Prestação de Contas</a></li>
              <li><a href="https://it-solucoes.com/transparenciaMunicipal/solicitaInformacao.aspx?ID=41&e=F" target="_blank">E-Sic - Serviço Eletrônico de Informação ao Cidadão</a></li>
              <li><a href="http://www.it-solucoes.com/contrachequeweb/autenticaservidor.aspx?id=41" target="_blank">Emissão do Contra-Cheque</a></li>

            </ul>
          </div>
         <div class="col-md-3 footer-item">
            <h4>&nbsp </h4>
            <ul class="menu-list">
              <li><a href="http://www.it-solucoes.com/transparenciaMunicipal/frmAtosOficiais.aspx?ID=41&e=F" target="_blank">Atos Oficiais</a></li>
              <li><a href="politicas-privacidade.html">Politicas de Privacidade</a></li>
              <li><a href="http://www.it-solucoes.com/transparenciaMunicipal/retornaDadosVisualizacao.aspx?ID=41&sessao=publicacao&e=F" target="_blank">Atos Oficiais</a></li>
			        <li><a href="https://www.it-solucoes.com/transparenciaMunicipal/frmCartaServico.aspx?ID=41&e=F" target="_blank">Carta de Serviço</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    
    <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Fundo de Previdência do Município de Iguaracy
          </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; 
      function clearField(t){                   
      if(! cleared[t.id]){                      
          cleared[t.id] = 1;  
          t.value='';         
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>