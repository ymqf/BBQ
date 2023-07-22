<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>表白墙</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    .message {
      background-color: #f5f5f5;
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 10px;
    }

    .sender {
      font-weight: bold;
    }

    .content {
      margin-top: 5px;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 5px;
      border: 1px solid #ddd;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .pagination {
      text-align: center;
      margin-top: 20px;
    }

    .pagination a {
      display: inline-block;
      padding: 5px 10px;
      background-color: #f5f5f5;
      border: 1px solid #ddd;
      margin-right: 5px;
      text-decoration: none;
      color: #333;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: #fff;
    }
  </style>
</head>
<body>
  <h1>表白墙</h1>
  <div>
    <?php
    $file = fopen("messages.txt", "r");
    if ($file === false) {
      echo '无法打开文件';
      exit;
    }

    $messages = array();
    while (($line = fgets($file)) !== false) {
      $messages[] = $line;
    }

    fclose($file);

    $messagesPerPage = 20; // 每页展示的表白数量
    $totalMessages = count($messages);
    $totalPages = ceil($totalMessages / $messagesPerPage);

    if (isset($_GET['page'])) {
      $currentPage = $_GET['page'];
    } else {
      $currentPage = 1;
    }

    $startIndex = ($currentPage - 1) * $messagesPerPage;
    $endIndex = $startIndex + $messagesPerPage;

    for ($i = $startIndex; $i < $endIndex; $i++) {
      if (isset($messages[$i])) {
        echo '<div class="message">' . $messages[$i] . '</div>';
      }
    }
    ?>
  </div>
  <div class="pagination">
    <?php
    for ($page = 1; $page <= $totalPages; $page++) {
      echo '<a href="?page=' . $page . '" ' . ($currentPage == $page ? 'class="active"' : '') . '>' . $page . '</a>';
    }
    ?>
  </div>
  <form action="save_message.php" method="POST">
    <label for="sender">发送者：</label>
    <input type="text" name="sender" id="sender" required><br>
    <label for="content">表白内容：</label>
    <textarea name="content" id="content" required></textarea><br>
    <input type="submit" value="提交">
  </form>
  <script>
    // 自动返回首页并刷新
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>
</html>
