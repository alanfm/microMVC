<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?=URL_BASE;?>">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title;?></title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
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
                <h1 class="text-center">
                    <span class="glyphicon glyphicon-leaf"></span><br>microMVC
                </h1>
                <p>Microframework desenvolvido como ferramenta de estudo da linguagem de programação PHP e o uso de padrões de projeto.</p>
            </header>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Você está na página inicial.</p>
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