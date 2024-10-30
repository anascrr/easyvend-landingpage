<?php
$host = 'localhost';
$dbname = 'db_easyvend';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $assunto = htmlspecialchars(trim($_POST['assunto']));
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    $stmt = $pdo->prepare("INSERT INTO contatos (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':assunto', $assunto);
    $stmt->bindParam(':mensagem', $mensagem);

    if ($stmt->execute()) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Tente novamente.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
