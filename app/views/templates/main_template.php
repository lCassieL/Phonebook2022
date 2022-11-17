<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="grid">
    <?php
        include_once 'app/views/pages/'.$this->page.'.php'; 
    ?>
    </div>
    <script src="/js/main.js"></script>
</body>
</html>