<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background-color: aquamarine;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }

        .container {
            width: 500px;
            max-width: 100%;
        }

        .row {
            display: flex;
        }

        h1 {
            color: brown;
        }

        h2 {
            color: green;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Titolo: {{ $post->title }}</h1>
            <h2>Contenuto: {{ $post->content }}</h2>
            <img src="{{ asset("storage/$post->image") }}" alt=" altner">
        </div>
    </div>
</body>

</html>
