<?php
require_once 'CurlClient.php';
require_once 'Category.php';
require_once 'Post.php';
require_once 'Todo.php';

$options = ['posts', 'todos'];
$randomIndex = rand(0, count($options) - 1);
$selectedOption = $options[$randomIndex];
$randomNumber = ($selectedOption === 'posts') ? rand(1, 100) : rand(1, 200);

$curlClient = new CurlClient();

try {
    $response = $curlClient->get("https://jsonplaceholder.typicode.com/{$selectedOption}/{$randomNumber}");
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error decoding JSON: " . json_last_error_msg());
    }

    if ($selectedOption === 'todos') {
        $data = json_decode($response, true);
        $todo = new Todo(
            type: 'todo',
            id: (int)$data['id'],
            title: (string)$data['title'],
            completed: (bool)$data['completed']
        );

        $resultDisplay = $todo->display();

    } else {
        $data = json_decode($response, true);
        $post = new Post(
            type: "post",
            id: (int)$data['id'],
            title: (string)$data['title'],
            body: (string)$data['body']
        );

        $resultDisplay = $post->display();
    }

} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
} finally {

    if (isset($curlClient)) {
        $curlClient->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>API Data Display</title>
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto bg-white p-5 rounded-lg shadow-md">
   <?php echo $resultDisplay; ?>
</div>

</body>
</html>