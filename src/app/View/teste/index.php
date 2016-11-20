<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?=URL_BASE;?>">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title;?></title>
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
                <h1 class="text-center">
                    <span class="glyphicon glyphicon-leaf"></span><br>microMVC
                </h1>
                <p>Microframework desenvolvido como ferramenta de estudo da linguagem de programação PHP e o uso de padrões de projeto.</p>
            </header>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?=$data;?>
                </div>
            </div>
        </div>
    </body>
</html>