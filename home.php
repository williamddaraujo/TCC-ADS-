<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITE | GN</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1; /* Coloca o vídeo atrás do conteúdo */
        }
        #background-video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Faz o vídeo cobrir a área sem distorção */
            transform: translate(-50%, -50%);
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            color: white;
        }
        .box {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 179, 102, 0.6);
            padding: 30px;
            border-radius: 10px;
        }
        a {
            text-decoration: none;
            color: white;
            border: 1px solid  #ffa64d;
            Font-size:50px;

            border-radius: 10px;
            padding: 6px;
            display: inline-block;
            margin: 1px;
        }
        a:hover {
            background-color: dodgerblue;
        }

        h1{font-size:150px;}
    </style>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop id="background-video">
            <source src="img/home2.mp4" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
        </video>
    </div>
    <h1>Portal do Professor</h1>
    <div class="box">
        <a href="login.php">Login</a>
        
    </div>
</body>
</html>
