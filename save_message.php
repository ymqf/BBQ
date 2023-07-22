<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sender = $_POST['sender'];
  $content = $_POST['content'];

  // 验证表白内容和发送者的名字是否为空
  if (empty($sender) || empty($content)) {
    http_response_code(400);
    echo '请填写表白内容和发送者的名字';
    exit;
  }

  $file = fopen("messages.txt", "a");
  if ($file === false) {
    http_response_code(500);
    echo '无法打开文件';
    exit;
  }

  fwrite($file, "发送者: " . $sender . "\n");
  fwrite($file, "表白内容: " . $content . "\n\n");
  fclose($file);

  // 重定向到首页
  header('Location: index.php');
  exit;
} else {
  http_response_code(405);
  echo '请求方法不被允许';
}
?>
