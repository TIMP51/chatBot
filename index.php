<?php
require_once __DIR__ . '/vendor/autoload.php';

use Telegram\Bot\Api;

// Загружаем переменные окружения
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Создаем экземпляр бота
$telegram = new Api($_ENV['BOT_TOKEN']);

// Получаем информацию о боте
try {
    $response = $telegram->getMe();

    echo "🤖 Бот успешно создан!\n";
    echo "=============================\n";
    echo "ID: " . $response->getId() . "\n";
    echo "Имя: " . $response->getFirstName() . "\n";
    echo "Username: @" . $response->getUsername() . "\n";
    echo "Токен: " . substr($_ENV['BOT_TOKEN'], 0, 15) . "...\n";

    // Проверяем соединение с API
    $updates = $telegram->getUpdates();
    echo "Доступных обновлений: " . count($updates) . "\n";

    echo "\n✅ Бот работает корректно!\n";
    echo "Следующий шаг: /start в чате с ботом\n";

} catch (Exception $e) {
    echo "❌ Ошибка: " . $e->getMessage() . "\n";
    echo "Проверьте токен и интернет-соединение\n";
}