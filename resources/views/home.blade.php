<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ai Detector</h1>

    <form action="{{ route('check')  }}" method="post">
        <div>
            <label for="content">Enter The Text :</label>
            <textarea name="content" id="" cols="30" rows="3"></textarea>
        </div>
        <div>
            <input type="submit" value="check">
        </div>
    </form>
</body>
</html>
