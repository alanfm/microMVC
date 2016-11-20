<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?=URL_BASE;?>">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Página não encontrada</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <style>
            body {
                margin-top: 1rem;
            }
            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                background-color: #f0f0f0;
                padding-top: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="jumbotron">
                <h1 class="text-center"><?=$erro;?></h1>
                <h2 class="text-center"><?=$message;?></h2>
            </header>
        </div>
        <div class="container">
             <div class="row">
                 <div class="col-md-12 text-center">
                     <h3 class="text-center">Desculpe o transtorno!</h3>
                     <p>Você pode retornar para página inicial ou tentar recarregar essa página.</p>
                     <div class="btn-group" role="group" aria-label="...">
                        <a href="<?=URL_BASE;?>" class="btn btn-lg btn-success">
                            <span class="glyphicon glyphicon-chevron-left"></span>&nbsp;
                            Voltar para página inicial!
                        </a>
                        <a href="<?=\System\System::correntURL();?>" class="btn btn-lg btn-info">
                            <span class="glyphicon glyphicon-refresh"></span>&nbsp;
                            Recarregar a página!
                        </a>
                     </div>
                 </div>
             </div>
        </div>     
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Copyright GPL &copy; 2016<br>
                            Desenvolvido por <strong>Alan Freire</strong>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>